<?php

namespace App\Http\Controllers;

use App\Models\TravelPlan;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Itinerary;
use App\Models\TransportRoute;

class TravelPlanController extends Controller
{
    // Tampilkan Form Kosong (Buat Baru)
    public function create()
    {
        // Ambil semua kota diurutkan berdasarkan nama
        $cities = City::orderBy('cityName', 'asc')->get();

        return view('createplan', [
            'plan' => null,
            'cities' => $cities // Kirim ke view
        ]);
    }

    // Simpan Data Baru ke Database
    public function store(Request $request)
    {
        // Validasi input
        $validated = $this->validateInput($request);

        // Mapping Data Input ke Kolom Database
        $data = collect($validated)
            ->except(['needsAccommodation', 'activities'])
            ->toArray();

        $data['userID'] = Auth::id();
        $data['requestedActivities'] = $validated['activities'] ?? null;

        if (isset($validated['needsAccommodation'])) {
            $data['accommodationCityID'] = $validated['destinationCityID'];
        } else {
            $data['accommodationCityID'] = null;
        }

        // Simpan Rencana Utama (Header)
        $plan = TravelPlan::create($data);

        Itinerary::create([
            'planID' => $plan->planID,
            'itineraryName' => 'Rencana Utama'
        ]);

        return redirect()->route('travel-plan.transport', $plan->planID)
            ->with('success', 'Rencana perjalanan berhasil dibuat!');
    }

    // Tampilkan Form dengan Data Lama (Mode Edit)
    public function edit(TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // Ambil semua kota
        $cities = City::orderBy('cityName', 'asc')->get();

        return view('createplan', [
            'plan' => $travelPlan,
            'cities' => $cities // Kirim ke view
        ]);
    }

    // Simpan Perubahan (Update)
    public function update(Request $request, TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        $validated = $this->validateInput($request);

        $data = collect($validated)
            ->except(['needsAccommodation', 'activities'])
            ->toArray();

        $data['requestedActivities'] = $validated['activities'] ?? null;

        if (isset($validated['needsAccommodation'])) {
            $data['accommodationCityID'] = $validated['destinationCityID'];
        } else {
            $data['accommodationCityID'] = null;
        }

        // Update Database
        $travelPlan->update($data);

        return redirect()->route('travel-plan.transport', $travelPlan->planID)
            ->with('success', 'Rencana perjalanan berhasil diperbarui!');
    }

    private function applyFilters($query, Request $request)
    {
        // 1. Filter Jenis Transportasi
        if ($request->has('types')) {
            $types = $request->input('types');
            $query->whereHas('serviceProvider', function ($q) use ($types) {
                $q->where(function ($subQ) use ($types) {
                    foreach ($types as $type) {
                        if ($type == 'Bus') $subQ->orWhere('providerName', 'like', '%Bus%')->orWhere('providerName', 'like', '%Travel%')->orWhere('providerName', 'like', '%Shuttle%');
                        if ($type == 'Kereta') $subQ->orWhere('providerName', 'like', '%KA%')->orWhere('providerName', 'like', '%Kereta%')->orWhere('providerName', 'like', '%Railink%');
                        if ($type == 'Kapal') $subQ->orWhere('providerName', 'like', '%Ferry%')->orWhere('providerName', 'like', '%Kapal%')->orWhere('providerName', 'like', '%Pelni%');
                        if ($type == 'Pesawat') $subQ->orWhere('providerName', 'like', '%Air%')->orWhere('providerName', 'like', '%Garuda%')->orWhere('providerName', 'like', '%Lion%');
                    }
                });
            });
        }

        // 2. Filter Fasilitas
        if ($request->has('facilities')) {
            foreach ($request->input('facilities') as $facility) {
                $query->whereJsonContains('facilities', $facility);
            }
        }

        // 3. Filter Waktu 
        if ($request->has('times')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->input('times') as $time) {
                    if ($time == 'pagi') {
                        $q->orWhereBetween('departureTime', ['06:00:00', '11:59:59']);
                    }
                    if ($time == 'siang') {
                        $q->orWhereBetween('departureTime', ['12:00:00', '17:59:59']);
                    }
                    if ($time == 'malam') {
                        $q->orWhere(function ($sub) {
                            $sub->where('departureTime', '>=', '18:00:00')
                                ->orWhere('departureTime', '<=', '05:59:59');
                        });
                    }
                }
            });
        }

        return $query;
    }

    public function selectTransport(Request $request, TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // === 1. RUTE LANGSUNG (DIRECT) ===
        $query = TransportRoute::with('serviceProvider')
            ->where('originCityID', $travelPlan->originCityID)
            ->where('destinationCityID', $travelPlan->destinationCityID);

        // Terapkan Filter
        $this->applyFilters($query, $request);

        $directRoutes = $query->get()->map(function ($t) {
            $booked = \App\Models\PlanItem::where('transport_route_id', $t->routeID)
                ->whereHas('order', function ($q) {
                    $q->where('status', 'paid');
                })->sum('quantity');
            $t->remaining_seats = ($t->total_seats ?? 40) - $booked;
            return $t;
        });

        // === 2. RUTE TRANSIT ===
        $transitRoutes = collect();

        // Ambil info terminal transit
        $originTerminals = DB::table('city_terminals')->where('cityID', $travelPlan->originCityID)->pluck('terminalID');
        $destTerminals = DB::table('city_terminals')->where('cityID', $travelPlan->destinationCityID)->pluck('terminalID');

        // CASE A: DEPARTURE TRANSIT (Feeder Darat -> Pesawat)
        foreach ($originTerminals as $termID) {
            $terminalInfo = DB::table('transport_terminals')->where('terminalID', $termID)->first();

            if ($terminalInfo && $terminalInfo->cityID != $travelPlan->originCityID) {
                // 1. Feeder (Kena Filter Waktu & Tipe)
                $feederQuery = TransportRoute::with('serviceProvider')
                    ->where('originCityID', $travelPlan->originCityID)
                    ->where('destinationCityID', $terminalInfo->cityID);

                // Terapkan filter ke leg pertama (Feeder)
                $this->applyFilters($feederQuery, $request);
                $feeders = $feederQuery->get();

                // 2. Flight
                $flights = TransportRoute::with('serviceProvider')
                    ->where('originCityID', $terminalInfo->cityID)
                    ->where('destinationCityID', $travelPlan->destinationCityID)
                    ->whereHas('serviceProvider', function ($q) {
                        $q->where('providerName', 'like', '%Air%')->orWhere('providerName', 'like', '%Garuda%');
                    })
                    ->get();

                if ($feeders->isNotEmpty() && $flights->isNotEmpty()) {
                    $transitRoutes->push([
                        'type' => 'Transit Berangkat',
                        'hub_name' => $terminalInfo->name,
                        'step1_label' => 'Ke Bandara',
                        'step2_label' => 'Penerbangan',
                        'feeders' => $feeders,
                        'main_transport' => $flights
                    ]);
                }
            }
        }

        // CASE B: ARRIVAL TRANSIT (Pesawat -> Feeder Darat)
        foreach ($destTerminals as $termID) {
            $terminalInfo = DB::table('transport_terminals')->where('terminalID', $termID)->first();

            if ($terminalInfo && $terminalInfo->cityID != $travelPlan->destinationCityID) {
                // 1. Flight 
                $flightQuery = TransportRoute::with('serviceProvider')
                    ->where('originCityID', $travelPlan->originCityID)
                    ->where('destinationCityID', $terminalInfo->cityID)
                    ->whereHas('serviceProvider', function ($q) {
                        $q->where('providerName', 'like', '%Air%')->orWhere('providerName', 'like', '%Garuda%');
                    });

                $this->applyFilters($flightQuery, $request);
                $flights = $flightQuery->get();

                // 2. Feeder
                $feeders = TransportRoute::with('serviceProvider')
                    ->where('originCityID', $terminalInfo->cityID)
                    ->where('destinationCityID', $travelPlan->destinationCityID)
                    ->get();

                if ($flights->isNotEmpty() && $feeders->isNotEmpty()) {
                    $transitRoutes->push([
                        'type' => 'Transit Kedatangan',
                        'hub_name' => $terminalInfo->name,
                        'step1_label' => 'Penerbangan',
                        'step2_label' => 'Ke Kota Tujuan',
                        'feeders' => $flights,
                        'main_transport' => $feeders
                    ]);
                }
            }
        }

        return view('select-transport', [
            'plan' => $travelPlan,
            'transportRoutes' => $directRoutes,
            'transitRoutes' => $transitRoutes
        ]);
    }

    private function validateInput(Request $request)
    {
        return $request->validate([
            'planName' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\s\-\(\)]+$/'],
            'amount' => ['required', 'numeric', 'min:0', 'max:1000000000'],
            'originCityID' => ['required', 'integer', 'exists:cities,cityID'],
            'destinationCityID' => ['required', 'integer', 'exists:cities,cityID', 'different:originCityID'],
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate' => ['required', 'date', 'after_or_equal:startDate'],
            'needsAccommodation' => ['nullable', 'string'],
            'activities' => ['nullable', 'array'],
            'activities.*' => ['string']
        ], [
            'planName.regex' => 'The plan name contains invalid characters.',
            'destinationCityID.different' => 'The destination city cannot be the same as the origin city.',
            'endDate.after_or_equal' => 'The end date must be equal to or after the start date.',
            'amount.min' => 'The budget amount cannot be negative.',
        ], [
            'planName' => 'Plan Name',
            'amount' => 'Budget Amount',
            'originCityID' => 'Origin City',
            'destinationCityID' => 'Destination City',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
        ]);
    }
    // 6. Halaman Pilih Akomodasi
    public function selectAccommodation(Request $request, TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // 1. Tentukan Kota Pencarian
        $targetCityID = $travelPlan->accommodationCityID ?? $travelPlan->destinationCityID;

        // 2. Query Dasar
        $query = \App\Models\Accommodation::where('cityID', $targetCityID);

        // 3. Filter: Tipe Akomodasi 
        if ($request->has('types')) {
            $query->whereIn('type', $request->input('types'));
        }

        // 4. Filter: Fasilitas
        if ($request->has('facilities')) {
            foreach ($request->input('facilities') as $facility) {
                $query->whereJsonContains('facilities', $facility);
            }
        }

        // 5. Filter: Rating
        if ($request->has('ratings')) {
            $ratings = $request->input('ratings');
            $query->where(function ($q) use ($ratings) {
                foreach ($ratings as $rating) {
                    $q->orWhereBetween('rating', [$rating, $rating + 0.9]);
                }
            });
        }

        // 6. Eksekusi & Hitung Sisa Kamar
        $accommodations = $query->get()->map(function ($hotel) {
            // Anggap kapasitas hotel statis 20 kamar per hotel (bisa diganti field DB)
            $totalRooms = 20;

            $bookedRooms = \App\Models\PlanItem::where('accommodation_id', $hotel->accommodationID)
                ->whereHas('order', function ($q) {
                    $q->where('status', 'paid');
                })
                ->sum('quantity');

            $hotel->remaining_rooms = $totalRooms - $bookedRooms;

            return $hotel;
        });

        return view('select-accommodation', [
            'plan' => $travelPlan,
            'accommodations' => $accommodations
        ]);
    }

    public function selectAttraction(Request $request, TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // 1. Query Dasar (Berdasarkan Kota Tujuan)
        $query = \App\Models\Attraction::where('cityID', $travelPlan->destinationCityID);

        // 2. Filter: Kategori
        if ($request->has('categories')) {
            // Jika user memilih kategori (misal: ['Alam', 'Kuliner'])
            // Kita gunakan whereIn untuk mencocokkan
            $query->whereIn('category', $request->input('categories'));
        }

        // 3. Filter: Harga Tiket
        if ($request->has('prices')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->input('prices') as $priceRange) {
                    if ($priceRange == 'free') $q->orWhere('estimatedCost', 0);
                    if ($priceRange == 'under_50') $q->orWhere('estimatedCost', '<', 50000);
                    if ($priceRange == '50_100') $q->orWhereBetween('estimatedCost', [50000, 100000]);
                    if ($priceRange == 'over_100') $q->orWhere('estimatedCost', '>', 100000);
                }
            });
        }

        $attractions = $query->get();

        return view('select-attraction', [
            'plan' => $travelPlan,
            'attractions' => $attractions
        ]);
    }

    public function index()
    {
        $plans = TravelPlan::where('userID', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-plans', ['plans' => $plans]);
    }

    public function managePlan(TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }
        $travelPlan->load('itineraries.planItems');
        return view('manage-plan', ['plan' => $travelPlan]);
    }

    public function showTransport(TravelPlan $travelPlan, $id)
    {
        $transport = \App\Models\TransportRoute::with('serviceProvider')->findOrFail($id);
        $itineraries = $travelPlan->itineraries;

        return view('detail-transport', compact('travelPlan', 'transport', 'itineraries'));
    }

    public function showAccommodation(TravelPlan $travelPlan, $id)
    {
        $accommodation = \App\Models\Accommodation::findOrFail($id);
        $itineraries = $travelPlan->itineraries;

        return view('detail-accommodation', compact('travelPlan', 'accommodation', 'itineraries'));
    }

    public function showAttraction(TravelPlan $travelPlan, $id)
    {
        $attraction = \App\Models\Attraction::with('city')->findOrFail($id);
        $itineraries = $travelPlan->itineraries;

        return view('detail-attraction', compact('travelPlan', 'attraction', 'itineraries'));
    }

    public function storeItinerary(Request $request, TravelPlan $travelPlan)
    {
        $request->validate([
            'itineraryName' => 'required|string|max:255'
        ]);

        $travelPlan->itineraries()->create([
            'itineraryName' => $request->itineraryName
        ]);

        return redirect()->back()->with('success', 'Folder rencana baru berhasil dibuat!');
    }

    public function addToPlan(Request $request, TravelPlan $travelPlan)
    {
        $request->validate([
            'itinerary_id' => 'required|exists:itineraries,itineraryID',
            'item_type' => 'required|in:Transportasi,Akomodasi,Wisata',
            'item_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'duration' => 'nullable|integer|min:1',
        ]);

        // Variabel penampung data
        $description = '';
        $unitPrice = 0;
        $bookingLink = '';
        $providerName = '';
        $itemTypeDB = '';
        $lat = null;
        $long = null;

        // Variabel ID Referensi untuk Validasi Stok
        $transportRouteID = null;
        $accommodationID = null;

        $duration = $request->duration ?? 1;

        if ($request->item_type == 'Transportasi') {
            $item = \App\Models\TransportRoute::with('serviceProvider')->find($request->item_id);
            $providerName = $item->serviceProvider->providerName;
            $description = "$providerName ({$item->class})";
            $unitPrice = $item->averagePrice;
            $bookingLink = $item->bookingLink;
            $itemTypeDB = 'Transportasi';
            $lat = $item->start_latitude;
            $long = $item->start_longitude;
            $transportRouteID = $item->routeID; // Simpan ID Rute
        } elseif ($request->item_type == 'Akomodasi') {
            $item = \App\Models\Accommodation::find($request->item_id);
            $providerName = $item->hotelName;
            $description = "$providerName ({$item->type})";
            $unitPrice = $item->averagePricePerNight;
            $bookingLink = $item->bookingLink;
            $itemTypeDB = 'Akomodasi';
            $lat = $item->latitude;
            $long = $item->longitude;
            $accommodationID = $item->accommodationID; // Simpan ID Hotel
        } elseif ($request->item_type == 'Wisata') {
            $item = \App\Models\Attraction::find($request->item_id);
            $providerName = $item->attractionName;
            $description = "Tiket $providerName";
            $unitPrice = $item->estimatedCost;
            $bookingLink = $item->bookingLink;
            $itemTypeDB = 'Aktivitas';
            $lat = $item->latitude;
            $long = $item->longitude;
        }

        // Logic Hitung Biaya
        if ($itemTypeDB == 'Akomodasi') {
            $totalEstimatedCost = $unitPrice * $request->quantity * $duration;
            $description .= " - {$duration} Malam";
        } else {
            $totalEstimatedCost = $unitPrice * $request->quantity;
        }

        // Logic Merge: Hanya merge jika item sama & status BELUM PAID & Durasi sama (khusus hotel)
        $query = \App\Models\PlanItem::where('itineraryID', $request->itinerary_id)
            ->where('itemType', $itemTypeDB)
            ->where('providerName', $providerName)
            ->whereDoesntHave('order', function ($q) {
                $q->where('status', 'paid');
            });

        if ($itemTypeDB == 'Akomodasi') {
            $query->where('duration', $duration);
        }

        $existingItem = $query->first();

        if ($existingItem) {
            // Update Quantity
            $newQuantity = $existingItem->quantity + $request->quantity;

            // Recalculate cost
            if ($itemTypeDB == 'Akomodasi') {
                $newTotalCost = $unitPrice * $newQuantity * $duration;
            } else {
                $newTotalCost = $unitPrice * $newQuantity;
            }

            $existingItem->update([
                'quantity' => $newQuantity,
                'estimatedCost' => $newTotalCost,
                'latitude' => $lat,
                'longitude' => $long
            ]);
        } else {
            // Create New Item dengan ID Referensi
            \App\Models\PlanItem::create([
                'itineraryID' => $request->itinerary_id,
                'description' => $description,
                'itemType' => $itemTypeDB,
                'estimatedCost' => $totalEstimatedCost,
                'quantity' => $request->quantity,
                'duration' => ($itemTypeDB == 'Akomodasi') ? $duration : 1,
                'bookingLink' => $bookingLink,
                'providerName' => $providerName,
                'latitude' => $lat,
                'longitude' => $long,
                'transport_route_id' => $transportRouteID,
                'accommodation_id' => $accommodationID
            ]);
        }

        return redirect()->route('travel-plan.manage', $travelPlan->planID)
            ->with('success', 'Item berhasil ditambahkan!');
    }

    public function deleteItem(Request $request, $planItemID)
    {
        // Cari item berdasarkan ID
        $item = \App\Models\PlanItem::with('itinerary.travelPlan')->findOrFail($planItemID);

        if ($item->itinerary->travelPlan->userID !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus item
        $item->delete();

        return back()->with('success', 'Item berhasil dihapus dari rencana.');
    }

    public function increaseItemQuantity(\App\Models\PlanItem $planItem)
    {
        // Hitung harga satuan dasar (per item per durasi)
        $basePrice = $planItem->estimatedCost / $planItem->quantity;

        $planItem->quantity += 1;
        $planItem->estimatedCost = $basePrice * $planItem->quantity;
        $planItem->save();

        return back()->with('success', 'Jumlah berhasil ditambahkan.');
    }

    public function decreaseItemQuantity(\App\Models\PlanItem $planItem)
    {
        if ($planItem->quantity <= 1) {
            return back()->with('error', 'Jumlah minimal adalah 1.');
        }

        $basePrice = $planItem->estimatedCost / $planItem->quantity;

        $planItem->quantity -= 1;
        $planItem->estimatedCost = $basePrice * $planItem->quantity;
        $planItem->save();

        return back()->with('success', 'Jumlah berhasil dikurangi.');
    }

    public function destroyItinerary(\App\Models\Itinerary $itinerary)
    {
        // Validasi kepemilikan
        if ($itinerary->travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        if ($itinerary->travelPlan->itineraries()->count() <= 1) {
            return back()->with('error', 'Anda harus memiliki setidaknya satu rencana.');
        }

        $itinerary->delete();

        return back()->with('success', 'Folder rencana berhasil dihapus.');
    }

    public function overview(TravelPlan $travelPlan)
    {
        // 1. Validasi Kepemilikan
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // 2. Load Relasi yang dibutuhkan (Cities, Itineraries, PlanItems)
        $travelPlan->load([
            'originCity',
            'destinationCity',
            'itineraries.planItems'
        ]);

        // 3. Tampilkan View
        return view('overview-plan', ['plan' => $travelPlan]);
    }

    public function showTicket($planItemID)
    {
        $item = \App\Models\PlanItem::with(['itinerary.travelPlan.user', 'order'])->findOrFail($planItemID);

        // Validasi Akses
        if (Auth::id() !== $item->itinerary->travelPlan->userID) {
            abort(403);
        }

        // Validasi Status Bayar
        if (!$item->order || $item->order->status !== 'paid') {
            return back()->with('error', 'Tiket belum lunas.');
        }

        return view('ticket-print', ['item' => $item]);
    }

    public function showBooking($planItemID)
    {
        $item = \App\Models\PlanItem::with(['itinerary.travelPlan.user', 'order'])->findOrFail($planItemID);

        // Validasi Akses
        if (Auth::id() !== $item->itinerary->travelPlan->userID) {
            abort(403);
        }

        // Validasi Status Bayar
        if (!$item->order || $item->order->status !== 'paid') {
            return back()->with('error', 'Pesanan belum lunas.');
        }

        return view('booking-print', ['item' => $item]);
    }
}

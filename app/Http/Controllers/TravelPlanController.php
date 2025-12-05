<?php

namespace App\Http\Controllers;

use App\Models\TravelPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Itinerary;

class TravelPlanController extends Controller
{
    // Tampilkan Form Kosong (Buat Baru)
    public function create()
    {
        return view('createplan', ['plan' => null]);
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
        return view('createplan', ['plan' => $travelPlan]);
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

    public function selectTransport(Request $request, TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // 1. Query Dasar: Cari rute yang sesuai Kota Asal & Tujuan
        $query = \App\Models\TransportRoute::with('serviceProvider')
            ->where('originCityID', $travelPlan->originCityID)
            ->where('destinationCityID', $travelPlan->destinationCityID);

        // 2. Filter: Jenis Transportasi (Provider Type)
        if ($request->has('types')) {
            $types = $request->input('types'); // Array ['Bus', 'Kereta']
            $query->whereHas('serviceProvider', function ($q) use ($types) {
                $q->where(function ($subQ) use ($types) {
                    foreach ($types as $type) {
                        if ($type == 'Bus') $subQ->orWhere('providerName', 'like', '%Bus%')->orWhere('providerName', 'like', '%Travel%')->orWhere('serviceType', 'Transportasi');
                        if ($type == 'Kereta') $subQ->orWhere('providerName', 'like', '%KA%')->orWhere('providerName', 'like', '%Kereta%');
                        if ($type == 'Kapal') $subQ->orWhere('providerName', 'like', '%Ferry%')->orWhere('providerName', 'like', '%Kapal%');
                        if ($type == 'Pesawat') $subQ->orWhere('providerName', 'like', '%Air%');
                    }
                });
            });
        }

        // 3. Filter: Fasilitas (JSON)
        if ($request->has('facilities')) {
            foreach ($request->input('facilities') as $facility) {
                $query->whereJsonContains('facilities', $facility);
            }
        }

        // 4. Filter: Waktu Keberangkatan
        if ($request->has('times')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->input('times') as $time) {
                    if ($time == 'pagi') $q->orWhereBetween('departureTime', ['06:00:00', '11:59:59']);
                    if ($time == 'siang') $q->orWhereBetween('departureTime', ['12:00:00', '17:59:59']);
                    if ($time == 'malam') $q->orWhereBetween('departureTime', ['18:00:00', '05:59:59']);
                }
            });
        }

        $transportRoutes = $query->get();

        return view('select-transport', [
            'plan' => $travelPlan,
            'transportRoutes' => $transportRoutes
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
    // 6. Halaman Pilih Akomodasi (DENGAN FILTER)
    public function selectAccommodation(Request $request, TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        // 1. Tentukan Kota Pencarian
        // Prioritas: Kota Akomodasi (jika dipilih khusus) > Kota Tujuan
        $targetCityID = $travelPlan->accommodationCityID ?? $travelPlan->destinationCityID;

        // 2. Query Dasar
        $query = \App\Models\Accommodation::where('cityID', $targetCityID);

        // 3. Filter: Tipe Akomodasi 
        if ($request->has('types')) {
            $query->whereIn('type', $request->input('types'));
        }

        // 4. Filter: Fasilitas (JSON)
        if ($request->has('facilities')) {
            foreach ($request->input('facilities') as $facility) {
                $query->whereJsonContains('facilities', $facility);
            }
        }

        // 5. Filter: Rating (Bintang)
        if ($request->has('ratings')) {
            $ratings = $request->input('ratings');
            $query->where(function ($q) use ($ratings) {
                foreach ($ratings as $rating) {
                    // Mencari hotel dengan rating di range tersebut (misal pilih 4, cari 4.0 - 4.9)
                    $q->orWhereBetween('rating', [$rating, $rating + 0.9]);
                }
            });
        }

        $accommodations = $query->get();

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
            'quantity' => 'required|integer|min:1'
        ]);

        $description = '';
        $cost = 0;
        $bookingLink = '';
        $providerName = '';
        $itemTypeDB = '';

        if ($request->item_type == 'Transportasi') {
            $item = \App\Models\TransportRoute::with('serviceProvider')->find($request->item_id);
            $providerName = $item->serviceProvider->providerName;
            $description = "$providerName ({$item->class})";
            $cost = $item->averagePrice * $request->quantity;
            $bookingLink = $item->bookingLink;
            $itemTypeDB = 'Transportasi';
        } elseif ($request->item_type == 'Akomodasi') {
            $item = \App\Models\Accommodation::find($request->item_id);
            $providerName = $item->hotelName;
            $description = "$providerName ({$item->type})";
            $cost = $item->averagePricePerNight * $request->quantity;
            $bookingLink = $item->bookingLink;
            $itemTypeDB = 'Akomodasi';
        } elseif ($request->item_type == 'Wisata') {
            $item = \App\Models\Attraction::find($request->item_id);
            $providerName = $item->attractionName;
            $description = "Tiket $providerName";
            $cost = $item->estimatedCost * $request->quantity;
            $itemTypeDB = 'Aktivitas';
        }

        // Simpan ke tabel plan_items 
        \App\Models\PlanItem::create([
            'itineraryID' => $request->itinerary_id,
            'description' => $description,
            'itemType' => $itemTypeDB,
            'estimatedCost' => $cost,
            'quantity' => $request->quantity,
            'bookingLink' => $bookingLink,
            'providerName' => $providerName,
        ]);

        return redirect()->route('travel-plan.manage', $travelPlan->planID)
            ->with('success', 'Item berhasil ditambahkan ke rencana!');
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
}

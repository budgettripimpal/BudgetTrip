<?php

namespace App\Http\Controllers;

use App\Models\TravelPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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


        // Ambil data validasi, tapi buang field yang tidak ada di tabel
        $data = collect($validated)
            ->except(['needsAccommodation', 'activities'])
            ->toArray();

        // Isi kolom-kolom manual
        $data['userID'] = Auth::id();

        // Map 'activities' (input) ke 'requestedActivities' (database)
        // Eloquent akan otomatis mengubah array ke JSON berkat 'casts' di Model
        $data['requestedActivities'] = $validated['activities'] ?? null;

        // Logika: Jika checkbox 'needsAccommodation' dicentang, 
        // set 'accommodationCityID' sama dengan Kota Tujuan (sebagai default)
        if (isset($validated['needsAccommodation'])) {
            $data['accommodationCityID'] = $validated['destinationCityID'];
        } else {
            $data['accommodationCityID'] = null;
        }

        // Simpan ke Database (sekarang aman karena nama kolom sudah sesuai)
        $plan = TravelPlan::create($data);

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

    public function selectTransport(TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        return view('select-transport', ['plan' => $travelPlan]);
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
    public function selectAccommodation(TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }

        return view('select-accommodation', ['plan' => $travelPlan]);
    }
    public function selectAttraction(TravelPlan $travelPlan)
    {
        if ($travelPlan->userID !== Auth::id()) {
            abort(403);
        }
        
        return view('select-attraction', ['plan' => $travelPlan]);
    }
}

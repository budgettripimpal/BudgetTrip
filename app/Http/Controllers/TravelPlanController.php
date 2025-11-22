<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TravelPlanController extends Controller
{
    public function create()
    {
        return view('createplan');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'planName' => ['required', 'string', 'max:100', 'regex:/^[a-zA-Z0-9\s\-\(\)]+$/'],
            'amount' => ['required', 'numeric', 'min:0', 'max:1000000000'],
            'originCityID' => ['required', 'integer', 'in:1,2,3'],
            'destinationCityID' => ['required', 'integer', 'in:4,5,6', 'different:originCityID'],
            'startDate' => ['required', 'date', 'after_or_equal:today'],
            'endDate' => ['required', 'date', 'after_or_equal:startDate'],
            'needsAccommodation' => ['nullable', 'string'],
            'activities' => ['nullable', 'array'],
            'activities.*' => ['string', 'in:Kuliner,Alam,Sejarah,Belanja']
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

        // --- JIKA LOLOS VALIDASI ---
        return redirect()->route('travel-plan.create')
            ->with('success', 'Travel Plan Valid! Data is safe to process.')
            ->withInput();
    }
    public function selectTransport()
    {
        return view('select-transport');
    }
}

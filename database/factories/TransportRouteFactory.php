<?php

namespace Database\Factories;

use App\Models\ServiceProvider;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportRouteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'providerID' => ServiceProvider::factory(), 
            'originCityID' => City::factory(),
            'destinationCityID' => City::factory(),
            'departureTime' => '08:00:00',
            'arrivalTime' => '10:00:00',
            'averagePrice' => 500000,
            'class' => 'Economy',
        ];
    }
}
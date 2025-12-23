<?php

namespace Database\Factories;

use App\Models\TravelPlan;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItineraryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'planID' => TravelPlan::factory(),
            'itineraryName' => 'Hari ' . $this->faker->numberBetween(1, 5),
        ];
    }
}
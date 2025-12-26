<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelPlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'userID' => User::factory(),
            'planName' => $this->faker->sentence(3),
            'startDate' => now()->toDateString(),
            'endDate' => now()->addDays(3)->toDateString(),
            'amount' => $this->faker->numberBetween(1000000, 10000000),
            'originCityID' => City::factory(),
            'destinationCityID' => City::factory(),
            // 'accommodationCityID' => null, // Opsional
        ];
    }
}
<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttractionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cityID' => City::factory(),
            'attractionName' => $this->faker->words(3, true),
            'category' => $this->faker->randomElement(['Alam', 'Budaya', 'Kuliner', 'Hiburan']),
            'estimatedCost' => $this->faker->numberBetween(10000, 500000),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'reviewCount' => $this->faker->numberBetween(0, 1000),
            'description' => $this->faker->paragraph(),
            'bookingLink' => $this->faker->url(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
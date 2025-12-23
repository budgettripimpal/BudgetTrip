<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccommodationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'providerID' => ServiceProvider::factory(),
            'cityID' => City::factory(),
            'hotelName' => $this->faker->company() . ' Hotel',
            'averagePricePerNight' => $this->faker->numberBetween(300000, 2000000),
            'rating' => $this->faker->randomFloat(1, 1, 5),
            'type' => $this->faker->randomElement(['Hotel', 'Villa', 'Resort', 'Hostel']),
            'facilities' => json_encode(['WiFi', 'Kolam Renang', 'Parkir', 'AC']),
            'description' => $this->faker->paragraph(),
            'bookingLink' => $this->faker->url(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
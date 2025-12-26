<?php

namespace Database\Factories;

use App\Models\Itinerary;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlanItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'itineraryID' => Itinerary::factory(),
            'itemType' => 'Transportasi',
            'providerName' => $this->faker->company(),
            'description' => 'Tiket Pesawat',
            'quantity' => 1,
            'estimatedCost' => 500000,
            'duration' => 1,
            'bookingLink' => 'http://example.com',
            'transport_route_id' => null,
            'accommodation_id' => null,
        ];
    }
}
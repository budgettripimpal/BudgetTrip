<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceProviderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'providerName' => $this->faker->company(),
            'serviceType'  => 'Transportasi',
        ];
    }
}
<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_travel_plan()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create();

        // Setup Data Kota
        $originCity = City::factory()->create([
            'cityName' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'locationType' => 'Urban',
        ]);

        $destCity = City::factory()->create([
            'cityName' => 'Bekasi',
            'province' => 'Jawa Barat',
            'locationType' => 'Urban',
        ]);

        $startDate = now()->addDay()->toDateString(); 
        $endDate = now()->addDays(5)->toDateString();

        $response = $this->actingAs($user)->post('/create-plan', [
            'planName' => 'Liburan ke Bekasi',
            'originCityID' => $originCity->cityID,
            'destinationCityID' => $destCity->cityID,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'amount' => 5000000
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302);

        $this->assertDatabaseHas('travel_plans', [
            'planName' => 'Liburan ke Bekasi',
            'amount' => 5000000,
            'userID' => $user->id,
        ]);
    }
}
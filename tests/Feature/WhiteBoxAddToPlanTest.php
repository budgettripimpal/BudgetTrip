<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TravelPlan;
use App\Models\Itinerary;
use App\Models\PlanItem;
use App\Models\TransportRoute;
use App\Models\ServiceProvider;
use App\Models\Accommodation;
use App\Models\Attraction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WhiteBoxAddToPlanTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $plan;
    protected $itinerary;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->user = User::factory()->create();
        $this->plan = TravelPlan::factory()->create(['userID' => $this->user->id]);
        $this->itinerary = Itinerary::factory()->create(['planID' => $this->plan->planID]);
    }

    /**
     * JALUR 1: Transportasi -> Stok Habis -> Error
     */
    public function test_path_1_transport_fails_if_seats_full()
    {
        $provider = ServiceProvider::factory()->create();
        
        // Default kapasitas biasanya 40 jika tidak diset
        $route = TransportRoute::factory()->create([
            'providerID' => $provider->providerID
        ]);

        $response = $this->actingAs($this->user)->post("/plan/{$this->plan->planID}/add-item", [
            'itinerary_id' => $this->itinerary->itineraryID,
            'item_type' => 'Transportasi',
            'item_id' => $route->routeID,
            'quantity' => 41 // Melebihi kapasitas default 40
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        
        $this->assertDatabaseMissing('plan_items', [
            'transport_route_id' => $route->routeID
        ]);
    }

    /**
     * JALUR 2: Transportasi -> Stok Ada -> Create Baru
     */
    public function test_path_2_transport_create_new_item()
    {
        $provider = ServiceProvider::factory()->create();
        $route = TransportRoute::factory()->create([
            'providerID' => $provider->providerID,
            'averagePrice' => 500000
        ]);

        $response = $this->actingAs($this->user)->post("/plan/{$this->plan->planID}/add-item", [
            'itinerary_id' => $this->itinerary->itineraryID,
            'item_type' => 'Transportasi',
            'item_id' => $route->routeID,
            'quantity' => 1
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('plan_items', [
            'itemType' => 'Transportasi',
            'transport_route_id' => $route->routeID,
            'quantity' => 1,
            'estimatedCost' => 500000
        ]);
    }

    /**
     * JALUR 3: Transportasi -> Stok Ada -> Merge Existing
     */
    public function test_path_3_transport_merge_existing_item()
    {
        $provider = ServiceProvider::factory()->create();
        $route = TransportRoute::factory()->create([
            'providerID' => $provider->providerID,
            'averagePrice' => 500000
        ]);

        PlanItem::factory()->create([
            'itineraryID' => $this->itinerary->itineraryID,
            'itemType' => 'Transportasi',
            'transport_route_id' => $route->routeID,
            'quantity' => 1,
            'estimatedCost' => 500000
        ]);

        $response = $this->actingAs($this->user)->post("/plan/{$this->plan->planID}/add-item", [
            'itinerary_id' => $this->itinerary->itineraryID,
            'item_type' => 'Transportasi',
            'item_id' => $route->routeID,
            'quantity' => 1
        ]);

        $this->assertDatabaseCount('plan_items', 1);
        $this->assertDatabaseHas('plan_items', [
            'transport_route_id' => $route->routeID,
            'quantity' => 2,
            'estimatedCost' => 1000000
        ]);
    }

    /**
     * JALUR 4: Akomodasi -> Hitung Biaya Durasi -> Create Baru
     */
    public function test_path_4_accommodation_with_duration_logic()
    {
        $hotel = Accommodation::factory()->create([
            'averagePricePerNight' => 1000000 
        ]);

        $response = $this->actingAs($this->user)->post("/plan/{$this->plan->planID}/add-item", [
            'itinerary_id' => $this->itinerary->itineraryID,
            'item_type' => 'Akomodasi',
            'item_id' => $hotel->accommodationID,
            'quantity' => 1,
            'duration' => 3 
        ]);

        // Biaya = 1.000.000 * 3 malam = 3.000.000
        $this->assertDatabaseHas('plan_items', [
            'itemType' => 'Akomodasi',
            'accommodation_id' => $hotel->accommodationID,
            'duration' => 3,
            'estimatedCost' => 3000000 
        ]);
    }

    /**
     * JALUR 5: Wisata -> Create Baru
     */
    public function test_path_5_attraction_create_new()
    {
        $wisata = Attraction::factory()->create([
            'estimatedCost' => 50000
        ]);

        $response = $this->actingAs($this->user)->post("/plan/{$this->plan->planID}/add-item", [
            'itinerary_id' => $this->itinerary->itineraryID,
            'item_type' => 'Wisata',
            'item_id' => $wisata->attractionID,
            'quantity' => 2
        ]);

        $this->assertDatabaseHas('plan_items', [
            'itemType' => 'Aktivitas',
            'estimatedCost' => 100000 
        ]);
    }
}
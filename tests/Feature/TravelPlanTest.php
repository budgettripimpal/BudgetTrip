<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\City;
use App\Models\TravelPlan;
use App\Models\Itinerary;
use App\Models\PlanItem;
use App\Models\TransportRoute;
use App\Models\ServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelPlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_page_can_be_rendered()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/create-plan');
        $response->assertStatus(200);
        $response->assertViewIs('createplan');
    }

    public function test_user_can_create_travel_plan_valid()
    {
        $user = User::factory()->create();
        $originCity = City::factory()->create(['cityName' => 'Jakarta']);
        $destCity = City::factory()->create(['cityName' => 'Bekasi']);

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
            'userID' => $user->id,
        ]);
    }

    public function test_create_travel_plan_fails_with_invalid_date()
    {
        $user = User::factory()->create();
        $originCity = City::factory()->create();
        $destCity = City::factory()->create();

        $response = $this->actingAs($user)->post('/create-plan', [
            'planName' => 'Invalid Date Plan',
            'originCityID' => $originCity->cityID,
            'destinationCityID' => $destCity->cityID,
            'startDate' => now()->subDay()->toDateString(),
            'endDate' => now()->addDays(5)->toDateString(),
            'amount' => 5000000
        ]);

        $response->assertSessionHasErrors(['startDate']);
    }

    public function test_user_can_update_travel_plan()
    {
        $user = User::factory()->create();
        $originCity = City::factory()->create();
        $destCity = City::factory()->create();

        $plan = TravelPlan::factory()->create([
            'userID' => $user->id,
            'originCityID' => $originCity->cityID,
            'destinationCityID' => $destCity->cityID,
            'amount' => 1000000
        ]);

        $response = $this->actingAs($user)->put("/plan/{$plan->planID}", [
            'planName' => 'Updated Plan Name',
            'originCityID' => $originCity->cityID,
            'destinationCityID' => $destCity->cityID,
            'startDate' => now()->addDay()->toDateString(),
            'endDate' => now()->addDays(3)->toDateString(),
            'amount' => 2000000
        ]);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('travel_plans', [
            'planID' => $plan->planID,
            'planName' => 'Updated Plan Name',
            'amount' => 2000000
        ]);
    }

    public function test_user_cannot_update_others_plan()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();

        $plan = TravelPlan::factory()->create(['userID' => $owner->id]);

        $response = $this->actingAs($otherUser)->put("/plan/{$plan->planID}", [
            'planName' => 'Hacked Plan',
        ]);

        $response->assertStatus(403);
    }

    public function test_select_transport_page_loads()
    {
        $user = User::factory()->create();
        $origin = City::factory()->create();
        $dest = City::factory()->create();

        $plan = TravelPlan::factory()->create([
            'userID' => $user->id,
            'originCityID' => $origin->cityID,
            'destinationCityID' => $dest->cityID
        ]);

        $provider = ServiceProvider::factory()->create();
        TransportRoute::factory()->create([
            'providerID' => $provider->providerID,
            'originCityID' => $origin->cityID,
            'destinationCityID' => $dest->cityID,
            'averagePrice' => 500000
        ]);

        $response = $this->actingAs($user)->get("/plan/{$plan->planID}/transport");
        
        $response->assertStatus(200);
        $response->assertViewIs('select-transport');
        $response->assertViewHas('transportRoutes');
    }

    public function test_add_transport_item_to_plan_valid()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        $itinerary = Itinerary::factory()->create(['planID' => $plan->planID]);
        
        $provider = ServiceProvider::factory()->create();
        $route = TransportRoute::factory()->create([
            'providerID' => $provider->providerID,
            'averagePrice' => 500000,
        ]);

        $response = $this->actingAs($user)->post("/plan/{$plan->planID}/add-item", [
            'itinerary_id' => $itinerary->itineraryID,
            'item_type' => 'Transportasi',
            'item_id' => $route->routeID,
            'quantity' => 2
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('plan_items', [
            'itineraryID' => $itinerary->itineraryID,
            'itemType' => 'Transportasi',
            'quantity' => 2,
            'transport_route_id' => $route->routeID
        ]);
    }

    public function test_add_transport_fails_if_seats_full()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        $itinerary = Itinerary::factory()->create(['planID' => $plan->planID]);
        
        $provider = ServiceProvider::factory()->create();
        
        $route = TransportRoute::factory()->create([
            'providerID' => $provider->providerID,
        ]);

        $response = $this->actingAs($user)->post("/plan/{$plan->planID}/add-item", [
            'itinerary_id' => $itinerary->itineraryID,
            'item_type' => 'Transportasi',
            'item_id' => $route->routeID,
            'quantity' => 41 
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        
        $this->assertDatabaseMissing('plan_items', [
            'transport_route_id' => $route->routeID
        ]);
    }

    public function test_manage_plan_page_accessible()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);

        $response = $this->actingAs($user)->get("/plan/{$plan->planID}/manage");

        $response->assertStatus(200);
        $response->assertViewIs('manage-plan');
    }

    public function test_overview_page_accessible()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);

        $response = $this->actingAs($user)->get("/plan/{$plan->planID}/overview");

        $response->assertStatus(200);
        $response->assertViewIs('overview-plan');
    }

    public function test_increase_item_quantity()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        $itinerary = Itinerary::factory()->create(['planID' => $plan->planID]);
        
        $item = PlanItem::factory()->create([
            'itineraryID' => $itinerary->itineraryID,
            'quantity' => 1,
            'estimatedCost' => 100000
        ]);

        $response = $this->actingAs($user)->patch("/plan-item/{$item->getKey()}/increase");

        $response->assertRedirect();
        
        $this->assertDatabaseHas('plan_items', [
            $item->getKeyName() => $item->getKey(),
            'quantity' => 2,
            'estimatedCost' => 200000 
        ]);
    }

    public function test_decrease_item_quantity()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        $itinerary = Itinerary::factory()->create(['planID' => $plan->planID]);
        
        $item = PlanItem::factory()->create([
            'itineraryID' => $itinerary->itineraryID,
            'quantity' => 2,
            'estimatedCost' => 200000
        ]);

        $response = $this->actingAs($user)->patch("/plan-item/{$item->getKey()}/decrease");

        $response->assertRedirect();
        
        $this->assertDatabaseHas('plan_items', [
            $item->getKeyName() => $item->getKey(),
            'quantity' => 1,
            'estimatedCost' => 100000
        ]);
    }

    public function test_user_can_delete_item()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        $itinerary = Itinerary::factory()->create(['planID' => $plan->planID]);
        $item = PlanItem::factory()->create(['itineraryID' => $itinerary->itineraryID]);

        $response = $this->actingAs($user)->delete("/plan-item/{$item->getKey()}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('plan_items', [$item->getKeyName() => $item->getKey()]);
    }

    public function test_user_can_delete_itinerary()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        
        $itinerary1 = Itinerary::factory()->create(['planID' => $plan->planID]);
        $itinerary2 = Itinerary::factory()->create(['planID' => $plan->planID]);

        $response = $this->actingAs($user)->delete("/itinerary/{$itinerary1->itineraryID}");

        $response->assertRedirect();
        $this->assertDatabaseMissing('itineraries', ['itineraryID' => $itinerary1->itineraryID]);
    }

    public function test_cannot_delete_last_itinerary()
    {
        $user = User::factory()->create();
        $plan = TravelPlan::factory()->create(['userID' => $user->id]);
        $itinerary = Itinerary::factory()->create(['planID' => $plan->planID]);

        $response = $this->actingAs($user)->delete("/itinerary/{$itinerary->itineraryID}");

        $response->assertSessionHas('error');
        $this->assertDatabaseHas('itineraries', ['itineraryID' => $itinerary->itineraryID]);
    }
}
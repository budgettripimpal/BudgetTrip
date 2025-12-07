<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelPlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::post('/city', [AdminController::class, 'storeCity'])->name('admin.store.city');
    Route::post('/provider', [AdminController::class, 'storeProvider'])->name('admin.store.provider');
    Route::post('/route', [AdminController::class, 'storeRoute'])->name('admin.store.route');
    Route::post('/accommodation', [AdminController::class, 'storeAccommodation'])->name('admin.store.accommodation');
    Route::post('/attraction', [AdminController::class, 'storeAttraction'])->name('admin.store.attraction');
    Route::post('/promotion', [AdminController::class, 'storePromotion'])->name('admin.store.promotion');
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create-plan', [TravelPlanController::class, 'create'])->name('travel-plan.create');
    Route::post('/create-plan', [TravelPlanController::class, 'store'])->name('travel-plan.store');

    Route::get('/plan/{travelPlan}/edit', [TravelPlanController::class, 'edit'])->name('travel-plan.edit');
    Route::put('/plan/{travelPlan}', [TravelPlanController::class, 'update'])->name('travel-plan.update');

    Route::get('/plan/{travelPlan}/transport', [TravelPlanController::class, 'selectTransport'])->name('travel-plan.transport');
    Route::get('/plan/{travelPlan}/accommodation', [TravelPlanController::class, 'selectAccommodation'])->name('travel-plan.accommodation');
    Route::get('/plan/{travelPlan}/attraction', [TravelPlanController::class, 'selectAttraction'])->name('travel-plan.attraction');
    Route::get('/plan/{travelPlan}/manage', [TravelPlanController::class, 'managePlan'])->name('travel-plan.manage');
    Route::get('/my-plans', [TravelPlanController::class, 'index'])->name('travel-plan.index');

    Route::get('/plan/{travelPlan}/transport/{id}', [TravelPlanController::class, 'showTransport'])->name('transport.show');
    Route::get('/plan/{travelPlan}/accommodation/{id}', [TravelPlanController::class, 'showAccommodation'])->name('accommodation.show');
    Route::get('/plan/{travelPlan}/attraction/{id}', [TravelPlanController::class, 'showAttraction'])->name('attraction.show');

    Route::post('/plan/{travelPlan}/add-item', [TravelPlanController::class, 'addToPlan'])->name('plan.add-item');
    Route::post('/plan/{travelPlan}/itinerary', [TravelPlanController::class, 'storeItinerary'])->name('travel-plan.store-itinerary');
    Route::delete('/plan-item/{planItemID}', [TravelPlanController::class, 'deleteItem'])->name('plan-item.destroy');
    Route::delete('/itinerary/{itinerary}', [TravelPlanController::class, 'destroyItinerary'])->name('itinerary.destroy');
    Route::patch('/plan-item/{planItem}/increase', [TravelPlanController::class, 'increaseItemQuantity'])->name('plan-item.increase');
    Route::patch('/plan-item/{planItem}/decrease', [TravelPlanController::class, 'decreaseItemQuantity'])->name('plan-item.decrease');

    Route::post('/payment/checkout/{planItem}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
});

require __DIR__ . '/auth.php';

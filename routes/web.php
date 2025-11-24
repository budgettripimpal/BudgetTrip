<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelPlanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/create-plan', [TravelPlanController::class, 'create'])->name('travel-plan.create');
    Route::post('/create-plan', [TravelPlanController::class, 'store'])->name('travel-plan.store');

    Route::get('/plan/{travelPlan}/edit', [TravelPlanController::class, 'edit'])->name('travel-plan.edit');
    Route::put('/plan/{travelPlan}', [TravelPlanController::class, 'update'])->name('travel-plan.update');

    Route::get('/plan/{travelPlan}/transport', [TravelPlanController::class, 'selectTransport'])->name('travel-plan.transport');
    Route::get('/plan/{travelPlan}/accommodation', [TravelPlanController::class, 'selectAccommodation'])->name('travel-plan.accommodation');
    Route::get('/plan/{travelPlan}/attraction', [TravelPlanController::class, 'selectAttraction'])->name('travel-plan.attraction');
});

require __DIR__ . '/auth.php';

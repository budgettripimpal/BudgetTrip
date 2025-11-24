<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TravelPlanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    // Route untuk submit form tambah data
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

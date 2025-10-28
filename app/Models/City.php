<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'cityID';
    protected $guarded = [];

    // Relasi Agregasi
    public function transportRoutesOrigin()
    {
        return $this->hasMany(TransportRoute::class, 'originCityID', 'cityID');
    }

    public function transportRoutesDestination()
    {
        return $this->hasMany(TransportRoute::class, 'destinationCityID', 'cityID');
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'cityID', 'cityID');
    }

    public function attractions()
    {
        return $this->hasMany(Attraction::class, 'cityID', 'cityID');
    }

    // Relasi untuk TravelPlan
    public function travelPlanOrigins()
    {
        return $this->hasMany(TravelPlan::class, 'originCityID', 'cityID');
    }

    public function travelPlanDestinations()
    {
        return $this->hasMany(TravelPlan::class, 'destinationCityID', 'cityID');
    }

    public function travelPlanAccommodations()
    {
        return $this->hasMany(TravelPlan::class, 'accommodationCityID', 'cityID');
    }
}
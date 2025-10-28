<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRoute extends Model
{
    use HasFactory;

    protected $primaryKey = 'routeID';
    protected $guarded = [];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'providerID', 'providerID');
    }

    public function originCity()
    {
        return $this->belongsTo(City::class, 'originCityID', 'cityID');
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destinationCityID', 'cityID');
    }
}
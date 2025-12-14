<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransportRoute extends Model
{
    use HasFactory;

    protected $primaryKey = 'routeID';
    protected $guarded = [];
    protected $casts = [
        'facilities' => 'array', // Otomatis convert JSON ke Array PHP
        'images' => 'array',
        'departureTime' => 'datetime:H:i', // Format jam
        'arrivalTime' => 'datetime:H:i',
        'remaining_seats' => 'integer',
        'total_seats' => 'integer',
    ];
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

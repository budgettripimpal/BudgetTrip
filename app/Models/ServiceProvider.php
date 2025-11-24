<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    protected $primaryKey = 'providerID';
    protected $guarded = [];

    public function transportRoutes()
    {
        return $this->hasMany(TransportRoute::class, 'providerID', 'providerID');
    }

    public function accommodations()
    {
        return $this->hasMany(Accommodation::class, 'providerID', 'providerID');
    }
}
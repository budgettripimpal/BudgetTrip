<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $primaryKey = 'accommodationID';
    protected $guarded = [];

    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class, 'providerID', 'providerID');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cityID', 'cityID');
    }
}
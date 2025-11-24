<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attraction extends Model
{
    use HasFactory;

    protected $primaryKey = 'attractionID';
    protected $guarded = [];

    protected $casts = [
        'estimatedCost' => 'float',
        'rating' => 'float',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'cityID', 'cityID');
    }
}
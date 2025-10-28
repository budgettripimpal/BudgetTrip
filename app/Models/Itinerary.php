<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Itinerary extends Model
{
    use HasFactory;

    protected $primaryKey = 'itineraryID';
    protected $guarded = [];

    // Relasi Komposisi (Dimiliki oleh TravelPlan)
    public function travelPlan()
    {
        return $this->belongsTo(TravelPlan::class, 'planID', 'planID');
    }

    // Relasi Komposisi (Berisi PlanItem)
    public function planItems()
    {
        return $this->hasMany(PlanItem::class, 'itineraryID', 'itineraryID');
    }
}
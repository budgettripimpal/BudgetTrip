<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'planItemID';
    protected $guarded = [];

    // Relasi Komposisi (Dimiliki oleh Itinerary)
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class, 'itineraryID', 'itineraryID');
    }
}
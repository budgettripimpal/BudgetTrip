<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SharedPlan extends Model
{
    use HasFactory;

    protected $primaryKey = 'shareID';
    protected $guarded = [];

    // Relasi Komposisi (Dimiliki oleh TravelPlan)
    public function travelPlan()
    {
        return $this->belongsTo(TravelPlan::class, 'planID', 'planID');
    }
}
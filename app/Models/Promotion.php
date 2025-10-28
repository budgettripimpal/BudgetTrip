<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $primaryKey = 'promotionID';
    protected $guarded = [];

    // Relasi Many-to-Many
    public function travelPlans()
    {
        return $this->belongsToMany(
            TravelPlan::class,      // Model tujuan
            'plan_promotions',      // Nama tabel junction
            'promotionID',          // Foreign key di junction untuk model INI
            'planID'                // Foreign key di junction untuk model TUJUAN
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Ini adalah model untuk tabel pivot (junction table)
 * antara TravelPlan dan Promotion.
 */
class PlanPromotion extends Model
{
    use HasFactory;

    // Tentukan nama tabelnya secara eksplisit
    protected $table = 'plan_promotions';

    // Tabel ini tidak memiliki 'id' auto-increment
    public $incrementing = false;
    
    // Tentukan composite primary key
    protected $primaryKey = ['planID', 'promotionID'];

    protected $guarded = [];
}
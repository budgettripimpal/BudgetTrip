<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'planItemID';
    protected $guarded = [];
    protected $casts = [
        'seat_numbers' => 'array',
    ];
    // Relasi Komposisi (Dimiliki oleh Itinerary)
    public function itinerary()
    {
        return $this->belongsTo(Itinerary::class, 'itineraryID', 'itineraryID');
    }
    // Relasi ke Order (Satu item rencana bisa memiliki satu order pembayaran)
    public function order()
    {
        return $this->hasOne(Order::class, 'plan_item_id', 'planItemID');
    }
}

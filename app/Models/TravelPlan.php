<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelPlan extends Model
{
    use HasFactory;

    protected $primaryKey = 'planID';
    protected $guarded = [];

    /**
     * Untuk mengubah 'requestedActivities' (string "Museum,Pantai")
     * menjadi array PHP otomatis.
     */
    protected $casts = [
        'startDate' => 'date',
        'endDate' => 'date',
        'requestedActivities' => 'array', // Simpan di DB sebagai JSON atau TEXT
    ];

    // Relasi Komposisi (User memiliki TravelPlan)
    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }

    // Relasi Komposisi (TravelPlan berisi Itinerary)
    public function itineraries()
    {
        return $this->hasMany(Itinerary::class, 'planID', 'planID');
    }

    // Relasi Komposisi (TravelPlan berisi SharedPlan)
    public function sharedPlans()
    {
        return $this->hasMany(SharedPlan::class, 'planID', 'planID');
    }

    // Relasi dari Preference (gabungan)
    public function originCity()
    {
        return $this->belongsTo(City::class, 'originCityID', 'cityID');
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destinationCityID', 'cityID');
    }

    public function accommodationCity()
    {
        return $this->belongsTo(City::class, 'accommodationCityID', 'cityID');
    }

    // Relasi Many-to-Many
    public function promotions()
    {
        return $this->belongsToMany(
            Promotion::class,       // Model tujuan
            'plan_promotions',      // Nama tabel junction
            'planID',               // Foreign key di junction untuk model INI
            'promotionID'           // Foreign key di junction untuk model TUJUAN
        );
    }
}
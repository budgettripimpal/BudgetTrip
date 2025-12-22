<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
    protected $table = 'transport_terminals';
    protected $primaryKey = 'terminalID';
    
    protected $fillable = ['name', 'type', 'cityID'];

    // Relasi ke Kota (Terminal berada di satu Kota)
    public function city()
    {
        return $this->belongsTo(City::class, 'cityID', 'cityID');
    }
    
    // Relasi Many-to-Many (Jika Terminal melayani banyak Kota via city_terminals)
    public function serviceCities()
    {
        return $this->belongsToMany(City::class, 'city_terminals', 'terminalID', 'cityID')
                    ->withPivot('distance_km');
    }
}
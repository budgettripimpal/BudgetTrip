<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // (baris ini mungkin juga punya `implements MustVerifyEmail`)
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ // Biarkan bawaan Breeze
        'name',
        'email',
        'password',
        'phoneNumber',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [ // Biarkan bawaan Breeze
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // Biarkan bawaa Breeze
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi Komposisi: User memiliki banyak TravelPlan.
     * id adalah Primary Key bawaan Breeze untuk tabel users.
     */
    public function travelPlans()
    {
        // 'userID' adalah foreign key di tabel travel_plans
        // id adalah primary key di tabel users
        return $this->hasMany(TravelPlan::class, 'userID', 'id');
    }
}
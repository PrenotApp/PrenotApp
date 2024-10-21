<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// your imported
use Illuminate\Database\Eloquent\SoftDeletes;

// Import other models
use App\Models\User;
use App\Models\Item;
use App\Models\Approved;
use App\Models\Hour;
use App\Models\Rack;
use App\Models\Booking;

class School extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function approveds()
    {
        return $this->hasMany(Approved::class);
    }

    public function hours()
    {
        return $this->hasMany(Hour::class);
    }

    public function racks()
    {
        return $this->hasMany(Rack::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

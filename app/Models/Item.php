<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import other models
use App\Models\School;
use App\Models\Rack;
use App\Models\Booking;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'name',
        'school_id',
        'available',
        'rack_id',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

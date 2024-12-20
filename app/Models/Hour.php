<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import other models
use App\Models\School;
use App\Models\Booking;

class Hour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start',
        'school_id',
        'end',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

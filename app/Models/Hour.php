<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import other models
use App\Models\School;

class Hour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'school_id',
        'start',
        'end',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}

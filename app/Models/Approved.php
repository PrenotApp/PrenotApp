<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Import other models
use App\Models\School;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approved extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'email',
        'school_id'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
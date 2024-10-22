<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// your imported
use App\Models\School;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'school_id',
    ];

    public function school(){
        return $this->belongsTo(School::class);
    }
}

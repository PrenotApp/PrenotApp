<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// your imported
use App\Models\School;
use App\Models\Item;

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

    public function items(){
        return $this->hasMany(Item::class);
    }
}

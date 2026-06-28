<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = [
        'cafe_id',
        'name',
        'description',
        'price',
        'category',
        'image',
        'is_available',
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'summary', 
        'director',
        'year',
        'country',
        'duration_minutes',
        'credits',
        'casting',
        'poster_url'
    ];

    protected $casts = [
        'credits' => 'array',
        'casting' => 'array'
    ];
    
}

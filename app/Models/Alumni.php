<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnis';

    protected $fillable = [
        'name',
        'slug',
        'headline',
        'company',
        'summary',
        'content',
        'image',
        'published_at',
        'status',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'boolean',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'location',
        'event_date',
        'media_type',
        'file_path',
        'external_url',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'status' => 'boolean',
    ];
}

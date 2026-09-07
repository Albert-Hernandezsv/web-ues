<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'file_type',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}

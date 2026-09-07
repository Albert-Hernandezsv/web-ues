<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageSectionItem extends Model
{
    protected $fillable = [
        'page_section_id',
        'title',
        'subtitle',
        'content',
        'image',
        'link',
        'extra_1',
        'extra_2',
        'extra_3',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageSection extends Model
{
    protected $fillable = [
        'page_id',
        'section_key',
        'section_name',
        'title',
        'subtitle',
        'content',
        'image_1',
        'image_1_link',
        'image_2',
        'image_2_link',
        'button_text',
        'button_link',
        'extra_1',
        'extra_2',
        'extra_3',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PageSectionItem::class, 'page_section_id')
            ->orderBy('sort_order');
    }
}

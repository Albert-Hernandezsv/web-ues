<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'status',
        'show_in_menu',
        'menu_order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'show_in_menu' => 'boolean',
    ];

    public function sections(): HasMany
    {
        return $this->hasMany(PageSection::class);
    }

    public function sliderItems(): HasMany
    {
        return $this->hasMany(HomeSliderItem::class);
    }
}

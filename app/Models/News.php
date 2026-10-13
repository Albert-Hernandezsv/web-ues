<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
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

    protected static function booted(): void
    {
        static::saving(function (self $record): void {
            if (trim((string) ($record->getAttributes()['slug'] ?? '')) === '') {
                $record->slug = 'noticia-'.\Illuminate\Support\Str::uuid();
            }
        });
    }

    public function getSlugAttribute($value): string
    {
        if (trim((string) $value) !== '') {
            return $value;
        }
        $fallback = 'noticia-'.$this->getKey();
        while (static::where('slug', $fallback)->exists()) {
            $fallback .= '-respaldo';
        }

        return $fallback;
    }
    public function scopePublished(\Illuminate\Database\Eloquent\Builder $query): \Illuminate\Database\Eloquent\Builder
    {
        return $query->where('status', true)->where('published_at', '<=', now('UTC'));
    }
}

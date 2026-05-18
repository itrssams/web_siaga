<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'attachment',
        'published_at',
        'is_published',
        'is_pinned',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
            'is_pinned' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Announcement $announcement): void {
            if (blank($announcement->slug) && filled($announcement->title)) {
                $baseSlug = Str::slug($announcement->title);
                $slug = $baseSlug;
                $counter = 2;

                while (static::where('slug', $slug)->whereKeyNot($announcement->getKey())->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $announcement->slug = $slug;
            }
        });
    }
}

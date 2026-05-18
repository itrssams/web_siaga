<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'author',
        'published_at',
        'is_published',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Article $article): void {
            if (blank($article->slug) && filled($article->title)) {
                $baseSlug = Str::slug($article->title);
                $slug = $baseSlug;
                $counter = 2;

                while (static::where('slug', $slug)->whereKeyNot($article->getKey())->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $article->slug = $slug;
            }
        });
    }
}

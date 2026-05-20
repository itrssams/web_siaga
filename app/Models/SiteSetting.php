<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public const PLACEMENTS = [
        'topbar_left' => 'Topbar Kiri',
        'topbar_right' => 'Topbar Kanan',
        'footer_contact' => 'Footer Kontak',
    ];

    protected $fillable = [
        'key',
        'label',
        'value',
        'url',
        'icon',
        'placement',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::saved(fn (): bool => Cache::forget('site_settings_active'));
        static::deleted(fn (): bool => Cache::forget('site_settings_active'));
    }

    public static function activeFor(string $placement): Collection
    {
        return static::active()
            ->where('placement', $placement)
            ->values();
    }

    public static function active(): Collection
    {
        return Cache::rememberForever('site_settings_active', fn (): Collection => static::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get());
    }
}

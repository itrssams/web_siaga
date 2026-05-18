<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'specialist',
        'clinic',
        'photo',
        'registration_number',
        'practice_license_number',
        'phone',
        'bio',
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
        static::saving(function (Doctor $doctor): void {
            if (blank($doctor->slug) && filled($doctor->name)) {
                $doctor->slug = Str::slug($doctor->name);
            }
        });
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'photo',
        'specialization_id',
        'polyclinic_id',
    ];

    protected static function booted(): void
    {
        static::saving(function (Doctor $doctor): void {
            if (blank($doctor->slug) && filled($doctor->name)) {
                $baseSlug = Str::slug($doctor->name);
                $slug = $baseSlug;
                $counter = 2;

                while (static::where('slug', $slug)->whereKeyNot($doctor->getKey())->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $doctor->slug = $slug;
            }
        });
    }

    public function specialization(): BelongsTo
    {
        return $this->belongsTo(Specialization::class);
    }

    public function polyclinic(): BelongsTo
    {
        return $this->belongsTo(Polyclinic::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(DoctorSchedule::class);
    }
}

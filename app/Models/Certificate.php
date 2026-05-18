<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'name',
        'certificate_number',
        'issuer',
        'file',
        'issued_at',
        'expires_at',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'issued_at' => 'date',
            'expires_at' => 'date',
            'is_active' => 'boolean',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePageItem extends Model
{
    protected $fillable = [
        'title',
        'description',
        'bullets',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'bullets'   => 'array',
        'is_active' => 'boolean',
    ];
}

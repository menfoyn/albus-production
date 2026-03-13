<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    protected $fillable = ['file_path', 'type', 'alt_text', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}

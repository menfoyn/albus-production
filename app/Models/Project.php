<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'client', 'category', 'short_label', 'location', 'date',
        'short_description', 'description', 'cover_image',
        'hero_video', 'intro_video', 'intro_image', 'quote_text', 'hero_image_position', 'hero_image_zoom',
        'color', 'is_featured', 'show_on_about', 'order', 'is_active',
    ];

    protected $casts = [
        'is_featured'   => 'boolean',
        'show_on_about' => 'boolean',
        'is_active'     => 'boolean',
    ];

    public function media()
    {
        return $this->hasMany(ProjectMedia::class)->orderBy('order');
    }

    /** Sadece galeri görselleri */
    public function galleryImages()
    {
        return $this->hasMany(ProjectMedia::class)->where('type', 'image')->orderBy('order');
    }

    /** Sadece galeri videoları */
    public function galleryVideos()
    {
        return $this->hasMany(ProjectMedia::class)->where('type', 'video')->orderBy('order');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

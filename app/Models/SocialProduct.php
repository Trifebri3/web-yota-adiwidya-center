<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SocialProduct extends Model
{
    protected $fillable = [
        'category', 'banner_image', 'name', 'description',
        'features', 'benefits', 'video_url', 'pdf_url',
        'external_link', 'slug', 'is_active', 'published_by'
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'features' => 'array',
        'benefits' => 'array',
    ];

    // Helper untuk mengambil bahasa (Contoh: $product->translation('name'))
    public function translation($field, $lang = null)
    {
        $lang = $lang ?? app()->getLocale(); // default ke bahasa aktif sistem
        return $this->$field[$lang] ?? ($this->$field['id'] ?? '-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

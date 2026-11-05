<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_name',
        'slug',
        'type', // web, iot, robotics, social, event, research
        'my_role',
        'short_description',
        'thumbnail_url',
        'external_link',
    ];

    /**
     * Boot function untuk generate slug otomatis saat simpan data.
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($portfolio) {
            if (empty($portfolio->slug)) {
                $portfolio->slug = Str::slug($portfolio->project_name) . '-' . Str::random(5);
            }
        });
    }

    /**
     * Relasi ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Mendapatkan Badge Warna berdasarkan tipe proyek.
     * Sangat berguna untuk filter visual di UI.
     */
    public function getTypeStylesAttribute(): array
    {
        return match($this->type) {
            'web'      => ['bg' => '#e0f2fe', 'color' => '#0ea5e9', 'label' => 'Digital System'],
            'robotics' => ['bg' => '#fef3c7', 'color' => '#d97706', 'label' => 'Hardware Innovation'],
            'social'   => ['bg' => '#fce7f3', 'color' => '#db2777', 'label' => 'Social Impact'],
            'research' => ['bg' => '#f3e8ff', 'color' => '#9333ea', 'label' => 'Research & Data'],
            'event'    => ['bg' => '#ecfdf5', 'color' => '#059669', 'label' => 'Program Management'],
            default    => ['bg' => '#f1f5f9', 'color' => '#475569', 'label' => 'Other Project'],
        };
    }
}

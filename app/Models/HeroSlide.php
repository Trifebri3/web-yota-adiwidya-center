<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_id',
        'title',
        'category',
        'summary',
        'image',
        'button_text',
        'button_link',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order'     => 'integer',
    ];

    /**
     * Relasi ke artikel publikasi (opsional jika ditautkan ke publication)
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }

    /**
     * Scope untuk slide yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk pengurutan tampilan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc')->orderBy('id', 'desc');
    }

    /**
     * Accessor URL Gambar
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
                return $this->image;
            }
            return asset('storage/' . $this->image);
        }

        if ($this->publication && $this->publication->banner) {
            return asset('storage/' . $this->publication->banner);
        }

        return 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=1920&q=80';
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Skill extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'proficiency_percent',
    ];

    /**
     * Relasi ke User.
     * Skill ini dimiliki oleh satu user tertentu.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Mendapatkan label warna berdasarkan kategori.
     * Berguna untuk styling badge di Blade.
     */
    public function getColorAttribute(): string
    {
        return match($this->category) {
            'web'      => '#BEF264', // Lemon Yota
            'mobile'   => '#3b82f6', // Blue
            'ai_iot'   => '#8b5cf6', // Purple
            'hardware' => '#f59e0b', // Orange
            default    => '#94a3b8',
        };
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdditionalSkill extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'skill_name',
        'skill_type', // language, soft_skill, hobby_tech
        'proficiency_level', // Beginner, Intermediate, Expert, Native
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Mendapatkan label warna berdasarkan tipe kemampuan.
     */
    public function getTypeColorAttribute(): string
    {
        return match($this->skill_type) {
            'language'   => '#0ea5e9', // Blue
            'soft_skill' => '#10b981', // Green
            'hobby_tech' => '#f59e0b', // Orange
            default      => '#64748b',
        };
    }
}

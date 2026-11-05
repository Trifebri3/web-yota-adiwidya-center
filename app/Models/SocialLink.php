<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialLink extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'platform_name',
        'url',
        'icon_class',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Mendapatkan Icon Brand secara otomatis jika icon_class kosong.
     * Menggunakan standar FontAwesome classes.
     */
    public function getBootstrapIconAttribute(): string
    {
        if ($this->icon_class) {
            return $this->icon_class;
        }

        return match (strtolower($this->platform_name)) {
            'github'    => 'fab fa-github',
            'linkedin'  => 'fab fa-linkedin',
            'instagram' => 'fab fa-instagram',
            'youtube'   => 'fab fa-youtube',
            'whatsapp'  => 'fab fa-whatsapp',
            'tiktok'    => 'fab fa-tiktok',
            default     => 'fas fa-link',
        };
    }
}

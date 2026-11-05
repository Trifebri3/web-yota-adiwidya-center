<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Identity extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang didefinisikan secara eksplisit (Opsional)
     */
    protected $table = 'identities';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     */
    protected $fillable = [
        'user_id',
        'full_name',
        'professional_title',
        'tagline',
        'about_me',
        'avatar_image',
        'cv_pdf_path',
    ];

    /**
     * Relasi ke model User (Inverse Relationship).
     * Setiap identitas hanya dimiliki oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor untuk mendapatkan URL lengkap foto profil (Helper).
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar_image) {
            return asset('storage/' . $this->avatar_image);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name) . '&background=BEF264&color=052c24';
    }
}

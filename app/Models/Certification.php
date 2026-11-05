<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certification extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'cert_name',
        'issuing_organization',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
    ];

    /**
     * Casting atribut ke tipe data Carbon.
     */
    protected $casts = [
        'issue_date'  => 'datetime',
        'expiry_date' => 'datetime',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Mengecek apakah sertifikat masih berlaku.
     */
    public function getIsExpiredAttribute(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }

        return $this->expiry_date->isPast();
    }

    /**
     * Helper: Menampilkan info sertifikat secara ringkas.
     */
    public function getShortInfoAttribute(): string
    {
        return "{$this->cert_name} by {$this->issuing_organization}";
    }
}

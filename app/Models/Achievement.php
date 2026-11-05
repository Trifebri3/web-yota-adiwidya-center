<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Achievement extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'award_name',
        'institution',
        'attained_year',
        'level', // regency, province, national, international
        'summary',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Mendapatkan label tingkatan prestasi dengan style.
     * Berguna untuk pewarnaan badge di UI.
     */
    public function getLevelDetailsAttribute(): array
    {
        return match($this->level) {
            'regency'      => ['label' => 'Tingkat Kabupaten', 'color' => '#64748b'],
            'province'     => ['label' => 'Tingkat Provinsi', 'color' => '#0ea5e9'],
            'national'     => ['label' => 'Tingkat Nasional', 'color' => '#f59e0b'],
            'international'=> ['label' => 'Tingkat Internasional', 'color' => '#8b5cf6'],
            default        => ['label' => 'Penghargaan', 'color' => '#94a3b8'],
        };
    }

    /**
     * Helper: Format tampilan judul prestasi yang kuat.
     * Contoh: "Juara 1 Pemuda Pelopor (2025)"
     */
    public function getDisplayTitleAttribute(): string
    {
        return "{$this->award_name} — {$this->attained_year}";
    }
}

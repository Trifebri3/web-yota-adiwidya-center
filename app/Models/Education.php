<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Education extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang didefinisikan secara eksplisit.
     */
    protected $table = 'educations';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date',
        'is_current',
        'achievements_summary',
    ];

    /**
     * Casting atribut ke tipe data Carbon & Boolean.
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Menampilkan rentang tahun pendidikan.
     * Contoh: "2021 — 2025" atau "2023 — Sekarang"
     */
    public function getYearRangeAttribute(): string
    {
        $startYear = $this->start_date->format('Y');
        $endYear = $this->is_current ? 'Sekarang' : ($this->end_date ? $this->end_date->format('Y') : '');

        return "{$startYear} — {$endYear}";
    }
}

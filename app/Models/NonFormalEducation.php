<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NonFormalEducation extends Model
{
    use HasFactory;

    /**
     * Nama tabel eksplisit (jamak).
     */
    protected $table = 'non_formal_educations';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'course_name',
        'provider',
        'duration',
        'completion_year',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Menampilkan info ringkas pelatihan.
     * Contoh: "Intensive German (Deutsche Sprache) - 2025"
     */
    public function getSummaryAttribute(): string
    {
        return "{$this->course_name} ({$this->provider}) — {$this->completion_year}";
    }
}

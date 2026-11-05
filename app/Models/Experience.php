<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Experience extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'company_name',
        'position',
        'start_date',
        'end_date',
        'is_active',
        'job_desc',
    ];

    /**
     * Casting atribut ke tipe data Carbon untuk memudahkan manipulasi tanggal.
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date'   => 'datetime',
        'is_active'  => 'boolean',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Menampilkan periode kerja yang rapi.
     * Contoh: "Jan 2023 - Present" atau "Jan 2023 - Dec 2023"
     */
    public function getDurationLabelAttribute(): string
    {
        $start = $this->start_date->format('M Y');
        $end = $this->is_active ? 'Present' : ($this->end_date ? $this->end_date->format('M Y') : '');

        return "{$start} — {$end}";
    }

    /**
     * Helper: Menghitung total durasi dalam bulan/tahun.
     */
    public function getWorkPeriodAttribute(): string
    {
        $end = $this->is_active ? Carbon::now() : $this->end_date;
        return $this->start_date->diffInMonths($end) . " months";
    }
}

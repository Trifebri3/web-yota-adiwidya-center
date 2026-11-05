<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proposal extends Model
{
    protected $fillable = [
        'user_id',
        'division_id',
        'reference_number',
        'title',
        'category',
        'description',
        'estimated_cost',
        'document_url',
        'status',
        'reviewer_id',
        'approver_id',
        'notes_from_reviewer',
        'notes_from_director',
        'reviewed_at',
        'approved_at'
    ];

    protected $casts = [
        'estimated_cost' => 'decimal:2',
        'reviewed_at'    => 'datetime',
        'approved_at'    => 'datetime',
    ];

    // --- RELASI ---

    /**
     * User yang mengajukan proposal
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Divisi asal proposal
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Pengawas/Admin yang mereview tahap awal
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    /**
     * Direktur yang memberikan persetujuan akhir
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approver_id');
    }

    // --- ACCESSORS (Untuk Tampilan di Blade) ---

    /**
     * Format estimated_cost ke Rupiah (e.g. Rp 1.500.000)
     */
    public function getFormattedCostAttribute(): string
    {
        return 'Rp ' . number_format($this->estimated_cost, 0, ',', '.');
    }

    /**
     * Helper Warna Status untuk Badge UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending'  => 'bg-slate-100 text-slate-500',
            'review'   => 'bg-blue-100 text-blue-600',
            'approved' => 'bg-emerald-500 text-white',
            'rejected' => 'bg-red-500 text-white',
            'revised'  => 'bg-amber-100 text-amber-700',
            default    => 'bg-slate-100 text-slate-500',
        };
    }

    /**
     * Format Label Category (Menghilangkan underscore)
     */
    public function getCategoryLabelAttribute(): string
    {
        return str_replace('_', ' ', ucfirst($this->category));
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($proposal) {
        // Otomatis buat nomor referensi jika kosong
        if (empty($proposal->reference_number)) {
            $proposal->reference_number = 'PROP-' . strtoupper(\Illuminate\Support\Str::random(8));
        }
    });
}
}

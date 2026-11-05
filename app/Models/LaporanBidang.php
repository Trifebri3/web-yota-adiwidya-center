<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanBidang extends Model
{
    use HasFactory;

    /**
     * Nama tabel eksplisit
     */
    protected $table = 'laporan_bidang';

    /**
     * Kolom yang dapat diisi secara massal
     */
    protected $fillable = [
        'division_id',
        'user_id',
        'title',
        'report_type',
        'report_date',
        'description',
        'instruction_link',
        'template_link',
        'report_link',
        'status',
        'feedback',
        'reviewed_at'
    ];

    /**
     * Casting tipe data
     * Memastikan tanggal menjadi objek Carbon dan reviewed_at menjadi datetime
     */
    protected $casts = [
        'report_date' => 'date',
        'reviewed_at' => 'datetime',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    /**
     * RELASI: Laporan ini milik satu Divisi
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * RELASI: Laporan ini dikirim oleh satu User (Kabid)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * SCOPE: Mengambil laporan yang perlu ditinjau oleh Direktur
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * SCOPE: Mengambil laporan berdasarkan tipe (contoh: 'Bulanan')
     */
    public function scopeByType($query, $type)
    {
        return $query->where('report_type', $type);
    }

    /**
     * HELPER: Mengecek status laporan secara cepat
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}

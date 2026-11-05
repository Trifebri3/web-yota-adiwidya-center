<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KabidPengumuman extends Model
{
    use HasFactory;

    /**
     * Nama tabel eksplisit sesuai permintaan Anda
     */
    protected $table = 'kabid_pengumuman';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'division_id',
        'user_id',
        'title',
        'content',
        'priority',
        'is_active'
    ];

    /**
     * Casting tipe data agar lebih mudah dikelola (Carbon object & Boolean)
     */
    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi: Pengumuman ini milik satu Divisi tertentu
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Relasi: Pengumuman ini dibuat oleh satu User (Kabid)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope: Mempermudah pengambilan pengumuman yang aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Mempermudah pengambilan pengumuman per divisi
     */
    public function scopeByDivision($query, $divisionId)
    {
        return $query->where('division_id', $divisionId);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class PortfolioOrganization extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang didefinisikan secara eksplisit.
     */
    protected $table = 'portfolio_organizations';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'organization_name',
        'position',
        'start_date',
        'end_date',
        'contribution_desc',
        'org_logo',
    ];

    /**
     * Casting atribut ke tipe data Carbon.
     */
    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /**
     * Relasi ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helper: Menampilkan status kepengurusan.
     * Contoh: "Founder & Director (2023 — Sekarang)"
     */
    public function getFullStatusAttribute(): string
    {
        $startYear = Carbon::parse($this->start_date)->format('Y');
        $endYear = $this->end_date ? Carbon::parse($this->end_date)->format('Y') : 'Sekarang';

        return "{$this->position} @ {$this->organization_name} ({$startYear} — {$endYear})";
    }

    /**
     * Accessor untuk mendapatkan Logo Organisasi.
     */
    public function getLogoUrlAttribute(): string
    {
        if ($this->org_logo) {
            return asset('storage/' . $this->org_logo);
        }

        // Fallback ke inisial nama organisasi jika logo tidak ada
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->organization_name) . '&background=052c24&color=BEF264&bold=true';
    }
}

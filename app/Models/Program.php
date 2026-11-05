<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'banner_image', 'published_by',
        'goal', 'target_audience', 'methodology',
        'location_name', 'location_link', 'coordinates',
        'quota_total', 'quota_used', 'target_amount', 'current_amount',
        'start_date', 'end_date', 'status',
        'impact_summary', 'impact_stats', 'curated_story'
    ];

    // WAJIB: Cast semua field multibahasa ke array agar tersimpan sebagai JSON
    protected $casts = [
        'title' => 'array',
        'goal' => 'array',
        'target_audience' => 'array',
        'methodology' => 'array',
        'impact_summary' => 'array',
        'curated_story' => 'array',
        'impact_stats' => 'array',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    /**
     * Logic Donasi Opsional
     * Jika target_amount = 0, maka fitur donasi dianggap tidak aktif
     */
    public function getHasDonationAttribute()
    {
        return $this->target_amount > 0;
    }

    /**
     * Logic Hitung Mundur (Countdown)
     * Menghasilkan string sisa waktu yang human-readable
     */
    public function getTimeRemainingAttribute()
    {
        $now = Carbon::now();
        $target = ($this->status == 'upcoming') ? $this->start_date : $this->end_date;

        if ($now->gt($target)) return '00:00:00';

        $diff = $now->diff($target);
        return sprintf('%02d Hari, %02d Jam', $diff->d, $diff->h);
    }

    public function getDonationPercentageAttribute()
    {
        if ($this->target_amount <= 0) return 0;
        return min(100, round(($this->current_amount / $this->target_amount) * 100, 1));
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'upcoming' => ['text' => 'Upcoming', 'color' => 'bg-blue-600', 'id_text' => 'Akan Datang'],
            'ongoing'  => ['text' => 'Live Now', 'color' => 'bg-lime-500', 'id_text' => 'Sedang Jalan'],
            'history'  => ['text' => 'Completed', 'color' => 'bg-slate-500', 'id_text' => 'Selesai'],
            default    => ['text' => 'Unknown', 'color' => 'bg-black', 'id_text' => 'N/A'],
        };
    }


    // app/Models/Program.php

/**
 * Scope untuk memfilter Program yang sedang berjalan atau akan datang
 * Dipanggil di Blade/Controller sebagai Program::active()
 */
public function scopeActive($query)
{
    return $query->whereIn('status', ['upcoming', 'ongoing']);
}

/**
 * Scope untuk memfilter Riwayat
 */
public function scopeHistory($query)
{
    return $query->where('status', 'history');
}

/**
 * Relasi Many-to-Many ke Impact Areas (Pilar Program)
 */
public function impactAreas()
{
    return $this->belongsToMany(ImpactArea::class, 'program_impact_areas');
}
}

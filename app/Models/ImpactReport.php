<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImpactReport extends Model
{
    protected $fillable = [
        'title', 'slug', 'category', 'description', 'cover_image',
        'pdf_path', 'goals', 'targets', 'location', 'methodology','province',      // Pastikan ada
    'impact_value',  // TAMBAHKAN INI
        'stats_data', 'impact_stories', 'published_at', 'is_verified'
    ];

    protected $casts = [
        'title' => 'json', 'description' => 'json', 'goals' => 'json',
        'targets' => 'json', 'methodology' => 'json', 'stats_data' => 'json',
        'impact_stories' => 'json', 'published_at' => 'date', 'impact_value' => 'float'
    ];

    protected static function boot() {
        parent::boot();
        static::creating(fn($model) => $model->slug = Str::slug($model->title['id']) . '-' . Str::random(5));
    }

    // app/Models/ImpactReport.php

public static function getLatestFootprint()
{
    // Mengambil laporan terbaru yang memiliki data statistik
    return self::where('is_verified', true)
               ->whereNotNull('stats_data')
               ->latest()
               ->first();
}
// app/Models/ImpactReport.php

public static function getGlobalStatistics()
{
    $allReports = self::where('is_verified', true)->get();
    $totals = [];

    foreach ($allReports as $report) {
        if ($report->stats_data) {
            foreach ($report->stats_data as $stat) {
                // Buat slug key yang unik agar "Anak" dan "anak" dianggap sama
                $key = \Illuminate\Support\Str::slug($stat['label_id']);

                // Bersihkan angka: Hapus semua karakter kecuali angka dan titik/koma
                $cleanValue = preg_replace('/[^0-9.]/', '', $stat['value']);
                $value = (float) $cleanValue;

                // Ambil simbol (seperti +, %, k) untuk ditampilkan di UI
                $symbol = preg_replace('/[0-9.,]/', '', $stat['value']);

                if (!isset($totals[$key])) {
                    $totals[$key] = [
                        'value' => 0,
                        'label_id' => $stat['label_id'],
                        'label_en' => $stat['label_en'] ?? $stat['label_id'],
                        'sub_id' => $stat['sub_id'] ?? '',
                        'symbol' => $symbol ?: '+' // Default + jika tidak ada simbol
                    ];
                }
                $totals[$key]['value'] += $value;
            }
        }
    }

    // Mengembalikan semua koleksi (Tanpa take(4)) agar tabel bisa menampilkan semuanya
    return collect($totals)->sortByDesc('value');
}
// app/Models/ImpactReport.php

public static function getImpactTrends()
{
    // Mengambil data 6 bulan terakhir untuk grafik
    return self::where('is_verified', true)
        ->selectRaw('MONTHNAME(published_at) as month, COUNT(*) as total_reports')
        ->groupBy('month')
        ->orderBy('published_at', 'ASC')
        ->get();
}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DocPublication extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * @var string
     */
    protected $table = 'doc_publications';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'cover_image',
        'pdf_path',
        'published_at',
        'is_verified',
    ];

    /**
     * Konversi tipe data otomatis (Casting).
     * @var array
     */
    protected $casts = [
        'published_at' => 'date',
'title' => 'array',
        'category_label' => 'array',
        'is_verified' => 'boolean',
    ];

    /**
     * Boot function untuk menghandle event model.
     * Otomatis membuat slug saat judul diinput.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($doc) {
            if (empty($doc->slug)) {
                $doc->slug = Str::slug($doc->title) . '-' . Str::lower(Str::random(5));
            }
        });
    }

    /**
     * HELPER: Mendapatkan Label Kategori yang Cantik
     * Contoh: 'annual_report' menjadi 'Annual Report'
     */
    public function getCategoryLabelAttribute()
    {
        $labels = [
            'buku'               => 'Buku & Monograf',
            'annual_report'      => 'Annual Report',
            'policy_brief'      => 'Policy Brief / Research Highlight',
            'official_statement' => 'Pernyataan Resmi Organisasi',
        ];

        return $labels[$this->category] ?? 'Buku & Monograf';
    }

    /**
     * HELPER: Mendapatkan Warna Tag untuk kategori (UI/UX)
     */
    public function getCategoryColorAttribute()
    {
        $colors = [
            'buku'               => 'bg-emerald-100 text-emerald-800',
            'annual_report'      => 'bg-blue-100 text-blue-700',
            'policy_brief'      => 'bg-purple-100 text-purple-700',
            'official_statement' => 'bg-amber-100 text-amber-700',
        ];

        return $colors[$this->category] ?? 'bg-slate-100 text-slate-700';
    }

    /**
     * SCOPE: Memudahkan filter naskah yang sudah terverifikasi
     */
    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    /**
     * SCOPE: Filter berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
    }

    // app/Models/DocPublication.php

public static function getGallery()
{
    return self::verified()->latest()->get();
}
}

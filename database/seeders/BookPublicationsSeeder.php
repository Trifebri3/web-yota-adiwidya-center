<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DocPublication;
use Illuminate\Support\Carbon;

class BookPublicationsSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Buku Panduan Strategis 6 Pilar: Menenun Keberlanjutan Komunitas & Konservasi Nusantara',
                'slug' => 'buku-panduan-strategis-6-pilar-yota',
                'category' => 'buku',
                'description' => 'Buku pedoman komprehensif implementasi 6 pilar strategis Yayasan Yota Wujudkan Asa. Membahas metodologi intervensi lapangan, indikator dampak terverifikasi, serta model integrasi sains terapan dan kearifan lokal.',
                'cover_image' => 'pilar/pilar2/Purple Knowledge Mosaic Poster.png',
                'pdf_path' => 'https://drive.google.com/file/d/1DbOEOOHNIRAQjfxxMm-SoBOev8PU8n3E/view?usp=sharing',
                'published_at' => Carbon::parse('2026-02-15'),
                'is_verified' => true,
            ],
            [
                'title' => 'Monograf Riset Terapan: Adopsi Sensor AgroSense & IoT Presisi Berbasis Desa',
                'slug' => 'monograf-riset-agrosense-iot-presisi-desa',
                'category' => 'buku',
                'description' => 'Hasil riset lapangan implementasi sensor tanah nirkabel dan kecerdasan buatan terapan di sentra pertanian Jawa Barat. Kajian mendalam efisiensi irigasi, prediksi kelembaban mikroklimat, dan peningkatan produktivitas panen kelompok tani.',
                'cover_image' => 'pilar/pilar3/Teal Innovation Research Grid.png',
                'pdf_path' => 'https://drive.google.com/file/d/1DbOEOOHNIRAQjfxxMm-SoBOev8PU8n3E/view?usp=sharing',
                'published_at' => Carbon::parse('2026-01-20'),
                'is_verified' => true,
            ],
            [
                'title' => 'Buku Saku Mitigasi Mandiri & Panduan Sekolah Tangguh Sesar Aktif',
                'slug' => 'buku-saku-mitigasi-mandiri-sekolah-tangguh-sesar',
                'category' => 'buku',
                'description' => 'Panduan praktis berilustrasi ramah anak untuk kesiapsiagaan bencana gempa bumi dan sesar aktif di lingkungan sekolah dasar dan madrasah. Dilengkapi modul simulasi evakuasi, standardisasi tas siaga, dan komunikasi darurat warga.',
                'cover_image' => 'pilar/pilar1/Disaster Resilience Mosaic Poster.png',
                'pdf_path' => 'https://drive.google.com/file/d/1DbOEOOHNIRAQjfxxMm-SoBOev8PU8n3E/view?usp=sharing',
                'published_at' => Carbon::parse('2025-11-10'),
                'is_verified' => true,
            ],
        ];

        foreach ($books as $b) {
            DocPublication::updateOrCreate(
                ['slug' => $b['slug']],
                $b
            );
        }
    }
}


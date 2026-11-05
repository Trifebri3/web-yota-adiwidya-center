<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            // --- KELOMPOK YOTA ADIWIDYA CENTER (Profesional & Organisasi) ---
            [
                'name' => 'Social Innovation',
                'description' => 'Eksplorasi ide dan implementasi inovasi sosial untuk masyarakat.',
            ],
            [
                'name' => 'Community Development',
                'description' => 'Strategi dan dokumentasi pengembangan komunitas berkelanjutan.',
            ],
            [
                'name' => 'Education Technology',
                'description' => 'Transformasi pendidikan melalui alat dan metodologi digital.',
            ],
            [
                'name' => 'Youth Empowerment',
                'description' => 'Program dan inspirasi untuk pemberdayaan generasi muda.',
            ],
            [
                'name' => 'Organizational Culture',
                'description' => 'Membangun ekosistem kerja yang sehat dan produktif di Yota.',
            ],

            // --- KELOMPOK RISET & ILMIAH (Scientific/Academic) ---
            [
                'name' => 'Academic Research',
                'description' => 'Publikasi hasil riset, metodologi, dan temuan ilmiah.',
            ],
            [
                'name' => 'Digital Strategy',
                'description' => 'Analisis mendalam mengenai tren digital dan strategi masa depan.',
            ],
            [
                'name' => 'Data Analytics',
                'description' => 'Pemanfaatan data untuk pengambilan keputusan berbasis bukti.',
            ],

            // --- KELOMPOK PRIBADI (Personal & Lifestyle) ---
            [
                'name' => 'Self Development',
                'description' => 'Catatan perjalanan tentang pertumbuhan diri dan habit.',
            ],
            [
                'name' => 'Leadership Insights',
                'description' => 'Refleksi pribadi mengenai kepemimpinan dan manajemen tim.',
            ],
            [
                'name' => 'Daily Journal',
                'description' => 'Cerita santai dan pengalaman harian di balik layar.',
            ],
            [
                'name' => 'Book Review',
                'description' => 'Bedah buku dan poin-poin penting dari bacaan pilihan.',
            ],

            // --- KELOMPOK UMUM (General/Public) ---
            [
                'name' => 'Tech Trends',
                'description' => 'Update terbaru mengenai teknologi secara umum.',
            ],
            [
                'name' => 'Tips & Tricks',
                'description' => 'Panduan praktis untuk berbagai kebutuhan teknis dan non-teknis.',
            ],
            [
                'name' => 'Public Opinion',
                'description' => 'Sudut pandang mengenai isu-isu yang sedang hangat di publik.',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}

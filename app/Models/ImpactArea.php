<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ImpactArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'slug',
        'name',
        'tagline',
        'color',
        'logo',
        'motif',
        'banner',
        'description',
        'focus_areas',
        'example_programs',
        'target_beneficiaries',
        'strategic_direction',
        'expected_outcomes',
        'what_desc',
        'why_desc',
        'who_desc',
        'where_desc',
        'when_desc',
        'how_desc',
        'stats',
        'order',
        'is_active',
    ];

    protected $casts = [
        'focus_areas'      => 'array',
        'example_programs' => 'array',
        'stats'            => 'array',
        'is_active'        => 'boolean',
        'order'            => 'integer',
    ];

    /**
     * Relasi Many-to-Many ke Programs
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'program_impact_areas');
    }

    /**
     * Accessor Logo URL
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('image/yt.png');
        }
        if (str_starts_with($this->logo, 'http://') || str_starts_with($this->logo, 'https://')) {
            return $this->logo;
        }
        if (str_starts_with($this->logo, 'pilar/')) {
            return asset($this->logo);
        }
        return asset('storage/' . $this->logo);
    }

    /**
     * Accessor Motif URL
     */
    public function getMotifUrlAttribute()
    {
        if (!$this->motif) {
            return asset('image/yt.png');
        }
        if (str_starts_with($this->motif, 'http://') || str_starts_with($this->motif, 'https://')) {
            return $this->motif;
        }
        if (str_starts_with($this->motif, 'pilar/')) {
            return asset($this->motif);
        }
        return asset('storage/' . $this->motif);
    }

    /**
     * Accessor Banner URL
     */
    public function getBannerUrlAttribute()
    {
        if ($this->banner) {
            if (str_starts_with($this->banner, 'http://') || str_starts_with($this->banner, 'https://')) {
                return $this->banner;
            }
            return asset('storage/' . $this->banner);
        }
        return $this->motif_url;
    }

    /**
     * Data Standar 6 Pilar Strategis (Fallback & Initial Data)
     */
    public static function getDefaultPillars()
    {
        return collect([
            (object)[
                'id' => 1,
                'code' => '01',
                'slug' => 'youth-development',
                'name' => 'Youth Development',
                'tagline' => 'Empowering the Next Generation of Leaders & Innovators',
                'color' => '#0361a4',
                'logo_url' => asset('pilar/pilar6/6.png'),
                'motif_url' => asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png'),
                'banner_url' => asset('pilar/pilar6/Blue Mosaic Youth Development Icons.png'),
                'description' => 'Membangun kapasitas kepemimpinan, kapabilitas digital, dan integritas moral generasi muda Indonesia melalui pendidikan STEAM, kerelawanan, dan pengembangan inisiatif sosial berkelanjutan.',
                'focus_areas' => [
                    'Youth Development & Leadership',
                    'Education & E-Learning',
                    'Volunteer Activities',
                    'Youth Events & Seminars',
                    'Capacity Building & STEAM'
                ],
                'example_programs' => [
                    'YOTA Hub',
                    'CAP 2026',
                    'Youth Volunteer Initiative',
                    'Youth Leadership Incubator',
                    'National Youth Seminar'
                ],
                'target_beneficiaries' => 'Pelajar, mahasiswa, peneliti muda, dan komunitas pemuda di seluruh Indonesia.',
                'strategic_direction' => 'Mencetak 10.000 pemuda berdaya saing global yang berakar pada kearifan lokal.',
                'what_desc' => 'Fokus pada pengembangan holistik generasi muda mencakup intelektual, kepemimpinan, dan etika kemanusiaan.',
                'why_desc' => 'Bonus demografi Indonesia membutuhkan pemuda yang tidak hanya cakap teknologi tetapi memiliki integritas sosial.',
                'who_desc' => 'Generasi muda, akademisi, mentor industri, dan organisasi kepemudaan tingkat nasional.',
                'where_desc' => 'Pusat pembelajaran YOTA, universitas mitra, dan platform digital nasional.',
                'when_desc' => 'Program berkelanjutan sepanjang tahun dengan akselerasi intensif semesteran.',
                'how_desc' => 'Melalui bootcamp STEAM, mentoring intensif, proyek kerelawanan langsung di lapangan.',
                'stats' => [
                    ['label' => 'Youth Reached', 'value' => '12.500+'],
                    ['label' => 'Active Volunteers', 'value' => '1.200+'],
                    ['label' => 'Programs Held', 'value' => '48+'],
                    ['label' => 'Partner Campuses', 'value' => '35+'],
                ]
            ],
            (object)[
                'id' => 2,
                'code' => '02',
                'slug' => 'community-empowerment',
                'name' => 'Community Empowerment',
                'tagline' => 'Fostering Resilient Local Economies & Self-Reliant Villages',
                'color' => '#b8984b',
                'logo_url' => asset('pilar/pilar5/5.png'),
                'motif_url' => asset('pilar/pilar5/Earthy Community Empowerment Mosaic.png'),
                'banner_url' => asset('pilar/pilar5/Earthy Community Empowerment Mosaic.png'),
                'description' => 'Mengakselerasi kemandirian komunitas lokal dan desa binaan melalui pendampingan UMKM, digitalisasi rantai pasok, penguatan kelembagaan warga, dan pemberdayaan pertanian berkelanjutan.',
                'focus_areas' => [
                    'Community Development',
                    'UMKM Empowerment',
                    'Agricultural Development',
                    'Village Digitalization',
                    'Local Economic Institutions'
                ],
                'example_programs' => [
                    'Pemberdayaan Sikawung',
                    'Community Digitalization Hub',
                    'UMKM Go Global',
                    'Agricultural Community Empowerment',
                    'Free Website Program for Villages'
                ],
                'target_beneficiaries' => 'Pelaku UMKM, kelompok tani, perempuan kepala keluarga, dan kelembagaan desa.',
                'strategic_direction' => 'Membangun ekosistem ekonomi sirkular berbasis potensi komoditas unggulan desa.',
                'what_desc' => 'Pemberdayaan terintegrasi dari hulu ke hilir untuk peningkatan pendapatan dan ketahanan komunitas.',
                'why_desc' => 'Kesenjangan ekonomi desa dan kota memerlukan jembatan teknologi dan akses pasar yang adil.',
                'who_desc' => 'Masyarakat pedesaan, koperasi lokal, dinas terkait, dan pembeli strategis.',
                'where_desc' => 'Desa-desa percontohan di Jawa Barat, Jawa Tengah, dan wilayah 3T.',
                'when_desc' => 'Pendampingan multi-tahun dengan evaluasi dampak terukur setiap kuartal.',
                'how_desc' => 'Pelatihan tata kelola bisnis, digital marketing, bantuan sarana produksi, dan pendampingan lapangan.',
                'stats' => [
                    ['label' => 'Assisted Communities', 'value' => '85+'],
                    ['label' => 'UMKM Empowered', 'value' => '420+'],
                    ['label' => 'Farmer Groups', 'value' => '65+'],
                    ['label' => 'Villages Connected', 'value' => '110+'],
                ]
            ],
            (object)[
                'id' => 3,
                'code' => '03',
                'slug' => 'environmental-conservation',
                'name' => 'Environmental Conservation',
                'tagline' => 'Protecting Biodiversity & Restoring Natural Ecosystems',
                'color' => '#34763d',
                'logo_url' => asset('pilar/pilar4/4.png'),
                'motif_url' => asset('pilar/pilar4/Green Mosaic of Biodiversity Icons (1).png'),
                'banner_url' => asset('pilar/pilar4/Green Mosaic of Biodiversity Icons (1).png'),
                'description' => 'Melindungi keanekaragaman hayati nusantara, merestorasi bentang alam kritis, mengedukasi masyarakat sadar lingkungan, serta memadukan sistem monitoring cerdas dalam pelestarian hutan dan mata air.',
                'focus_areas' => [
                    'Forest Conservation',
                    'Biodiversity Monitoring',
                    'Ecosystem Restoration',
                    'Environmental Education',
                    'Community-Based Conservation'
                ],
                'example_programs' => [
                    'BIOTAG Initiative',
                    'Forest Conservation & Reforestation',
                    'Biodiversity Census & Tracking',
                    'School Environmental Education',
                    'Clean Water Source Guardians'
                ],
                'target_beneficiaries' => 'Masyarakat lingkar hutan, kawasan konservasi, generasi muda, dan ekosistem alam.',
                'strategic_direction' => 'Pemulihan 5.000 hektar habitat kritis dengan pelibatan aktif masyarakat lokal.',
                'what_desc' => 'Upaya konservasi terpadu berbasis sains lingkungan dan kearifan ekologis leluhur.',
                'why_desc' => 'Krisis iklim dan hilangnya keanekaragaman hayati mengancam daya dukung kehidupan di bumi.',
                'who_desc' => 'Polisi hutan, peneliti biologi, kelompok tani hutan, dan pegiat alam.',
                'where_desc' => 'Kawasan hutan lindung, koridor satwa, hulu daerah aliran sungai (DAS).',
                'when_desc' => 'Penanaman periodik saat musim hujan dan pemantauan satwa berkala sepanjang tahun.',
                'how_desc' => 'Penanaman pohon endemik, pemasangan sensor kamera jebak, dan patroli partisipatif warga.',
                'stats' => [
                    ['label' => 'Trees Planted', 'value' => '250.000+'],
                    ['label' => 'Land Restored (Ha)', 'value' => '1.850'],
                    ['label' => 'Monitored Species', 'value' => '320+'],
                    ['label' => 'Water Springs Saved', 'value' => '42'],
                ]
            ],
            (object)[
                'id' => 4,
                'code' => '04',
                'slug' => 'innovation-research',
                'name' => 'Innovation & Research',
                'tagline' => 'Advancing Applied Science, AI & IoT for Social Good',
                'color' => '#04717f',
                'logo_url' => asset('pilar/pilar3/3.png'),
                'motif_url' => asset('pilar/pilar3/Teal Innovation Research Grid.png'),
                'banner_url' => asset('pilar/pilar3/Teal Innovation Research Grid.png'),
                'description' => 'Mengembangkan riset terapan dan rekayasa teknologi tepat guna berbasis Kecerdasan Buatan (AI) dan Internet of Things (IoT) untuk menjawab tantangan pertanian cerdas, efisiensi energi, dan layanan publik.',
                'focus_areas' => [
                    'Artificial Intelligence (AI)',
                    'Internet of Things (IoT)',
                    'Applied Research & Prototyping',
                    'Smart Agriculture Technology',
                    'Civic Tech & Open Data'
                ],
                'example_programs' => [
                    'Smart Agriculture AgroSense',
                    'AI Innovation for Disaster Early Warning',
                    'IoT Field Sensor Deployment',
                    'Social Tech R&D Lab',
                    'Open Science Collaboration'
                ],
                'target_beneficiaries' => 'Inovator, peneliti terapan, petani cerdas, dan lembaga pelayanan publik.',
                'strategic_direction' => 'Menghasilkan teknologi berbiaya terjangkau dengan dampak masif pada ketahanan pangan dan lingkungan.',
                'what_desc' => 'Penelitian, perancangan prototipe perangkat keras/lunak, dan uji coba lapangan teknologi sosial.',
                'why_desc' => 'Teknologi tinggi harus dapat diakses dan bermanfaat langsung untuk masyarakat akar rumput.',
                'who_desc' => 'Engineer, data scientist, akademisi teknologi rekayasa, dan mitra industri.',
                'where_desc' => 'Laboratorium Litbang YOTA dan sentra agrikultur presisi terintegrasi.',
                'when_desc' => 'Siklus riset berkelanjutan dengan publikasi berkala setiap semester.',
                'how_desc' => 'Riset kolaboratif, perakitan sensor mikroelektronika mandiri, dan integrasi cloud analytics.',
                'stats' => [
                    ['label' => 'Prototypes Built', 'value' => '28'],
                    ['label' => 'IoT Nodes Active', 'value' => '150+'],
                    ['label' => 'Research Papers', 'value' => '34'],
                    ['label' => 'Innovation Patents', 'value' => '6'],
                ]
            ],
            (object)[
                'id' => 5,
                'code' => '05',
                'slug' => 'disaster-resilience',
                'name' => 'Disaster Resilience',
                'tagline' => 'Building Prepared Communities & Rapid Emergency Mitigation',
                'color' => '#8f2c2d',
                'logo_url' => asset('pilar/pilar1/1.png'),
                'motif_url' => asset('pilar/pilar1/Disaster Resilience Mosaic Poster.png'),
                'banner_url' => asset('pilar/pilar1/Disaster Resilience Mosaic Poster.png'),
                'description' => 'Memperkuat ketangguhan masyarakat di daerah rawan bencana melalui mitigasi dini, edukasi keselamatan anak dan keluarga, simulasi kesiapsiagaan, serta teknologi pendeteksi bahaya darurat.',
                'focus_areas' => [
                    'Disaster Mitigation & Early Warning',
                    'Child & Family Safety Education',
                    'Emergency Preparedness & Simulation',
                    'Community Resilience Network',
                    'Post-Disaster Recovery Support'
                ],
                'example_programs' => [
                    'YOTA Bencana Rescue & Response',
                    'Jaga Bencana Anak (School Safety)',
                    'Community Early Warning Drill',
                    'Disaster Mitigation Tech Deployment',
                    'Family Preparedness Survival Kit'
                ],
                'target_beneficiaries' => 'Warga pesisir, perbukitan rawan longsor, sekolah di zona merah, dan relawan SAR.',
                'strategic_direction' => 'Nol korban jiwa melalui peningkatan kesadaran dan kecepatan evakuasi mandiri warga.',
                'what_desc' => 'Sistem kesiapsiagaan bencana komprehensif mulai dari pra-bencana, tanggap darurat, hingga pasca-bencana.',
                'why_desc' => 'Indonesia berada di cincin api pasifik; kesiapsiagaan adalah kunci mutlak menyelamatkan nyawa.',
                'who_desc' => 'BPBD, relawan kemanusiaan, guru sekolah, dan gugus tugas bencana desa.',
                'where_desc' => 'Wilayah pesisir tsunami, zona patahan aktif gempa, dan lereng rawan longsor.',
                'when_desc' => 'Edukasi rutin bulanan dan respons siaga darurat 24/7.',
                'how_desc' => 'Simulasi evakuasi berkala, pembuatan jalur evakuasi aman, dan pemasangan sirene peringatan dini.',
                'stats' => [
                    ['label' => 'People Trained', 'value' => '18.400+'],
                    ['label' => 'Resilient Schools', 'value' => '92'],
                    ['label' => 'Simulation Drills', 'value' => '115'],
                    ['label' => 'Emergency Responses', 'value' => '24'],
                ]
            ],
            (object)[
                'id' => 6,
                'code' => '06',
                'slug' => 'knowledge-publication',
                'name' => 'Knowledge & Publication',
                'tagline' => 'Disseminating Open Knowledge & Evidence-Based Research',
                'color' => '#55307f',
                'logo_url' => asset('pilar/pilar2/2.png'),
                'motif_url' => asset('pilar/pilar2/Purple Knowledge Mosaic Poster.png'),
                'banner_url' => asset('pilar/pilar2/Purple Knowledge Mosaic Poster.png'),
                'description' => 'Mendokumentasikan, menelaah, dan mendiseminasikan kajian ilmiah serta laporan dampak sosial melalui publikasi jurnal terakreditasi, buku pedoman, dan diseminasi pengetahuan terbuka (open science).',
                'focus_areas' => [
                    'Scientific Publications & Journals',
                    'Research Dissemination & Policy Briefs',
                    'Knowledge Management System',
                    'Academic & Institution Collaboration',
                    'Community Service Documentation'
                ],
                'example_programs' => [
                    'YOTA Journal House',
                    'Journal of Technology Research & Community Service',
                    'Annual Impact Report Dissemination',
                    'Open Policy Brief Series',
                    'Scientific Book Publishing'
                ],
                'target_beneficiaries' => 'Dosen, peneliti, pembuat kebijakan, mahasiswa, dan masyarakat umum peminat sains.',
                'strategic_direction' => 'Menjadi pusat rujukan pengetahuan mitigasi bencana dan inovasi sosial terkemuka di Asia Tenggara.',
                'what_desc' => 'Pengelolaan penerbitan ilmiah berkala dan translasi riset menjadi rekomendasi kebijakan publik nyata.',
                'why_desc' => 'Inovasi tanpa dokumentasi ilmiah akan sulit direplikasi dan dikembangkan secara berkelanjutan.',
                'who_desc' => 'Dewan editor, mitra bestari internasional, penulis ilmiah, dan pustakawan institusi.',
                'where_desc' => 'Portal publikasi digital OJS YOTA dan perpustakaan repositori institusi mitra.',
                'when_desc' => 'Penerbitan jurnal terjadwal berkala setiap 6 bulan dan rilis kajian tematik.',
                'how_desc' => 'Peer-review ketat, indexing bereputasi, dan penerbitan open-access berstandar internasional.',
                'stats' => [
                    ['label' => 'Journal Editions', 'value' => '16'],
                    ['label' => 'Articles Published', 'value' => '142'],
                    ['label' => 'Reviewer Network', 'value' => '65+'],
                    ['label' => 'Total Citations', 'value' => '850+'],
                ]
            ],
        ]);
    }
}


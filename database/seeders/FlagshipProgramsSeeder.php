<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;
use Carbon\Carbon;

class FlagshipProgramsSeeder extends Seeder
{
    public function run()
    {
        $flagships = [
            [
                'slug' => 'yota-bencana',
                'title' => [
                    'id' => 'YOTA Bencana: Siaga & Mitigasi Cincin Api',
                    'en' => 'YOTA Disaster: Ring of Fire Early Mitigation'
                ],
                'banner_image' => 'pilar/pilar1/Disaster Resilience Mosaic Poster.png',
                'published_by' => 'Yayasan Yota Wujudkan Asa',
                'goal' => [
                    'id' => "Pemasangan sensor peringatan dini gempa mandiri di sekolah rentan, simulasi evakuasi mandiri anak, dan distribusi survival kit tanggap darurat di kawasan rawan bencana sesar aktif.\n\nInisiatif ini dirancang untuk memastikan kesiapsiagaan sekolah, guru, dan keluarga sebelum bencana tiba, meminimalkan korban jiwa melalui edukasi praktis berbasis kearifan lokal.",
                    'en' => "Installation of community earthquake early warning sensors in vulnerable schools, child evacuation simulations, and distribution of emergency survival kits along active fault lines."
                ],
                'target_audience' => [
                    'id' => '1.200 Siswa Sekolah Dasar, Relawan Muda Tanggap Darurat, & Komunitas RT/RW Rawan Bencana',
                    'en' => '1,200 Elementary School Students, Youth Emergency Volunteers, & High-Risk Ward Communities'
                ],
                'methodology' => [
                    'id' => 'Pelatihan Terintegrasi: Edukasi Komik Mitigasi, Audit Jalur Evakuasi Sekolah, & Simulasi Sirine Peringatan Dini Berbasis Sensor Komunitas.',
                    'en' => 'Integrated Training: Mitigation Comic Education, School Evacuation Path Audit, & Sensor-Based Early Warning Sirens.'
                ],
                'location_name' => 'Cianjur & Sesar Lembang, Jawa Barat',
                'location_link' => 'https://maps.google.com/?q=-6.8167,107.1333',
                'coordinates' => '-6.8167,107.1333',
                'quota_total' => 150,
                'quota_used' => 45,
                'target_amount' => 0,
                'current_amount' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(3),
                'status' => 'ongoing',
                'impact_summary' => [
                    'id' => '24 Sekolah Dasar dampingan memiliki SOP evakuasi mandiri terverifikasi dan sensor gempa aktif.',
                    'en' => '24 Target elementary schools have verified self-evacuation SOPs and active earthquake sensors.'
                ],
                'impact_stats' => ['schools' => 24, 'students' => 1200, 'volunteers' => 85],
            ],
            [
                'slug' => 'cap-2026',
                'title' => [
                    'id' => 'CAP 2026: Collaborative Action Program',
                    'en' => 'CAP 2026: Collaborative Action Program'
                ],
                'banner_image' => 'pilar/pilar6/Blue Mosaic Youth Development Icons.png',
                'published_by' => 'Yayasan Yota Wujudkan Asa',
                'goal' => [
                    'id' => "Inkubasi dan akselerasi inisiatif sosial kolaboratif pemuda dalam bidang STEAM, mitigasi bencana, dan ekonomi sirkular desa binaan.\n\nMemberikan ruang belajar intensif bagi 100 relawan muda terpilih untuk merancang dan mengeksekusi proyek nyata di komunitas akar rumput.",
                    'en' => "Incubation and acceleration of collaborative youth social initiatives in STEAM, disaster mitigation, and circular village economy."
                ],
                'target_audience' => [
                    'id' => '100 Pemuda & Mahasiswa Se-Indonesia',
                    'en' => '100 Youth & University Students Across Indonesia'
                ],
                'methodology' => [
                    'id' => 'Fasilitasi Bootcamp Daring, Pendampingan Mentor Praktisi, & Hibah Aksi Lapangan Komunitas.',
                    'en' => 'Online Bootcamp Facilitation, Practitioner Mentoring, & Community Field Action Grants.'
                ],
                'location_name' => 'Bandung & Wilayah Mitra Nasional',
                'location_link' => 'https://maps.google.com/?q=-6.9175,107.6191',
                'coordinates' => '-6.9175,107.6191',
                'quota_total' => 100,
                'quota_used' => 85,
                'target_amount' => 0,
                'current_amount' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(20),
                'status' => 'upcoming',
                'impact_summary' => [
                    'id' => '10 Inisiatif sosial pemuda terdanai dan terimplementasi di 10 desa mitra.',
                    'en' => '10 Youth social initiatives funded and implemented in 10 partner villages.'
                ],
                'impact_stats' => ['volunteers' => 100, 'projects' => 10, 'villages' => 10],
            ],
            [
                'slug' => 'smart-agriculture-agrosense',
                'title' => [
                    'id' => 'Inovasi AgroSense: Smart Agriculture Desa Binaan',
                    'en' => 'AgroSense Innovation: Smart Agriculture Partner Village'
                ],
                'banner_image' => 'pilar/pilar3/Teal Innovation Research Grid.png',
                'published_by' => 'Yayasan Yota Wujudkan Asa',
                'goal' => [
                    'id' => "Uji coba implementasi perangkat sensor tanah IoT terintegrasi cloud analytics untuk meningkatkan hasil panen dan efisiensi pengairan petani desa.\n\nMemungkinkan petani memantau kelembaban, pH tanah, dan kebutuhan nutrisi secara real-time melalui smartphone sederhana.",
                    'en' => "Implementation trial of IoT soil sensor devices integrated with cloud analytics to increase crop yields and irrigation efficiency."
                ],
                'target_audience' => [
                    'id' => '16 Kelompok Tani Desa Mitra Garut & Sumedang',
                    'en' => '16 Partner Farmer Groups in Garut & Sumedang'
                ],
                'methodology' => [
                    'id' => 'Pemasangan Sensor Telemetri, Pelatihan Aplikasi Tani Digital, & Monitoring Siklus Tanam Berbasis IoT.',
                    'en' => 'Telemetry Sensor Installation, Digital Farming App Training, & IoT-based Crop Cycle Monitoring.'
                ],
                'location_name' => 'Garut & Sumedang, Jawa Barat',
                'location_link' => 'https://maps.google.com/?q=-7.2279,107.9087',
                'coordinates' => '-7.2279,107.9087',
                'quota_total' => 50,
                'quota_used' => 18,
                'target_amount' => 0,
                'current_amount' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMonths(4),
                'status' => 'ongoing',
                'impact_summary' => [
                    'id' => 'Efisiensi air 40% dan peningkatan hasil panen cabai serta padi sebesar 25%.',
                    'en' => '40% water efficiency and 25% increase in chili and rice harvest yield.'
                ],
                'impact_stats' => ['sensors' => 32, 'farmers' => 240, 'hectares' => 50],
            ],
        ];

        foreach ($flagships as $data) {
            $program = Program::firstOrNew(['slug' => $data['slug']]);
            foreach ($data as $key => $val) {
                $program->{$key} = $val;
            }
            $program->save();
        }
    }
}


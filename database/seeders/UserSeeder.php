<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [

            // =====================
            // ADMIN & CORE SYSTEM
            // =====================
            [
                'name' => 'Admin Utama',
                'email' => 'admin@yota.com',
                'role' => UserRole::ADMIN,
            ],
            [
                'name' => 'OMC Media Center',
                'email' => 'omc@yota.com',
                'role' => UserRole::OMC,
            ],

            // =====================
            // STRUKTURAL
            // =====================
            [
                'name' => 'Angga N Nugraha, S.STP., M.Si',
                'email' => 'pembina@gmail.com',
                'role' => UserRole::PEMBINA,
            ],
            [
                'name' => 'Abdul Muhaemin, S.Pd',
                'email' => 'pengawasa@gmail.com',
                'role' => UserRole::PENGAWAS,
            ],
            [
                'name' => 'Tri Febriansah',
                'email' => 'trifebriansah321@gmail.com',
                'role' => UserRole::DIREKTUR,
            ],

            // =====================
            // KABID
            // =====================
            [
                'name' => 'Muhammad Ridho Fauzan',
                'email' => 'ridhosementara@yota',
                'role' => UserRole::KABID,
            ],
            [
                'name' => 'Gugun Rizal Nugraha, S.Kom',
                'email' => 'gugunsementara@yota',
                'role' => UserRole::KABID,
            ],
            [
                'name' => 'Azmi Faturrohman',
                'email' => 'azmifaturrohman2106@gmail.com',
                'role' => UserRole::KABID,
            ],
            [
                'name' => 'Bunga Anggia',
                'email' => 'bungasementara@yota',
                'role' => UserRole::KABID,
            ],
            [
                'name' => 'Salma Widiarti',
                'email' => 'Salmawidiarti231@gmail.com',
                'role' => UserRole::KABID,
            ],
            [
                'name' => 'Ricco Setiawan',
                'email' => 'rikosetiawan2707@gmail.com',
                'role' => UserRole::KABID,
            ],
            [
                'name' => 'Arib Abdulah Mufti',
                'email' => 'aribabdullahmufti@gmail.com',
                'role' => UserRole::KABID,
            ],

            // =====================
            // ANGGOTA
            // =====================
            ['name' => 'Amalia Zulfa Pritasari', 'email' => 'mbaamalsementara@yota', 'role' => UserRole::ANGGOTA],
            ['name' => 'Jauharotul MaftuchaH', 'email' => 'mbajosementara@yota', 'role' => UserRole::ANGGOTA],
            ['name' => 'Binta Athivata Tabriez', 'email' => 'binta.tabriez18@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Muhamad Ariq Numan', 'email' => 'mariqnuman@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Meyta Ayu Resandy', 'email' => 'meytaresandy@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Kiki Nurhayati', 'email' => 'kikinurhayati0509@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Rizky Aditia Fauzan', 'email' => 'rizkyaditiafauzan28@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Andita Raimawati', 'email' => 'raimawatiandita@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Agi', 'email' => 'agi.syaput22@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Syifa Fauziah Nurfadhilah', 'email' => 'nurfadhilahsyifa165@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Siti Aisyah Ayuwistira', 'email' => 'aisyahayuwistira@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Sastiani', 'email' => 'sastiani096@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Dyka Hatawa', 'email' => 'dhatawaa@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Nazwa Humaira Nurramadhani', 'email' => 'nazhwaa28@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Khansa Khairunnisa', 'email' => 'khansasakhairunnisa@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Mujahidah Nurul Azizah', 'email' => 'juhannd7@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Hilma Nur Halimah', 'email' => 'halimhnur2@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Eva Salsabila', 'email' => 'evasementara@yota', 'role' => UserRole::ANGGOTA],
            ['name' => 'Nadzar Nurhikmah', 'email' => 'nadzarsementara@yota', 'role' => UserRole::ANGGOTA],
            ['name' => 'Nadya Syifa Nayanti', 'email' => 'nnadyasyifaan@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Teja Arifudin', 'email' => 'tejaarifudin886@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Sely Rakhmah Maulina', 'email' => 'selimaulina29@gmail.com', 'role' => UserRole::ANGGOTA],
            ['name' => 'Wulan Sucina Dewi', 'email' => 'sucinalan11@gmail.com', 'role' => UserRole::ANGGOTA],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'role' => $user['role'],
                    'password' => Hash::make('password123'),
                ]
            );
        }
    }
}

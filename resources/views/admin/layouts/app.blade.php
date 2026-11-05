<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yota Foundation - Admin Panel')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --lemon: #D9E021;
            --lemon-hover: #C5CC1E;
            --white: #ffffff;
            --bg-body: #FBFBFB;
            --text-main: #2D3436;
            --text-muted: #999;
            --sidebar-width: 280px;
            --header-height: 80px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* --- LAYOUT WRAPPER --- */
        .app-layout {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            grid-template-rows: var(--header-height) 1fr auto;
            min-height: 100vh;
        }

        /* --- MAIN CONTENT AREA --- */
        /* Memastikan konten utama mengambil kolom kedua */
        .main-content {
            grid-column: 2 / 3;
            grid-row: 2 / 3;
            padding: 40px;
            min-height: calc(100vh - var(--header-height) - 100px);
        }

        /* --- RESPONSIVE FIXES --- */
        @media (max-width: 1024px) {
            .app-layout {
                grid-template-columns: 1fr;
            }

            /* Sembunyikan sidebar di mobile (kecuali ditambahkan class 'active' via JS) */
            .admin-sidebar {
                display: none;
            }

            .main-content,
            .admin-header,
            .admin-footer {
                grid-column: 1 / 2;
            }

            .main-content {
                padding: 20px;
            }
        }

        /* Tambahan Utility Class agar tampilan tidak 'AI Banget' */
        .card-custom {
            background: var(--white);
            border-radius: 16px;
            border: 1px solid #F0F0F0;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        }
        /* Menetralkan Main Content */
.main-content {
    all: unset; /* Reset semua style bawaan jika perlu */
    grid-column: 2 / 3;
    grid-row: 2 / 3;
    padding: 40px;
    background-color: #FBFBFB;
    display: block; /* Pastikan bukan flex agar tabel tidak gepeng */
}

/* Memperbaiki Tabel agar tidak pecah */
table {
    border-spacing: 0;
    width: 100%;
}

.card-custom {
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
}

    /* Menjinakkan Icon Panah Raksasa Laravel */
    .custom-pagination svg {
        width: 1.25rem !important; /* Ukuran icon jadi 20px */
        height: 1.25rem !important;
        display: inline-block;
    }

    /* Sembunyikan teks "Showing X to Y" bawaan Laravel agar lebih hemat ruang */
    .custom-pagination nav div:first-child {
        display: none !important;
    }

    /* Mempercantik tampilan angka/button pagination */
    .custom-pagination nav span[aria-current="page"] span {
        background-color: var(--lemon) !important;
        border-color: var(--lemon) !important;
        color: #222 !important;
        font-weight: 800;
        border-radius: 8px;
    }

    .custom-pagination nav a,
    .custom-pagination nav span {
        border-radius: 8px !important;
        margin: 0 2px;
        font-size: 12px !important;
    }
</style>


    @stack('styles')
</head>
<body>

    <div class="app-layout">

        {{-- 1. SIDEBAR (Harus di include pertama agar mengisi grid-row 1 s/d 4) --}}
        @include('admin.layouts.sidebar')

        {{-- 2. HEADER (Mengisi baris pertama, kolom kedua) --}}
        @include('admin.layouts.header')

        {{-- 3. CONTENT AREA --}}
        <main class="main-content">
            @yield('content')
        </main>

        {{-- 4. FOOTER (Mengisi baris terakhir, kolom kedua) --}}
        @include('admin.layouts.footer')

    </div>

    {{-- Script Stack untuk JS tambahan di halaman spesifik --}}
    @stack('scripts')

</body>
</html>

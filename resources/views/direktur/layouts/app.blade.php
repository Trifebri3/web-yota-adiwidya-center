<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Yota PIKP - Management System')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<style>
    :root {
        --yota-dark: #052c24;
        --yota-lemon: #BEF264;
        --sidebar-width: 290px;
        --header-height: 80px; /* Disesuaikan agar lebih rapat */
        --transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #F8FAFC;
        color: #334155;
        height: 100vh; /* Kunci tinggi body */
        overflow: hidden; /* Scroll hanya di area konten */
    }

    /* --- LAYOUT MASTER GRID --- */
    .app-layout {
        display: grid;
        grid-template-columns: var(--sidebar-width) 1fr;
        grid-template-rows: var(--header-height) 1fr auto; /* Baris 1 FIXED sesuai tinggi header */
        grid-template-areas:
            "sidebar header"
            "sidebar content"
            "sidebar footer";
        height: 100vh;
    }

    /* --- SIDEBAR --- */
    .admin-sidebar {
        grid-area: sidebar;
        background-color: var(--yota-dark);
        height: 100vh;
        position: sticky;
        top: 0;
        z-index: 50;
    }

    /* --- HEADER: Menempel Sempurna ke Atas --- */
    .admin-header {
        grid-area: header;
        height: var(--header-height);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border-bottom: 1px solid #F1F5F9;
        z-index: 40;
        /* Menghilangkan potensi gap */
        display: flex;
        align-items: center;
    }

    /* --- CONTENT: Area yang Bisa di-Scroll --- */
    .main-content {
        grid-area: content;
        padding: 20px 40px; /* Padding atas dikurangi agar konten lebih naik */
        overflow-y: auto;
        background-color: #FDFDFB;
        animation: slideUp 0.5s ease-out;
    }

    .admin-footer {
        grid-area: footer;
        background: #fff;
        padding: 15px 40px;
        border-top: 1px solid #F1F5F9;
    }

    /* --- ANIMATIONS --- */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* --- RESPONSIVE --- */
    @media (max-width: 1024px) {
        .app-layout {
            grid-template-columns: 1fr;
            grid-template-rows: var(--header-height) 1fr auto;
            grid-template-areas:
                "header"
                "content"
                "footer";
        }
        .admin-sidebar { display: none; }
    }
</style>

    @stack('styles')
</head>
<body>

    <div class="app-layout">

        {{-- 1. SIDEBAR --}}
        {{-- Pastikan class admin-sidebar ada di dalam file sidebar.blade.php --}}

        {{-- 2. HEADER --}}
        @include('direktur.layouts.header')

        {{-- 3. CONTENT AREA --}}
        <main class="main-content">
            @yield('content')
        </main>



    </div>
        @include('direktur.layouts.footer')
@if(session('status'))
    <div id="mode-alert" style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%); z-index: 9999; background: #0F172A; color: #BEF264; padding: 12px 25px; border-radius: 15px; font-size: 11px; font-weight: 800; border: 1px solid #BEF264;">
        {{ session('status') }}
    </div>
    <script>
        setTimeout(() => { document.getElementById('mode-alert').style.display = 'none'; }, 3000);
    </script>
@endif
    @stack('scripts')
@include('partials.announcement-alert')
</body>
</html>

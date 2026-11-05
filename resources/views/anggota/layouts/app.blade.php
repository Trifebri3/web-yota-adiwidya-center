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
            --header-height: 90px;
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
            overflow-x: hidden;
        }

        /* --- LAYOUT MASTER GRID --- */
        .app-layout {
            display: grid;
            grid-template-columns: var(--sidebar-width) 1fr;
            grid-template-rows: auto 1fr auto;
            grid-template-areas:
                "sidebar header"
                "sidebar content"
                "sidebar footer";
            min-height: 100vh;
        }

        /* --- AREAS --- */
        .admin-sidebar {
            grid-area: sidebar;
            background-color: var(--yota-dark);
            min-height: 100vh;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .admin-header {
            grid-area: header;
            height: var(--header-height);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            position: sticky;
            top: 0;
            z-index: 40;
            border-bottom: 1px solid #F1F5F9;
        }

        .main-content {
            grid-area: content;
            padding: 40px;
            /* Efek halus saat berpindah halaman */
            animation: slideUp 0.5s ease-out;
        }

        .admin-footer {
            grid-area: footer;
        }

        /* --- ANIMATIONS --- */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 1024px) {
            .app-layout {
                grid-template-columns: 1fr;
                grid-template-areas:
                    "header"
                    "content"
                    "footer";
            }

            .admin-sidebar {
                display: none; /* Idealnya diganti dengan drawer mobile */
            }
        }

        /* Custom Scrollbar agar rapi */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #F1F5F9; }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover { background: #94A3B8; }

    </style>

    @stack('styles')
</head>
<body>

    <div class="app-layout">

        {{-- 1. SIDEBAR --}}
        {{-- Pastikan class admin-sidebar ada di dalam file sidebar.blade.php --}}

        {{-- 2. HEADER --}}
        @include('anggota.layouts.header')

        {{-- 3. CONTENT AREA --}}
        <main class="main-content">
            @yield('content')
        </main>

        {{-- 4. FOOTER --}}
        @include('anggota.layouts.footer')

    </div>

    @stack('scripts')
@include('partials.announcement-alert')
</body>
</html>

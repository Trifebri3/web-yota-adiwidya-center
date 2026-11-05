<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'YOTA Platform') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        // Konfigurasi Tailwind Custom untuk nuansa NGO Internasional
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        yota: {
                            dark: '#064e3b',   // Hijau Tua Emerald
                            lemon: '#BEF264',  // Lemon Green
                            lime: '#84cc16',   // Aksen Hijau Terang
                            yellow: '#facc15', // Kuning Aksen
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; -webkit-font-smoothing: antialiased; }

        /* Elegant Gradient Background */
        .bg-luxury {
            background: radial-gradient(circle at top right, #f8fafc 0%, #ffffff 100%);
        }

        /* Custom Scrollbar Lemon */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #ffffff; }
        ::-webkit-scrollbar-thumb { background: #BEF264; border-radius: 10px; }

        /* Animation */
        .fade-in { animation: fadeIn 0.8s ease-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Nav Link Hover */
        .nav-link-custom {
            position: relative;
            transition: all 0.3s ease;
        }
        .nav-link-custom::after {
            content: ''; position: absolute; bottom: -2px; left: 0; width: 0; height: 2px;
            background: #BEF264; transition: all 0.3s ease;
        }
        .nav-link-custom:hover::after { width: 100%; }
    </style>
</head>
<body class="bg-luxury text-slate-900 antialiased overflow-x-hidden min-h-screen flex flex-col">


    @isset($header)
        <header class="bg-white/50 backdrop-blur-md border-b border-slate-100 sticky top-20 z-40">
            <div class="max-w-7xl mx-auto py-6 px-6 sm:px-8 lg:px-10">
                <div class="flex items-center justify-between">
                    <div class="text-2xl font-extrabold tracking-tight text-yota-dark">
                        {{ $header }}
                    </div>
                    <div class="hidden md:block h-2 w-2 rounded-full bg-yota-lemon animate-pulse"></div>
                </div>
            </div>
        </header>
    @endisset

    <main class="flex-grow w-full relative">
        <div class="fade-in px-4 sm:px-0">
            @yield('content')
        </div>
    </main>

    <footer class="bg-yota-dark text-white pt-20 pb-10 mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 border-b border-white/10 pb-16">
                <div class="col-span-1 md:col-span-1">
                    <img src="{{ asset('image/logo.png') }}" alt="YOTA" class="h-12 mb-6 brightness-0 invert" />
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Membangun masa depan inklusif melalui pemberdayaan komunitas global dan aksi nyata berkelanjutan.
                    </p>
                </div>
                <div>
                    <h4 class="text-yota-lemon font-bold mb-6 uppercase tracking-widest text-xs">Organisasi</h4>
                    <ul class="space-y-4 text-sm text-slate-300">
                        <li><a href="#" class="hover:text-yota-lemon transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-yota-lemon transition">Program Utama</a></li>
                        <li><a href="#" class="hover:text-yota-lemon transition">Legalitas</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-yota-lemon font-bold mb-6 uppercase tracking-widest text-xs">Publikasi</h4>
                    <ul class="space-y-4 text-sm text-slate-300">
                        <li><a href="#" class="hover:text-yota-lemon transition">Laporan Dampak</a></li>
                        <li><a href="#" class="hover:text-yota-lemon transition">Berita Edukasi</a></li>
                        <li><a href="#" class="hover:text-yota-lemon transition text-yota-yellow italic">Crisis Center 24/7</a></li>
                    </ul>
                </div>
                <div class="bg-white/5 p-6 rounded-3xl border border-white/10">
                    <h4 class="text-white font-bold mb-2">Impact Newsletter</h4>
                    <p class="text-xs text-slate-400 mb-4">Dapatkan update dampak bulanan.</p>
                    <div class="flex">
                        <input type="text" placeholder="Email" class="w-full bg-yota-dark border border-white/20 rounded-l-xl px-4 py-2 text-xs focus:outline-none focus:border-yota-lemon">
                        <button class="bg-yota-lemon text-yota-dark px-4 py-2 rounded-r-xl font-bold text-xs">Go</button>
                    </div>
                </div>
            </div>

            <div class="pt-8 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[10px] text-slate-500 uppercase tracking-widest">
                    © 2026 YOTA International Platform. Empowered by Lemon Tech.
                </p>
                <div class="flex items-center gap-6 grayscale opacity-50 hover:grayscale-0 transition-all">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" class="h-3" alt="Paypal">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" class="h-2" alt="Visa">
                    <span class="text-[10px] font-bold border border-white/20 px-2 py-1 rounded">ISO 9001 VERIFIED</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Effect on scroll for Sticky Header
        window.onscroll = function() {
            const header = document.querySelector('header');
            if (header && window.pageYOffset > 50) {
                header.classList.add('shadow-xl', 'shadow-yota-dark/5');
            } else if(header) {
                header.classList.remove('shadow-xl', 'shadow-yota-dark/5');
            }
        };
    </script>

    @stack('scripts')
</body>
</html>

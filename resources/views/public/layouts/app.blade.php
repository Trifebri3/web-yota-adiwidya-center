<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth scroll-pt-24">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- 1. TITLE & CANONICAL METADATA --}}
    <title>@yield('title', 'Yayasan Yota Wujudkan Asa | SIYOTA.org — Inisiatif Berkelanjutan 6 Pilar')</title>
    <meta name="description" content="@yield('seo_description', 'Yayasan Yota Wujudkan Asa (SIYOTA) adalah organisasi nirlaba yang berfokus pada 6 pilar strategis: Youth Development, Community Empowerment, Environmental Conservation, Innovation & Research, Disaster Resilience, serta Knowledge & Publication.')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <meta name="robots" content="@yield('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">

    {{-- Geo & Local Metadata --}}
    <meta name="geo.region" content="ID-JB">
    <meta name="geo.placename" content="Bandung, Jawa Barat, Indonesia">
    <meta name="author" content="Yayasan Yota Wujudkan Asa">

    @php
        $defaultOgImage = asset('image/og-share.jpg');
        $ogImage = trim($__env->yieldContent('og_image')) ?: $defaultOgImage;
        if (!str_starts_with($ogImage, 'http')) {
            $ogImage = url($ogImage);
        }
        $ogTitle = trim($__env->yieldContent('og_title')) ?: (trim($__env->yieldContent('title')) ?: 'Yayasan Yota Wujudkan Asa | SIYOTA.org');
        $ogDesc = trim($__env->yieldContent('seo_description')) ?: 'Yayasan Yota Wujudkan Asa (SIYOTA) — Inisiatif Berkelanjutan 6 Pilar: Youth Development, Community Empowerment, Environmental Conservation, Innovation & Research, Disaster Resilience, dan Knowledge & Publication.';
    @endphp

    {{-- 2. OPEN GRAPH & SOCIAL PROTOCOL (WHATSAPP, FACEBOOK, TELEGRAM, LINKEDIN) --}}
    <meta property="og:locale" content="{{ app()->getLocale() == 'en' ? 'en_US' : 'id_ID' }}">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Yayasan Yota Wujudkan Asa (SIYOTA)">
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:secure_url" content="{{ $ogImage }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $ogTitle }}">

    {{-- Twitter Cards --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@siyota_org">
    <meta name="twitter:creator" content="@siyota_org">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- 3. ASSET PRECONNECT & OPTIMIZATION --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('image/logo.png') }}">

    {{-- Alpine.js & Tailwind --}}
    <script defer src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .nav-link { position: relative; transition: all 0.3s ease; }
        .nav-link::after {
            content: ''; position: absolute; bottom: -2px; left: 50%; width: 0; height: 2px;
            background: #BEF264; transition: all 0.3s ease; transform: translateX(-50%);
        }
        .nav-link:hover::after, .nav-active::after { width: 100%; }
        .nav-active { color: #064e3b !important; }

        /* Focus Ring WCAG AA Accessibility */
        a:focus-visible, button:focus-visible, input:focus-visible, select:focus-visible, textarea:focus-visible {
            outline: 2px solid #16a34a;
            outline-offset: 3px;
        }

        /* Reduced Motion Accessibility */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    {{-- 4. GEO & TECHNICAL SEO: STRUCTURED DATA (JSON-LD) --}}
    <script type="application/ld+json">
    {
        "{{ '@' }}context": "https://schema.org",
        "@graph": [
            {
                "{{ '@' }}type": ["NGO", "Organization"],
                "@id": "https://siyota.org/#organization",
                "name": "Yayasan Yota Wujudkan Asa",
                "alternateName": ["YOTA", "SIYOTA", "Yota Adiwidya Center", "YAC Foundation"],
                "url": "https://siyota.org",
                "logo": {
                    "@type": "ImageObject",
                    "@id": "https://siyota.org/#logo",
                    "url": "{{ asset('image/logo.png') }}",
                    "caption": "Yayasan Yota Wujudkan Asa Logo"
                },
                "description": "Yayasan Yota Wujudkan Asa adalah organisasi nirlaba yang berfokus pada 6 pilar dampak strategis: Youth Development, Community Empowerment, Environmental Conservation, Innovation & Research, Disaster Resilience, serta Knowledge & Publication di Indonesia.",
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "Bandung",
                    "addressRegion": "Jawa Barat",
                    "addressCountry": "ID"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+6285117713303",
                    "contactType": "customer service",
                    "email": "hello@siyota.org",
                    "availableLanguage": ["Indonesian", "English"]
                },
                "sameAs": [
                    "https://www.linkedin.com/company/yota-adiwidya-center",
                    "https://www.instagram.com/yota.center",
                    "https://hub.siyota.org"
                ],
                "knowsAbout": [
                    "Youth Development & Leadership",
                    "Pemberdayaan Masyarakat dan Komunitas",
                    "Konservasi Hutan dan Keanekaragaman Hayati",
                    "Smart Agriculture IoT & Inovasi Teknologi Tepat Guna",
                    "Edukasi dan Mitigasi Bencana",
                    "Riset Ilmiah dan Publikasi Terbuka",
                    "Sustainable Development Goals (SDGs)"
                ]
            },
            {
                "@type": "WebSite",
                "@id": "https://siyota.org/#website",
                "url": "https://siyota.org",
                "name": "SIYOTA.org — Yayasan Yota Wujudkan Asa",
                "publisher": {
                    "@id": "https://siyota.org/#organization"
                },
                "inLanguage": "id-ID"
            }
        ]
    }
    </script>

    @stack('styles')
</head>

<body class="bg-[#FDFDFB] text-slate-900 flex flex-col min-h-screen antialiased selection:bg-lime-200 selection:text-green-950">

    {{-- Accessibility: Skip to Content Link --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-[99999] focus:px-6 focus:py-3 focus:bg-[#052c24] focus:text-[#BEF264] focus:rounded-full focus:font-black focus:text-xs focus:uppercase focus:shadow-2xl focus:border-2 focus:border-lime-400">
        Lewati ke Konten Utama (Skip to Content)
    </a>

    {{-- Main Navigation Header --}}
    @include('public.layouts.header')

    {{-- Landmark Main Content --}}
    <main id="main-content" role="main" class="flex-grow">
        @yield('content')
    </main>

    {{-- Landmark Footer --}}
    @include('public.layouts.footer')

    @stack('scripts')
</body>
</html>

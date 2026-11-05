{{-- ========================================================================= --}}
{{-- GEO & AI-SEARCH FACTUAL KNOWLEDGE / FAQ COMPONENT                       --}}
{{-- ========================================================================= --}}
<section class="py-14 md:py-20 bg-[#FDFDFB] border-t border-slate-200/80 font-['Plus_Jakarta_Sans']" aria-labelledby="faq-heading">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>INFORMASI RESMI & TANYA JAWAB (FAQ)</span>
            </div>
            <h2 id="faq-heading" class="text-3xl md:text-4xl font-black text-[#052c24] tracking-tight uppercase leading-tight">
                Pertanyaan Umum Seputar <span class="text-slate-400 font-serif italic lowercase">SIYOTA & Program Kami</span>
            </h2>
            <p class="text-xs md:text-sm text-slate-500 mt-2 font-normal">
                Jawaban ringkas, faktual, dan transparan mengenai struktur organisasi, pilar aksi, dan cara berpartisipasi.
            </p>
        </div>

        {{-- FAQ Accordion List (Accessible with Alpine.js) --}}
        <div class="space-y-3.5" x-data="{ active: null }">

            {{-- 1. Apa itu YOTA / SIYOTA? --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
                <button type="button"
                        @click="active = (active === 1 ? null : 1)"
                        class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-black text-sm md:text-base text-[#052c24] hover:text-emerald-700 transition-colors"
                        :aria-expanded="active === 1">
                    <span>Apa itu Yayasan Yota Wujudkan Asa (SIYOTA)?</span>
                    <svg :class="active === 1 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="active === 1" x-collapse class="px-6 pb-5 pt-1 text-xs md:text-sm text-slate-600 leading-relaxed font-normal border-t border-slate-100">
                    Yayasan Yota Wujudkan Asa (dikenal sebagai SIYOTA / Yota Adiwidya Center) adalah organisasi nirlaba (NGO) resmi di Indonesia yang berdedikasi membangun ketahanan peradaban melalui pemberdayaan pemuda, ketahanan komunitas lokal, konservasi lingkungan, sains terapan, serta mitigasi risiko bencana.
                </div>
            </div>

            {{-- 2. Apa saja 6 Pilar YOTA? --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
                <button type="button"
                        @click="active = (active === 2 ? null : 2)"
                        class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-black text-sm md:text-base text-[#052c24] hover:text-emerald-700 transition-colors"
                        :aria-expanded="active === 2">
                    <span>Apa saja 6 Pilar Dampak Strategis yang dijalankan YOTA?</span>
                    <svg :class="active === 2 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="active === 2" x-collapse class="px-6 pb-5 pt-1 text-xs md:text-sm text-slate-600 leading-relaxed font-normal border-t border-slate-100">
                    Inisiatif YOTA berakar pada 6 area strategis:
                    <ol class="list-decimal pl-5 mt-2 space-y-1">
                        <li><strong>01. Youth Development:</strong> Inkubasi kepemimpinan, talenta STEAM, dan literasi digital pemuda.</li>
                        <li><strong>02. Community Empowerment:</strong> Pendampingan UMKM berbasis hasil bumi dan digitalisasi desa mitra.</li>
                        <li><strong>03. Environmental Conservation:</strong> Penanaman pohon endemik (BioTag), restorasi gambut, dan perlindungan terumbu karang.</li>
                        <li><strong>04. Innovation & Research:</strong> Purwarupa sensor IoT pertanian (AgroSense) dan riset teknologi tepat guna.</li>
                        <li><strong>05. Disaster Resilience:</strong> Sekolah tangguh bencana, sensor peringatan dini, dan pelatihan evakuasi mandiri.</li>
                        <li><strong>06. Knowledge & Publication:</strong> Penerbitan buku monograf, jurnal kajian sosial, dan rekomendasi kebijakan terbuka.</li>
                    </ol>
                </div>
            </div>

            {{-- 3. Bagaimana cara mendaftar jadi relawan / partisipan? --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
                <button type="button"
                        @click="active = (active === 3 ? null : 3)"
                        class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-black text-sm md:text-base text-[#052c24] hover:text-emerald-700 transition-colors"
                        :aria-expanded="active === 3">
                    <span>Bagaimana cara mendaftar sebagai relawan (volunteer) YOTA?</span>
                    <svg :class="active === 3 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="active === 3" x-collapse class="px-6 pb-5 pt-1 text-xs md:text-sm text-slate-600 leading-relaxed font-normal border-t border-slate-100">
                    Pendaftaran relawan dan partisipan program dibuka melalui platform resmi <strong>YOTA Hub</strong> di <a href="https://hub.siyota.org" target="_blank" class="text-emerald-700 font-bold underline">hub.siyota.org</a>. Setiap inisiatif yang membuka fase <em>Open Recruitment</em> (seperti Collaborative Action Program atau Tim Tanggap Darurat) dilengkapi dengan dokumen panduan (TOR) dan formulir pendaftaran digital.
                </div>
            </div>

            {{-- 4. Di mana YOTA menjalankan kegiatan? --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
                <button type="button"
                        @click="active = (active === 4 ? null : 4)"
                        class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-black text-sm md:text-base text-[#052c24] hover:text-emerald-700 transition-colors"
                        :aria-expanded="active === 4">
                    <span>Di mana saja lokasi sebaran kegiatan dan desa binaan YOTA?</span>
                    <svg :class="active === 4 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="active === 4" x-collapse class="px-6 pb-5 pt-1 text-xs md:text-sm text-slate-600 leading-relaxed font-normal border-t border-slate-100">
                    Dengan sekretariat pusat di Jawa Barat (Bandung), titik implementasi program YOTA tersebar secara nasional mencakup Jawa (Bandung, Garut, Cianjur, Sleman, Lumajang), Sumatera (Padang, Medan), Nusa Tenggara (Lombok Utara), Kalimantan (Kutai, Balikpapan), Sulawesi (Palu, Toraja, Makassar), hingga Kepulauan Maluku dan Papua (Ambon, Raja Ampat). Sebaran lengkap dapat dipantau di <a href="#sebaran-pilar" class="text-emerald-700 font-bold underline">Peta Geospasial Pilar</a>.
                </div>
            </div>

            {{-- 5. Bagaimana cara institusi / kampus berkolaborasi? --}}
            <div class="bg-white rounded-2xl border border-slate-200/90 overflow-hidden shadow-sm">
                <button type="button"
                        @click="active = (active === 5 ? null : 5)"
                        class="w-full px-6 py-4 text-left flex items-center justify-between gap-4 font-black text-sm md:text-base text-[#052c24] hover:text-emerald-700 transition-colors"
                        :aria-expanded="active === 5">
                    <span>Bagaimana cara institusi, kampus, atau korporasi mengajukan kerja sama?</span>
                    <svg :class="active === 5 ? 'rotate-180 text-emerald-600' : 'text-slate-400'" class="w-5 h-5 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="active === 5" x-collapse class="px-6 pb-5 pt-1 text-xs md:text-sm text-slate-600 leading-relaxed font-normal border-t border-slate-100">
                    Kami menyambut kerja sama Tri Dharma Perguruan Tinggi, kolaborasi pendanaan CSR, maupun kemitraan teknis lembaga donor. Silakan hubungi tim kemitraan kami melalui surel resmi di <strong>hello@siyota.org</strong> atau kunjungi laman <a href="{{ route('public.tentangkami.kontak') }}" class="text-emerald-700 font-bold underline">Kontak & Kemitraan</a>.
                </div>
            </div>

        </div>

    </div>
</section>

{{-- GEO: JSON-LD FAQPage Schema for Search Engines & Generative AI --}}
<script type="application/ld+json">
{
    "{{ '@' }}context": "https://schema.org",
    "{{ '@' }}type": "FAQPage",
    "mainEntity": [
        {
            "{{ '@' }}type": "Question",
            "name": "Apa itu Yayasan Yota Wujudkan Asa (SIYOTA)?",
            "acceptedAnswer": {
                "{{ '@' }}type": "Answer",
                "text": "Yayasan Yota Wujudkan Asa (SIYOTA / Yota Adiwidya Center) adalah organisasi nirlaba resmi di Indonesia yang berdedikasi membangun ketahanan peradaban melalui 6 pilar strategis: pemberdayaan pemuda, ketahanan komunitas, konservasi alam, sains terapan, serta mitigasi risiko bencana."
            }
        },
        {
            "{{ '@' }}type": "Question",
            "name": "Apa saja 6 Pilar Dampak Strategis yang dijalankan YOTA?",
            "acceptedAnswer": {
                "{{ '@' }}type": "Answer",
                "text": "6 Pilar Strategis YOTA adalah: 01. Youth Development, 02. Community Empowerment, 03. Environmental Conservation, 04. Innovation & Research, 05. Disaster Resilience, dan 06. Knowledge & Publication."
            }
        },
        {
            "{{ '@' }}type": "Question",
            "name": "Bagaimana cara mendaftar sebagai relawan (volunteer) YOTA?",
            "acceptedAnswer": {
                "{{ '@' }}type": "Answer",
                "text": "Pendaftaran relawan dan partisipan program dibuka melalui platform resmi YOTA Hub di hub.siyota.org untuk program yang sedang dalam fase Open Recruitment."
            }
        },
        {
            "{{ '@' }}type": "Question",
            "name": "Di mana saja lokasi sebaran kegiatan dan desa binaan YOTA?",
            "acceptedAnswer": {
                "{{ '@' }}type": "Answer",
                "text": "Titik implementasi program YOTA tersebar secara nasional di Jawa, Sumatera, Nusa Tenggara, Kalimantan, Sulawesi, hingga Maluku dan Papua."
            }
        },
        {
            "{{ '@' }}type": "Question",
            "name": "Bagaimana cara institusi, kampus, atau korporasi mengajukan kerja sama?",
            "acceptedAnswer": {
                "{{ '@' }}type": "Answer",
                "text": "Institusi dapat menghubungi tim kemitraan melalui email hello@siyota.org atau melalui halaman kontak resmi di siyota.org."
            }
        }
    ]
}
</script>

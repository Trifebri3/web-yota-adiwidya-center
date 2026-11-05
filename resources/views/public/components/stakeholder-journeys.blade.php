{{-- ========================================================================= --}}
{{-- STAKEHOLDER JOURNEYS (HUMAN-CENTERED DESIGN / HCD USER PATHWAYS)         --}}
{{-- ========================================================================= --}}
<section class="py-14 md:py-20 bg-white border-t border-slate-200/80 font-['Plus_Jakarta_Sans']" aria-labelledby="pathways-heading">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>JALUR KOLABORASI & PARTISIPASI INKLUSIF</span>
            </div>
            <h2 id="pathways-heading" class="text-3xl md:text-5xl font-black text-[#052c24] tracking-tight uppercase leading-tight">
                Bagaimana Anda Dapat <span class="text-slate-400 font-serif italic lowercase">bergerak bersama kami?</span>
            </h2>
            <p class="text-xs md:text-sm text-slate-500 mt-2 font-normal leading-relaxed">
                Setiap orang memiliki peran dalam merawat peradaban dan lingkungan. Pilih peran yang paling sesuai dengan kebutuhan atau kapasitas Anda.
            </p>
        </div>

        {{-- 4 User Journey Cards (Bento Style) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            {{-- 1. YOUTH & VOLUNTEERS --}}
            <div class="bg-[#FDFDFB] rounded-3xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-[#0361a4]/10 text-[#0361a4] flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5"/></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#0361a4] block mb-1">
                        Pemuda & Mahasiswa
                    </span>
                    <h3 class="text-base font-black text-[#052c24] leading-snug uppercase mb-2">
                        Inkubasi & Aksi Kerelawanan
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal mb-5">
                        Kembangkan kapasitas kepemimpinan, pelajari keahlian STEAM aplikatif, dan terjun langsung dalam aksi kerelawanan mitigasi bencana serta konservasi.
                    </p>
                </div>
                <a href="{{ route('public.tentangkami.kontak', ['kemitraan' => 'volunteer']) }}"
                   class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-black text-[#0361a4] group-hover:bg-[#0361a4] group-hover:text-white transition-all shadow-sm">
                    <span>Gabung & Kolaborasi</span>
                    <span>→</span>
                </a>
            </div>

            {{-- 2. COMMUNITY & VILLAGES --}}
            <div class="bg-[#FDFDFB] rounded-3xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-[#b8984b]/10 text-[#b8984b] flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#b8984b] block mb-1">
                        Komunitas & Kelompok Tani
                    </span>
                    <h3 class="text-base font-black text-[#052c24] leading-snug uppercase mb-2">
                        Pemberdayaan & Digitalisasi Desa
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal mb-5">
                        Dapatkan pendampingan tata kelola hasil bumi, instalasi sensor pertanian tepat guna, serta jejaring penguatan ekonomi sirkular desa mitra.
                    </p>
                </div>
                <a href="{{ route('public.tentangkami.kontak', ['kemitraan' => 'komunitas']) }}"
                   class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-black text-[#b8984b] group-hover:bg-[#b8984b] group-hover:text-white transition-all shadow-sm">
                    <span>Ajukan Kemitraan Desa</span>
                    <span>→</span>
                </a>
            </div>

            {{-- 3. RESEARCHERS & ACADEMICS --}}
            <div class="bg-[#FDFDFB] rounded-3xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-[#55307f]/10 text-[#55307f] flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#55307f] block mb-1">
                        Peneliti & Lembaga Ilmiah
                    </span>
                    <h3 class="text-base font-black text-[#052c24] leading-snug uppercase mb-2">
                        Publikasi Riset & Data Terbuka
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal mb-5">
                        Akses kajian ilmiah lapangan, monograf kebijakan, dan data sensor geospasial terbuka untuk pengayaan riset akademis dan inovasi teknologi.
                    </p>
                </div>
                <a href="{{ route('public.tentangkami.kontak', ['kemitraan' => 'riset']) }}"
                   class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-black text-[#55307f] group-hover:bg-[#55307f] group-hover:text-white transition-all shadow-sm">
                    <span>Ajukan Kolaborasi Riset</span>
                    <span>→</span>
                </a>
            </div>

            {{-- 4. PARTNERS & DONORS --}}
            <div class="bg-[#FDFDFB] rounded-3xl p-6 border border-slate-200/90 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between hover:-translate-y-1 group">
                <div>
                    <div class="w-12 h-12 rounded-2xl bg-[#064e3b]/10 text-[#064e3b] flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-wider text-[#064e3b] block mb-1">
                        Lembaga, Donor & Korporasi
                    </span>
                    <h3 class="text-base font-black text-[#052c24] leading-snug uppercase mb-2">
                        Kolaborasi Dampak & Kemitraan CSR
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed font-normal mb-5">
                        Salurkan program tanggung jawab sosial (CSR) atau hibah program strategis dengan akuntabilitas pelaporan terverifikasi dan dampak berkelanjutan.
                    </p>
                </div>
                <a href="{{ route('public.tentangkami.kontak', ['kemitraan' => 'csr']) }}"
                   class="inline-flex items-center justify-between w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 text-xs font-black text-[#064e3b] group-hover:bg-[#064e3b] group-hover:text-white transition-all shadow-sm">
                    <span>Inisiasi Kemitraan CSR</span>
                    <span>→</span>
                </a>
            </div>

        </div>

    </div>
</section>


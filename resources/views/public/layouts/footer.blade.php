<footer class="bg-[#052c24] text-slate-300 pt-16 pb-12 font-['Plus_Jakarta_Sans'] border-t-4 border-[#BEF264] relative overflow-hidden" role="contentinfo">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

        {{-- Baris Atas: Logo, Deskripsi Organisasi & Newsletter --}}
        <div class="grid lg:grid-cols-12 gap-10 items-center mb-12 pb-12 border-b border-white/10">
            <div class="lg:col-span-5">
                <a href="/" class="text-2xl font-black tracking-tight text-white uppercase inline-block">
                    SIYOTA<span class="text-[#BEF264]">.</span>ORG
                </a>
                <div class="mt-2 flex items-center gap-2">
                    <span class="px-2.5 py-0.5 bg-white/10 rounded-full text-[9px] font-black text-[#BEF264] uppercase tracking-wider border border-white/10">
                        NGO / Yayasan Resmi
                    </span>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-300">
                        Yayasan Yota Wujudkan Asa
                    </span>
                </div>
                <p class="mt-4 text-slate-300 leading-relaxed text-xs md:text-sm font-normal max-w-md">
                    Lembaga sosial nasional nirlaba yang berfokus pada 6 pilar strategis: pemberdayaan pemuda, ketahanan komunitas, konservasi lingkungan, inovasi sains & teknologi, mitigasi bencana, serta diseminasi pengetahuan terbuka di Indonesia.
                </p>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white/5 p-6 md:p-8 rounded-3xl border border-white/10 backdrop-blur-sm flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-shrink-0 text-left w-full md:w-auto">
                        <h3 class="text-sm font-black text-white uppercase tracking-wider mb-1">Kabar Dampak & Buletin</h3>
                        <p class="text-xs text-slate-400">Dapatkan rilis program, riset, dan peluang kerelawanan berkala.</p>
                    </div>
                    <form action="#" method="POST" class="flex w-full gap-2" onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan buletin kabar dampak SIYOTA!');">
                        @csrf
                        <input type="email"
                               name="subscriber_email"
                               required
                               autocomplete="email"
                               placeholder="Alamat email Anda..."
                               aria-label="Alamat email untuk berlangganan buletin"
                               class="flex-1 bg-black/30 border border-white/15 rounded-xl px-4 py-3 text-xs text-white placeholder-slate-400 focus:outline-none focus:border-[#BEF264] transition-all">
                        <button type="submit"
                                class="bg-[#BEF264] hover:bg-white text-[#052c24] font-black px-6 py-3 rounded-xl transition-all duration-300 uppercase tracking-wider text-[11px] shrink-0">
                            Langganan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Baris Tengah: Link Navigasi Lengkap & Rapi (Tanpa Dead Links) --}}
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mb-12">

            {{-- Kolom 1: Profil Organisasi --}}
            <div>
                <h4 class="text-white font-black mb-4 uppercase tracking-wider text-[10px] text-[#BEF264]">Tentang Kami</h4>
                <ul class="space-y-2.5 text-xs font-semibold">
                    <li><a href="{{ route('public.tentangkami.profil') }}" class="hover:text-[#BEF264] transition-colors">Profil Lembaga</a></li>
                    <li><a href="{{ route('public.tentangkami.visi') }}" class="hover:text-[#BEF264] transition-colors">Visi & Misi</a></li>
                    <li><a href="{{ route('public.tentangkami.legalitas') }}" class="hover:text-[#BEF264] transition-colors">Legalitas & Akreditasi</a></li>
                    <li><a href="{{ route('public.tentangkami.sejarah') }}" class="hover:text-[#BEF264] transition-colors">Jejak Langkah</a></li>
                    <li><a href="{{ route('public.team') }}" class="hover:text-[#BEF264] transition-colors">Struktur Tim</a></li>
                </ul>
            </div>

            {{-- Kolom 2: 6 Pilar & Aksi --}}
            <div>
                <h4 class="text-white font-black mb-4 uppercase tracking-wider text-[10px] text-[#BEF264]">Pilar & Aksi</h4>
                <ul class="space-y-2.5 text-xs font-semibold">
                    <li><a href="{{ route('public.impact-areas.index') }}" class="hover:text-[#BEF264] transition-colors">6 Pilar Strategis</a></li>
                    <li><a href="{{ route('public.programs.index') }}" class="hover:text-[#BEF264] transition-colors">Katalog Program</a></li>
                    <li><a href="{{ route('public.impact-areas.index') }}#sebaran-pilar" class="hover:text-[#BEF264] transition-colors">Peta Sebaran Geospasial</a></li>
                    <li><a href="{{ route('public.impact.index') }}" class="hover:text-[#BEF264] transition-colors">Laporan Capaian Dampak</a></li>
                    <li><a href="https://hub.siyota.org" target="_blank" class="hover:text-[#BEF264] transition-colors">YOTA Hub (Relawan) ↗</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Publikasi & Riset --}}
            <div>
                <h4 class="text-white font-black mb-4 uppercase tracking-wider text-[10px] text-[#BEF264]">Publikasi & Riset</h4>
                <ul class="space-y-2.5 text-xs font-semibold">
                    <li><a href="{{ route('public.docs.index') }}" class="hover:text-[#BEF264] transition-colors">Buku & Monograf</a></li>
                    <li><a href="{{ route('public.kajianilmiah.index') }}" class="hover:text-[#BEF264] transition-colors">Kajian Ilmiah Terapan</a></li>
                    <li><a href="{{ route('public.publications.index') }}" class="hover:text-[#BEF264] transition-colors">Berita & Pengumuman</a></li>
                    <li><a href="{{ route('public.products.index') }}" class="hover:text-[#BEF264] transition-colors">Inovasi Produk Sosial</a></li>
                    <li><a href="{{ route('public.gallery.index') }}" class="hover:text-[#BEF264] transition-colors">Dokumentasi Galeri</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Kemitraan & Partisipasi --}}
            <div>
                <h4 class="text-white font-black mb-4 uppercase tracking-wider text-[10px] text-[#BEF264]">Kolaborasi</h4>
                <ul class="space-y-2.5 text-xs font-semibold">
                    <li><a href="{{ route('public.campaign.index') }}" class="hover:text-[#BEF264] transition-colors">Dukungan & Donasi</a></li>
                    <li><a href="{{ route('public.partners.index') }}" class="hover:text-[#BEF264] transition-colors">Mitra Lembaga & Kampus</a></li>
                    <li><a href="{{ route('public.tentangkami.kontak') }}" class="hover:text-[#BEF264] transition-colors">Ajukan Kerja Sama</a></li>
                    <li><a href="{{ route('public.reviews.index') }}" class="hover:text-[#BEF264] transition-colors">Testimoni & Suara Mitra</a></li>
                </ul>
            </div>

            {{-- Kolom 5: Kontak Resmi Organisasi --}}
            <div class="col-span-2 md:col-span-4 lg:col-span-1">
                <h4 class="text-white font-black mb-4 uppercase tracking-wider text-[10px] text-[#BEF264]">Sekretariat</h4>
                <div class="text-xs space-y-2.5 leading-relaxed text-slate-300">
                    <p class="font-normal">
                        <strong class="text-white block font-bold">Kantor Pusat:</strong>
                        Bandung, Jawa Barat, Indonesia
                    </p>
                    <p>
                        <strong class="text-white block font-bold">Email:</strong>
                        <a href="mailto:yotaadiwidyacenter@gmail.com" class="hover:text-[#BEF264] transition-colors">yotaadiwidyacenter@gmail.com</a>
                    </p>
                    <p>
                        <strong class="text-white block font-bold">Telepon/WA:</strong>
                        <a href="https://wa.me/6285117713303" target="_blank" class="hover:text-[#BEF264] transition-colors">+62 851-1771-3303</a>
                    </p>
                </div>
            </div>

        </div>

        {{-- Baris Bawah: Copyright & Jejaring Media Sosial Resmi --}}
        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                <p class="text-xs text-slate-400 font-medium">
                    &copy; {{ date('Y') }} Yayasan Yota Wujudkan Asa. Seluruh Hak Cipta Dilindungi.
                </p>
                <div class="flex items-center gap-4 text-xs font-semibold text-slate-400">
                    <a href="{{ route('public.tentangkami.legalitas') }}" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                    <span>•</span>
                    <a href="{{ route('public.tentangkami.legalitas') }}" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>

            {{-- Social Media Icons --}}
            <div class="flex items-center gap-3">
                <span class="text-xs font-bold text-slate-400">Ikuti Kami:</span>
                <a href="https://www.linkedin.com/company/yota-adiwidya-center" target="_blank" rel="noopener noreferrer"
                   aria-label="LinkedIn Yayasan Yota Wujudkan Asa"
                   class="w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center text-slate-300 hover:bg-[#BEF264] hover:text-[#052c24] transition-all border border-white/10">
                    <span class="text-xs font-black">in</span>
                </a>
                <a href="https://www.instagram.com/yota.center" target="_blank" rel="noopener noreferrer"
                   aria-label="Instagram Yayasan Yota Wujudkan Asa"
                   class="w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center text-slate-300 hover:bg-[#BEF264] hover:text-[#052c24] transition-all border border-white/10">
                    <span class="text-xs font-black">ig</span>
                </a>
                <a href="https://hub.siyota.org" target="_blank" rel="noopener noreferrer"
                   aria-label="YOTA Hub Platform"
                   class="w-9 h-9 rounded-xl bg-white/5 flex items-center justify-center text-slate-300 hover:bg-[#BEF264] hover:text-[#052c24] transition-all border border-white/10">
                    <span class="text-xs font-black">hub</span>
                </a>
            </div>
        </div>

    </div>
</footer>

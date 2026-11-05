@extends('public.layouts.app')

@section('title', 'Hubungi Kami & Kemitraan Strategis | SIYOTA.org — Yayasan Yota Wujudkan Asa')

@section('content')
<main class="bg-[#FDFDFB] min-h-screen pt-28 md:pt-36 pb-20 font-['Plus_Jakarta_Sans']"
      x-data="{
          selectedKemitraan: '{{ request('kemitraan', 'csr') }}',
          senderName: '',
          senderOrg: '',
          senderEmail: '',
          senderMessage: '',
          copied: false,
          copyEmail() {
              navigator.clipboard.writeText('hello@siyota.org');
              this.copied = true;
              setTimeout(() => this.copied = false, 2500);
          },
          sendInquiry() {
              const categoryMap = {
                  'csr': 'Kemitraan Korporasi & Program CSR',
                  'komunitas': 'Pendampingan Desa & Kelompok Tani',
                  'riset': 'Kolaborasi Riset, Monograf & Data Terbuka',
                  'volunteer': 'Partisipasi Relawan & Youth Hub'
              };
              const catTitle = categoryMap[this.selectedKemitraan] || 'Kemitraan Umum';
              const subject = encodeURIComponent(`[Inquiry Kemitraan] ${catTitle} - ${this.senderOrg || this.senderName || 'Mitra'}`);
              const body = encodeURIComponent(`Halo Tim Yayasan Yota Wujudkan Asa (SIYOTA.org),\n\nSaya ingin mengajukan inisiatif kolaborasi / pertanyaan kemitraan:\n\n- Kategori Kemitraan: ${catTitle}\n- Nama: ${this.senderName}\n- Lembaga / Komunitas: ${this.senderOrg}\n- Kontak Pengirim: ${this.senderEmail}\n\nPesan / Kebutuhan Kolaborasi:\n${this.senderMessage}\n\nTerima kasih.`);
              window.location.href = `mailto:hello@siyota.org?subject=${subject}&body=${body}`;
          }
      }">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- 1. COMPACT HEADER SECTION --}}
        <div class="max-w-3xl mb-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-[#064e3b] text-[10px] font-black uppercase tracking-[0.25em] mb-2.5">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>OFFICIAL CHANNELS & PARTNERSHIPS</span>
            </div>
            <h1 class="text-3xl md:text-5xl font-black text-[#052c24] tracking-tight uppercase leading-none">
                Hubungi Kami & <span class="text-slate-400 font-serif italic lowercase">inisiasi kemitraan.</span>
            </h1>
            <p class="text-xs md:text-sm text-slate-500 font-normal mt-2">
                Pintu komunikasi resmi Yayasan Yota Wujudkan Asa untuk kolaborasi program 6 pilar, pendampingan desa, riset terapan, dan kemitraan strategis nasional.
            </p>
        </div>

        {{-- 2. DUAL-COLUMN BENTO: DIRECT CONTACT & INQUIRY FORM --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-12">

            {{-- LEFT COLUMN: DIRECT CONTACT DETAILS (5 Cols) --}}
            <div class="lg:col-span-5 space-y-4">

                {{-- Primary Email Box (hello@siyota.org) --}}
                <div class="bg-[#052c24] text-white rounded-3xl p-6 sm:p-7 shadow-lg relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-700/30 rounded-full blur-2xl pointer-events-none"></div>

                    <div class="flex items-center justify-between mb-4">
                        <span class="px-2.5 py-1 rounded-full bg-white/10 text-lime-300 text-[9px] font-black uppercase tracking-widest font-mono">
                            OFFICIAL EMAIL DESK
                        </span>
                        <span class="w-2 h-2 rounded-full bg-lime-400 animate-ping"></span>
                    </div>

                    <h3 class="text-xs font-bold text-slate-300 uppercase tracking-wider mb-1">
                        Surel Kemitraan & Informasi Umum
                    </h3>
                    <div class="text-xl sm:text-2xl font-black text-[#BEF264] font-mono tracking-tight mb-4 select-all">
                        hello@siyota.org
                    </div>

                    <p class="text-xs text-slate-300 leading-relaxed font-normal mb-5">
                        Saluran komunikasi resmi untuk pengajuan proposal, permohonan narasumber, kolaborasi CSR, dan koordinasi program lintas pilar.
                    </p>

                    <div class="flex flex-wrap gap-2">
                        <a href="mailto:hello@siyota.org"
                           class="flex-1 min-w-[140px] py-2.5 px-4 rounded-xl bg-[#BEF264] hover:bg-white text-[#052c24] text-xs font-black uppercase tracking-wider text-center transition-all shadow-sm">
                            Kirim Email Sekarang →
                        </a>
                        <button type="button" @click="copyEmail()"
                                class="py-2.5 px-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-bold transition-all flex items-center justify-center gap-1.5 border border-white/10">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span x-text="copied ? 'Tersalin!' : 'Salin'"></span>
                        </button>
                    </div>
                </div>

                {{-- WhatsApp & Phone Box --}}
                <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3.5 min-w-0">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div class="min-w-0">
                            <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block">WhatsApp Hotline</span>
                            <span class="text-sm font-black text-[#052c24] font-mono truncate block">+62 851-1771-3303</span>
                        </div>
                    </div>
                    <a href="https://wa.me/6285117713303" target="_blank"
                       class="px-3.5 py-2 rounded-xl bg-slate-100 hover:bg-[#052c24] text-[#052c24] hover:text-[#BEF264] text-xs font-black uppercase tracking-wider transition-all shrink-0">
                        Chat ↗
                    </a>
                </div>

                {{-- Alamat Kantor Box --}}
                <div class="bg-white rounded-3xl p-5 border border-slate-200/90 shadow-sm">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div class="text-xs">
                            <span class="text-[9px] font-black uppercase tracking-wider text-slate-400 block mb-1">Kantor Sekretariat Utama</span>
                            <p class="font-bold text-[#052c24] leading-snug">
                                Yayasan Yota Wujudkan Asa
                            </p>
                            <p class="text-slate-500 font-normal leading-relaxed mt-1 text-[11px]">
                                Perumahan Jatimekar Residence, Blok C No.26, Malakasari, Kec. Baleendah, Kabupaten Bandung, Jawa Barat 40375
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Social Ecosystem Pills --}}
                <div class="grid grid-cols-4 gap-2 pt-1">
                    <a href="https://instagram.com/yota.center" target="_blank" class="py-2.5 px-2 bg-white rounded-2xl border border-slate-200/90 text-center hover:bg-slate-50 transition-all text-xs font-bold text-slate-700">
                        <span class="block text-[10px] text-slate-400 font-black">IG</span>
                        <span class="text-[9px] font-black">@yota.center</span>
                    </a>
                    <a href="https://www.linkedin.com/company/yota-adiwidya-center" target="_blank" class="py-2.5 px-2 bg-white rounded-2xl border border-slate-200/90 text-center hover:bg-slate-50 transition-all text-xs font-bold text-slate-700">
                        <span class="block text-[10px] text-slate-400 font-black">LI</span>
                        <span class="text-[9px] font-black">LinkedIn</span>
                    </a>
                    <a href="https://hub.siyota.org" target="_blank" class="py-2.5 px-2 bg-white rounded-2xl border border-slate-200/90 text-center hover:bg-slate-50 transition-all text-xs font-bold text-slate-700">
                        <span class="block text-[10px] text-slate-400 font-black">HUB</span>
                        <span class="text-[9px] font-black">YOTA Hub</span>
                    </a>
                    <a href="https://youtube.com/@yotacenter" target="_blank" class="py-2.5 px-2 bg-white rounded-2xl border border-slate-200/90 text-center hover:bg-slate-50 transition-all text-xs font-bold text-slate-700">
                        <span class="block text-[10px] text-slate-400 font-black">YT</span>
                        <span class="text-[9px] font-black">YouTube</span>
                    </a>
                </div>

            </div>

            {{-- RIGHT COLUMN: FORMULIR INQUIRI KEMITRAAN & KOLABORASI (7 Cols) --}}
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">

                <div class="flex items-center justify-between mb-6">
                    <div>
                        <span class="text-[9px] font-black uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg">
                            INTERACTIVE INQUIRY FORM
                        </span>
                        <h2 class="text-xl sm:text-2xl font-black text-[#052c24] uppercase tracking-tight mt-1.5">
                            Formulir Penjajakan Kemitraan
                        </h2>
                    </div>
                </div>

                <form @submit.prevent="sendInquiry()" class="space-y-4">

                    {{-- Step 1: Pilih Kategori Kemitraan --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-2">
                            1. Pilih Kategori Kolaborasi yang Sesuai:
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-2 gap-2 text-xs">
                            <button type="button" @click="selectedKemitraan = 'csr'"
                                    :class="selectedKemitraan === 'csr' ? 'bg-[#052c24] text-[#BEF264] border-[#052c24]' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                                    class="p-3 rounded-2xl border text-left font-bold transition-all">
                                <span class="block text-[9px] text-slate-400 font-mono mb-0.5">LEMBAGA & DONOR</span>
                                <span class="text-xs font-black">Kemitraan CSR & Hibah</span>
                            </button>

                            <button type="button" @click="selectedKemitraan = 'komunitas'"
                                    :class="selectedKemitraan === 'komunitas' ? 'bg-[#052c24] text-[#BEF264] border-[#052c24]' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                                    class="p-3 rounded-2xl border text-left font-bold transition-all">
                                <span class="block text-[9px] text-slate-400 font-mono mb-0.5">DESA & KELOMPOK TANI</span>
                                <span class="text-xs font-black">Digitalisasi & Dampingan</span>
                            </button>

                            <button type="button" @click="selectedKemitraan = 'riset'"
                                    :class="selectedKemitraan === 'riset' ? 'bg-[#052c24] text-[#BEF264] border-[#052c24]' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                                    class="p-3 rounded-2xl border text-left font-bold transition-all">
                                <span class="block text-[9px] text-slate-400 font-mono mb-0.5">PENELITI & KAMPUS</span>
                                <span class="text-xs font-black">Riset & Akses Data</span>
                            </button>

                            <button type="button" @click="selectedKemitraan = 'volunteer'"
                                    :class="selectedKemitraan === 'volunteer' ? 'bg-[#052c24] text-[#BEF264] border-[#052c24]' : 'bg-slate-50 text-slate-700 border-slate-200 hover:bg-slate-100'"
                                    class="p-3 rounded-2xl border text-left font-bold transition-all">
                                <span class="block text-[9px] text-slate-400 font-mono mb-0.5">PEMUDA & KOMUNITAS</span>
                                <span class="text-xs font-black">Aksi Kerelawanan</span>
                            </button>
                        </div>
                    </div>

                    {{-- Step 2: Identitas Pengirim --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Nama Lengkap Anda *
                            </label>
                            <input type="text" x-model="senderName" required placeholder="Contoh: Budi Pratama"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                                Lembaga / Perusahaan / Instansi *
                            </label>
                            <input type="text" x-model="senderOrg" required placeholder="Nama instansi atau komunitas"
                                   class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                        </div>
                    </div>

                    {{-- Step 3: Kontak Email Pengirim --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                            Alamat Email Anda untuk Balasan Resmi *
                        </label>
                        <input type="email" x-model="senderEmail" required placeholder="nama@instansi.org"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-bold focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50">
                    </div>

                    {{-- Step 4: Pesan / Kebutuhan --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-wider text-slate-500 mb-1">
                            Deskripsi Rencana Inisiatif & Wilayah Target
                        </label>
                        <textarea x-model="senderMessage" rows="3" placeholder="Jelaskan secara ringkas maksud kerja sama, cakupan wilayah, target penerima manfaat, atau linimasa yang diharapkan..."
                                  class="w-full px-4 py-2.5 rounded-xl border border-slate-200 text-xs font-normal focus:ring-2 focus:ring-emerald-600 focus:outline-none bg-slate-50/50 leading-relaxed"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-2">
                        <button type="submit"
                                class="w-full py-3.5 px-6 rounded-2xl bg-[#052c24] text-[#BEF264] hover:bg-emerald-800 text-xs font-black uppercase tracking-wider transition-all shadow-md flex items-center justify-center gap-2 hover:scale-[1.01]">
                            <span>Kirim Pengajuan Langsung ke hello@siyota.org</span>
                            <span>→</span>
                        </button>
                        <p class="text-[10px] text-slate-400 text-center mt-2 font-normal">
                            Pengajuan akan otomatis diteruskan ke meja surel resmi organisasi dan ditanggapi dalam 1-2 hari kerja.
                        </p>
                    </div>

                </form>

            </div>

        </div>

        {{-- 3. INTERACTIVE MAP SECTION (COMPACT & CLEAN) --}}
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/90 shadow-sm">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-wider text-slate-400">PETA LOKASI KANTOR PUSAT</span>
                    <h3 class="text-sm font-black text-[#052c24] uppercase">Sekretariat Yayasan Yota Wujudkan Asa</h3>
                </div>
                <a href="https://maps.app.goo.gl/ChIJIc4MJfPraC4RP9IkIgGWwe4" target="_blank"
                   class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-[#052c24] text-[#052c24] hover:text-[#BEF264] text-[10px] font-black uppercase tracking-wider transition-all">
                    <span>Buka di Google Maps</span>
                    <span>↗</span>
                </a>
            </div>

            <div class="w-full h-64 sm:h-72 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200">
                <iframe
                    title="Peta Lokasi Kantor Pusat Yayasan Yota Wujudkan Asa"
                    width="100%"
                    height="100%"
                    frameborder="0"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.0000000000!2d107.59407667!3d-7.0114901!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68f3f3260cce21%3A0xeec196012224d23f!2sYayasan%20Yota%20Wujudkan%20asa!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid">
                </iframe>
            </div>
        </div>

    </div>
</main>
@endsection

@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-12">
            <a href="{{ route('kabid.proposal.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                <i class="fas fa-arrow-left"></i> Kembali ke Arsip
            </a>
            <div class="text-right">
                <span class="text-[10px] font-black text-lime-500 uppercase tracking-[0.3em] block">New Submission</span>
                <h2 class="text-2xl font-black text-[#064e3b] uppercase italic">Form Pengajuan</h2>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="h-3 w-full bg-[#064e3b]"></div>

            <form action="{{ route('kabid.proposal.store') }}" method="POST" class="p-8 md:p-16 space-y-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Judul Pengajuan</label>
                        <input type="text" name="title" required placeholder="Contoh: Pengadaan Laptop Divisi"
                               class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 focus:bg-white transition-all outline-none">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Kategori</label>
                        <select name="category" id="categorySelect" required
                                class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-lime-500 focus:bg-white transition-all outline-none">
                            <option value="program">Program Kerja</option>
                            <option value="budget">Anggaran / Finansial</option>
                            <option value="inventory">Inventaris / Barang</option>
                            <option value="human_resource">SDM / Relawan</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                </div>

                <div id="budgetSection" class="hidden transition-all duration-500">
                    <div class="p-8 bg-lime-50 rounded-[2.5rem] border border-lime-100 space-y-3">
                        <label class="text-[10px] font-black uppercase text-lime-700 tracking-widest ml-2 flex items-center gap-2">
                            <i class="fas fa-coins"></i> Estimasi Total Anggaran (Rp)
                        </label>
                        <input type="number" name="estimated_cost" id="costInput" placeholder="Masukkan angka saja, misal: 5000000"
                               class="w-full bg-white border-2 border-lime-200 rounded-2xl p-4 text-xl font-black text-[#064e3b] focus:border-[#064e3b] outline-none transition-all">
                        <p class="text-[9px] text-lime-600 font-bold italic mt-2 ml-2">*Wajib diisi untuk pengajuan kategori Anggaran.</p>
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Penjelasan Detail / Latar Belakang</label>
                    <textarea name="description" rows="6" required placeholder="Jelaskan secara rinci tujuan dan urgensi pengajuan ini..."
                              class="w-full bg-slate-50 border-2 border-slate-50 rounded-[2.5rem] p-8 text-sm font-medium text-slate-600 focus:border-lime-500 focus:bg-white transition-all outline-none leading-relaxed"></textarea>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Link Dokumen Pendukung (Opsional)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-300">
                            <i class="fas fa-link text-xs"></i>
                        </span>
                        <input type="url" name="document_url" placeholder="https://drive.google.com/..."
                               class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 pl-12 text-sm font-bold text-[#064e3b] focus:border-lime-500 focus:bg-white transition-all outline-none">
                    </div>
                    <p class="text-[9px] text-slate-400 ml-2 italic">Pastikan link dokumen dapat diakses oleh Direktur (Open Access).</p>
                </div>

                <div class="pt-10">
                    <button type="submit" class="w-full py-6 bg-[#064e3b] text-white rounded-3xl font-black uppercase text-[11px] tracking-[0.4em] hover:bg-lime-400 hover:text-[#064e3b] hover:shadow-2xl transition-all shadow-xl shadow-slate-100 flex items-center justify-center gap-4">
                        Ajukan Proposal Sekarang <i class="fas fa-paper-plane text-[10px]"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('categorySelect');
        const budgetSection = document.getElementById('budgetSection');
        const costInput = document.getElementById('costInput');

        function toggleBudget() {
            if (categorySelect.value === 'budget') {
                budgetSection.classList.remove('hidden');
                costInput.setAttribute('required', 'required');
                // Trigger animation (optional)
                budgetSection.classList.add('animate-fadeIn');
            } else {
                budgetSection.classList.add('hidden');
                costInput.removeAttribute('required');
                costInput.value = ''; // Reset value
            }
        }

        categorySelect.addEventListener('change', toggleBudget);

        // Run on load to handle back button or old input
        toggleBudget();
    });
</script>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn {
        animation: fadeIn 0.5s ease forwards;
    }
</style>
@endsection

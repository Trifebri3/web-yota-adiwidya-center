@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-10 font-['Plus_Jakarta_Sans']">
    <div class="max-w-4xl mx-auto">

        <div class="flex items-center justify-between mb-12">
            <a href="{{ route('kabid.proposal.index') }}" class="flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-[#064e3b] transition-all">
                <i class="fas fa-arrow-left"></i> Batal & Kembali
            </a>
            <div class="text-right">
                <span class="text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] block">Edit Submission</span>
                <h2 class="text-2xl font-black text-[#064e3b] uppercase italic">{{ $proposal->reference_number }}</h2>
            </div>
        </div>

        <div class="bg-white rounded-[3.5rem] shadow-2xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
            <div class="h-3 w-full bg-blue-500"></div>

            <form action="{{ route('kabid.proposal.update', $proposal->id) }}" method="POST" class="p-8 md:p-16 space-y-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Judul Pengajuan</label>
                        <input type="text" name="title" value="{{ old('title', $proposal->title) }}" required
                               class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-blue-400 focus:bg-white transition-all outline-none">
                    </div>

                    <div class="space-y-3">
                        <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Kategori</label>
                        <select name="category" id="categorySelect" required
                                class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-blue-400 focus:bg-white transition-all outline-none">
                            <option value="program" {{ $proposal->category == 'program' ? 'selected' : '' }}>Program Kerja</option>
                            <option value="budget" {{ $proposal->category == 'budget' ? 'selected' : '' }}>Anggaran / Finansial</option>
                            <option value="inventory" {{ $proposal->category == 'inventory' ? 'selected' : '' }}>Inventaris / Barang</option>
                            <option value="human_resource" {{ $proposal->category == 'human_resource' ? 'selected' : '' }}>SDM / Relawan</option>
                            <option value="other" {{ $proposal->category == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                </div>

                <div id="budgetSection" class="{{ $proposal->category == 'budget' ? '' : 'hidden' }} transition-all duration-500">
                    <div class="p-8 bg-blue-50 rounded-[2.5rem] border border-blue-100 space-y-3">
                        <label class="text-[10px] font-black uppercase text-blue-700 tracking-widest ml-2 flex items-center gap-2">
                            <i class="fas fa-coins"></i> Perbarui Estimasi Anggaran (Rp)
                        </label>
                        <input type="number" name="estimated_cost" id="costInput" value="{{ old('estimated_cost', $proposal->estimated_cost) }}"
                               class="w-full bg-white border-2 border-blue-200 rounded-2xl p-4 text-xl font-black text-[#064e3b] focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Penjelasan Detail / Perubahan</label>
                    <textarea name="description" rows="6" required
                              class="w-full bg-slate-50 border-2 border-slate-50 rounded-[2.5rem] p-8 text-sm font-medium text-slate-600 focus:border-blue-400 focus:bg-white transition-all outline-none leading-relaxed">{{ old('description', $proposal->description) }}</textarea>
                </div>

                <div class="space-y-3">
                    <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest ml-2">Link Dokumen (G-Drive/Cloud)</label>
                    <input type="url" name="document_url" value="{{ old('document_url', $proposal->document_url) }}"
                           class="w-full bg-slate-50 border-2 border-slate-50 rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:border-blue-400 focus:bg-white transition-all outline-none">
                </div>

                @if($proposal->status == 'revised')
                <div class="p-6 bg-red-50 rounded-2xl border border-red-100">
                    <p class="text-[9px] font-black text-red-600 uppercase tracking-widest mb-2">Catatan Revisi Sebelumnya:</p>
                    <p class="text-xs text-red-800 italic">"{{ $proposal->notes_from_reviewer ?? 'Silakan perbaiki data sesuai instruksi.' }}"</p>
                </div>
                @endif

                <div class="pt-10">
                    <button type="submit" class="w-full py-6 bg-[#064e3b] text-white rounded-3xl font-black uppercase text-[11px] tracking-[0.4em] hover:bg-blue-600 hover:shadow-2xl transition-all shadow-xl shadow-slate-100 flex items-center justify-center gap-4">
                        Simpan Perubahan Proposal <i class="fas fa-save text-[10px]"></i>
                    </button>
                    <p class="text-[9px] text-slate-400 text-center mt-6 uppercase font-bold tracking-widest">
                        Status akan kembali menjadi <span class="text-[#064e3b]">Pending</span> setelah diperbarui.
                    </p>
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
            } else {
                budgetSection.classList.add('hidden');
                costInput.removeAttribute('required');
            }
        }

        categorySelect.addEventListener('change', toggleBudget);
    });
</script>
@endsection

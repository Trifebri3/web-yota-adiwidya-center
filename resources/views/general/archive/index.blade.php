@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    /* Premium Spreadsheet Layer */
    .sheet-container {
        background: #ffffff;
        border-radius: 35px;
        border: 1px solid #f1f5f9;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0,0,0,0.02);
    }
    .sheet-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .sheet-header {
        background: #fafafa;
        border-bottom: 2px solid #f1f5f9;
    }
    .sheet-header th {
        padding: 18px 24px;
        font-size: 10px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94a3b8;
        border-right: 1px solid #f1f5f9;
    }
    .sheet-row {
        transition: all 0.2s ease;
    }
    .sheet-row:hover {
        background: #f8fafc;
    }
    .sheet-cell {
        padding: 16px 24px;
        border-bottom: 1px solid #f1f5f9;
        border-right: 1px solid #f8fafc;
        font-size: 12px;
        font-weight: 600;
        color: #334155;
    }
    .category-pill {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        color: white;
    }
    .btn-link-premium {
        background: #064e3b;
        color: #bef264;
        padding: 8px 16px;
        border-radius: 12px;
        font-size: 9px;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }
    .btn-link-premium:hover {
        background: #000;
        transform: translateY(-2px);
    }
</style>

<div class="min-h-screen bg-[#fafafa] p-6 md:p-12 font-['Plus_Jakarta_Sans']">
    <div class="max-w-7xl mx-auto">

        <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
            <div>
                <span class="text-[10px] font-black text-lime-600 uppercase tracking-[0.5em] block mb-3">Cloud Directory</span>
                <h1 class="text-6xl font-black text-[#064e3b] tracking-tighter uppercase leading-none">
                    Digital <span class="italic font-serif text-slate-300">Links.</span>
                </h1>
            </div>

            <div class="flex gap-3">
                <button onclick="document.getElementById('modal-add').style.display='flex'"
                   class="bg-[#064e3b] text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-lime-400 hover:text-[#064e3b] transition-all shadow-xl flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                    Archive New Link
                </button>
            </div>
        </div>

        <div class="sheet-container">
            <div class="overflow-x-auto">
                <table class="sheet-table">
                    <thead class="sheet-header">
                        <tr>
                            <th class="w-12 text-center">#</th>
                            <th class="text-left">Judul & Tautan</th>
                            <th class="text-center w-40">Kategori</th>
                            <th class="text-center w-32">Privasi</th>
                            <th class="text-center w-48 text-slate-300">Disimpan Oleh</th>
                            <th class="text-right w-48 px-8">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($archives as $index => $item)
                        <tr class="sheet-row">
                            <td class="sheet-cell text-center text-slate-300 font-black italic">{{ $archives->firstItem() + $index }}</td>
                            <td class="sheet-cell">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-slate-50 border border-slate-100 rounded-xl flex items-center justify-center text-[#064e3b]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-black text-[#064e3b] uppercase leading-tight">{{ $item->title }}</span>
                                        <span class="text-[9px] text-blue-500 font-bold mt-1 truncate max-w-xs">{{ $item->link_url }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="sheet-cell text-center">
                                <span class="category-pill" style="background: {{ $item->label_color }}">
                                    {{ $item->category }}
                                </span>
                            </td>
                            <td class="sheet-cell text-center text-[9px] font-black uppercase italic">
                                @if($item->is_public)
                                    <span class="text-blue-500">Public Access</span>
                                @else
                                    <span class="text-amber-600">Private Link</span>
                                @endif
                            </td>
                            <td class="sheet-cell text-center text-[10px] font-bold text-slate-400">
                                {{ $item->user->name }}
                            </td>
                            <td class="sheet-cell px-8">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ $item->link_url }}" target="_blank" class="btn-link-premium">
                                        Open <i class="fas fa-external-link-alt text-[8px]"></i>
                                    </a>

                                    @if($item->user_id === Auth::id())
                                    <form action="{{ route('general.archive.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus tautan dari arsip?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-20 text-center text-slate-400 font-bold italic text-xs uppercase tracking-widest">
                                Belum ada tautan yang diarsipkan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 px-8">
            {{ $archives->links() }}
        </div>
    </div>
</div>

{{-- MODAL ADD --}}
<div id="modal-add" style="display:none;" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[99] items-center justify-center p-6">
    <div class="bg-white w-full max-w-xl rounded-[3rem] p-10 shadow-2xl">
        <h3 class="text-2xl font-black text-[#064e3b] uppercase italic mb-8">Archive <span class="text-lime-500">New Link</span></h3>
        <form action="{{ route('general.archive.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Judul Tautan</label>
                <input type="text" name="title" required placeholder="Contoh: Database Proposal 2026" class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400 outline-none">
            </div>

            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">URL / Link Lengkap</label>
                <input type="url" name="link_url" required placeholder="https://google.drive/..." class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-blue-600 focus:ring-2 focus:ring-blue-400 outline-none">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Kategori</label>
                    <input type="text" name="category" placeholder="Finansial/Teknis" required class="w-full bg-slate-50 border-none rounded-2xl p-4 text-sm font-bold text-[#064e3b]">
                </div>
                <div>
                    <label class="text-[9px] font-black uppercase tracking-widest text-slate-400 ml-2">Warna Identifikasi</label>
                    <input type="color" name="label_color" value="#064e3b" class="w-full h-12 bg-slate-50 border-none rounded-2xl p-1 cursor-pointer">
                </div>
            </div>

            <div>
                <label class="flex items-center gap-3 cursor-pointer mt-2">
                    <input type="checkbox" name="is_public" class="w-5 h-5 rounded-md border-slate-300 text-[#064e3b] focus:ring-[#064e3b]">
                    <span class="text-xs font-black text-slate-500 uppercase italic">Jadikan Tautan Publik (Dapat dilihat semua divisi)</span>
                </label>
            </div>

            <div class="flex gap-4 pt-6">
                <button type="button" onclick="this.closest('#modal-add').style.display='none'" class="flex-1 text-[10px] font-black uppercase text-slate-400">Batal</button>
                <button type="submit" class="flex-[2] bg-[#064e3b] text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl">Simpan Tautan</button>
            </div>
        </form>
    </div>
</div>
@endsection

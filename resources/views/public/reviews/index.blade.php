@extends('public.layouts.app')

@section('content')
<div class="bg-[#FDFDFB] min-h-screen">
    <div class="bg-[#064e3b] py-24 px-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" fill="none" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white"></path>
            </svg>
        </div>
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <span class="inline-block px-4 py-1.5 rounded-full bg-lime-400 text-[#064e3b] text-[10px] font-bold tracking-[0.3em] uppercase mb-6">
                Suara Komunitas
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-6">
                Dampak & <span class="text-lime-400 italic font-serif">Inspirasi.</span>
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($reviews as $review)
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-500">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="{{ $review->photo_url }}" class="w-14 h-14 rounded-2xl object-cover border-2 border-slate-50">
                            <div>
                                <h4 class="font-black text-slate-900 leading-tight">{{ $review->name }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $review->position ?? 'Mitra/Masyarakat' }}</p>
                            </div>
                        </div>

                        <p class="text-slate-600 italic text-sm leading-relaxed mb-6">
                            "{{ $review->comment }}"
                        </p>

                        <div class="flex items-center justify-between mt-auto pt-6 border-t border-slate-50">
                            <span class="text-[9px] font-bold text-slate-300 uppercase">{{ $review->created_at->diffForHumans() }}</span>
                            <div class="flex gap-0.5">
                                @for($i=1; $i<=5; $i++)
                                    <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-lime-500' : 'text-slate-100' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-20 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                        <p class="text-slate-400 font-medium">Belum ada ulasan yang disetujui untuk tampil.</p>
                    </div>
                    @endforelse
                </div>

                <div class="mt-12">
                    {{ $reviews->links() }}
                </div>
            </div>

            <div class="lg:col-span-4">
                <div class="bg-[#064e3b] p-10 rounded-[3rem] text-white sticky top-10 shadow-2xl">
                    <h3 class="text-2xl font-black mb-2 uppercase tracking-tight">Kirim Ulasan</h3>
                    <p class="text-lime-200/50 text-xs mb-8 font-medium italic">Ulasan Anda akan melalui proses verifikasi oleh tim Haran.</p>

                    @if(session('success'))
                        <div class="bg-lime-400 text-[#064e3b] p-4 rounded-2xl mb-6 text-[10px] font-black uppercase text-center">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-500/20 border border-red-500/50 p-4 rounded-2xl mb-6 text-[10px] text-red-200 font-bold uppercase">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>• {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('public.reviews.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                        @csrf
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2 block">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none transition-all" placeholder="Contoh: Budi Santoso" required>
                        </div>

                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2 block">Jabatan / Lokasi</label>
                            <input type="text" name="position" value="{{ old('position') }}" class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none" placeholder="Contoh: Petani Lokal">
                        </div>

                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2 block">Rating Kepuasan</label>
                            <select name="rating" class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none appearance-none text-lime-400 font-bold">
                                <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>⭐⭐⭐⭐⭐ (Sangat Puas)</option>
                                <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>⭐⭐⭐⭐ (Puas)</option>
                                <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>⭐⭐⭐ (Cukup)</option>
                                <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>⭐⭐ (Kurang)</option>
                                <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>⭐ (Kecewa)</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2 block">Ulasan Anda</label>
                            <textarea name="comment" rows="4" class="w-full bg-white/5 border border-white/10 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-lime-400 outline-none" placeholder="Minimal 10 karakter..." required>{{ old('comment') }}</textarea>
                        </div>

                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-white/40 mb-2 block">Foto Profil (Opsional)</label>
                            <input type="file" name="photo" class="text-[10px] text-white/60 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:uppercase file:bg-lime-400 file:text-[#064e3b] hover:file:bg-white cursor-pointer">
                        </div>

                        <button type="submit" class="w-full py-5 bg-lime-400 text-[#064e3b] rounded-[2rem] font-black uppercase text-xs tracking-[0.2em] hover:bg-white transition-all shadow-xl">
                            Kirim Review Sekarang
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@extends('omc.layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
            <div>
                <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Moderasi Review</h1>
                <p class="text-slate-500 text-sm font-medium mt-1">Kelola testimoni dan ulasan dari publik.</p>
            </div>

            <div class="flex gap-4">
                <div class="bg-white px-6 py-4 rounded-[2rem] shadow-sm border border-slate-100 text-center min-w-[120px]">
                    <span class="block text-[10px] font-black uppercase text-slate-400 tracking-widest mb-1">Total</span>
                    <span class="text-xl font-black text-slate-800">{{ $stats['total'] }}</span>
                </div>
                <div class="bg-amber-50 px-6 py-4 rounded-[2rem] shadow-sm border border-amber-100 text-center min-w-[120px]">
                    <span class="block text-[10px] font-black uppercase text-amber-500 tracking-widest mb-1">Pending</span>
                    <span class="text-xl font-black text-amber-600">{{ $stats['pending'] }}</span>
                </div>
                <div class="bg-lime-50 px-6 py-4 rounded-[2rem] shadow-sm border border-lime-100 text-center min-w-[120px]">
                    <span class="block text-[10px] font-black uppercase text-lime-600 tracking-widest mb-1">Aktif</span>
                    <span class="text-xl font-black text-lime-700">{{ $stats['published'] }}</span>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-lime-400 rounded-2xl text-[#052c24] text-xs font-black uppercase tracking-widest shadow-lg shadow-lime-500/20">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($reviews as $review)
            <div class="bg-white rounded-[2.5rem] border {{ $review->is_published ? 'border-slate-100' : 'border-amber-200 bg-amber-50/30' }} p-8 flex flex-col shadow-sm hover:shadow-md transition-all">

                <div class="mb-6">
                    @if($review->is_published)
                        <span class="px-3 py-1 bg-lime-100 text-lime-700 text-[9px] font-black uppercase tracking-widest rounded-full">Published</span>
                    @else
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 text-[9px] font-black uppercase tracking-widest rounded-full italic font-serif">Waiting Approval</span>
                    @endif
                </div>

                <div class="flex items-center gap-4 mb-6">
                    <img src="{{ $review->photo ? asset('storage/'.$review->photo) : 'https://ui-avatars.com/api/?name='.urlencode($review->name).'&background=cbd5e1&color=64748b' }}"
                         class="w-12 h-12 rounded-2xl object-cover border-2 border-white shadow-sm">
                    <div>
                        <h4 class="font-black text-slate-800 leading-tight">{{ $review->name }}</h4>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $review->position ?? 'No Position' }}</p>
                    </div>
                </div>

                <div class="flex-grow">
                    <div class="flex gap-0.5 mb-3">
                        @for($i=1; $i<=5; $i++)
                            <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-lime-500' : 'text-slate-200' }}" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                            </svg>
                        @endfor
                    </div>
                    <p class="text-slate-600 text-sm italic leading-relaxed">
                        "{{ $review->comment }}"
                    </p>
                </div>

                <div class="mt-8 pt-6 border-t border-slate-50 flex items-center justify-between gap-3">
                    <form action="{{ route('omc.reviews.toggle', $review->id) }}" method="POST" class="flex-grow">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="w-full py-3 {{ $review->is_published ? 'bg-slate-100 text-slate-600' : 'bg-lime-400 text-[#052c24]' }} rounded-xl text-[10px] font-black uppercase tracking-[0.1em] hover:opacity-80 transition-all">
                            {{ $review->is_published ? 'Unpublish' : 'Approve / ACC' }}
                        </button>
                    </form>

                    <form action="{{ route('omc.reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus review ini secara permanen?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-3 bg-red-50 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200 text-slate-400">
                Belum ada review yang masuk dari publik.
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

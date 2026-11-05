@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    /* Custom CSS untuk memastikan hasil copy-paste tetap rapi */
    .prose blockquote {
        border-left-color: #84cc16 !important; /* lime-500 */
        font-style: italic;
        background-color: #f8fafc;
        padding: 1.5rem;
        border-radius: 0 1.5rem 1.5rem 0;
    }
    .prose table {
        width: 100% !important;
        border-collapse: collapse;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .prose th {
        background-color: #064e3b;
        color: white;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
        padding: 1rem;
    }
    .prose td {
        border: 1px solid #e2e8f0;
        padding: 0.75rem;
        color: #475569;
    }
    .prose img {
        margin-left: auto;
        margin-right: auto;
        border: 8px solid #f1f5f9;
    }
    .prose a {
        color: #064e3b;
        font-weight: 800;
        text-decoration: underline;
        text-underline-offset: 4px;
    }
    .prose a:hover {
        color: #84cc16;
    }
</style>

<div class="min-h-screen bg-[#F8FAFC] p-4 md:p-10">
    <div class="max-w-4xl mx-auto">
        
        {{-- Navigation Header --}}
        <div class="mb-8 flex justify-between items-center">
            <a href="{{ route('announcement.index') }}" class="group inline-flex items-center gap-3">
                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-sm group-hover:bg-[#064e3b] transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#064e3b] group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 group-hover:text-[#064e3b] transition-colors">Kembali ke Bulletin</span>
            </a>

            <div class="hidden md:block">
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">Internal Document ID: #ANN-{{ str_pad($announcement->id, 4, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        @php
            $colors = [
                'urgent' => ['bg' => 'bg-red-600', 'text' => 'text-white', 'light' => 'bg-red-50'],
                'high'   => ['bg' => 'bg-orange-500', 'text' => 'text-white', 'light' => 'bg-orange-50'],
                'medium' => ['bg' => 'bg-blue-500', 'text' => 'text-white', 'light' => 'bg-blue-50'],
                'low'    => ['bg' => 'bg-slate-500', 'text' => 'text-white', 'light' => 'bg-slate-50'],
            ][$announcement->priority] ?? ['bg' => 'bg-slate-500', 'text' => 'text-white', 'light' => 'bg-slate-50'];
        @endphp

        <article class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200/60 overflow-hidden border border-slate-100 relative">
            
            {{-- Accent Top Bar --}}
            <div class="h-3 {{ $colors['bg'] }}"></div>

            <div class="p-8 md:p-16">
                
                {{-- Meta Info --}}
                <div class="flex flex-wrap items-center gap-4 mb-10">
                    <span class="{{ $colors['bg'] }} {{ $colors['text'] }} px-5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-current/20">
                        {{ $announcement->priority }}
                    </span>
                    <div class="h-1 w-1 bg-slate-300 rounded-full"></div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        Published: {{ $announcement->created_at->format('d M Y') }}
                    </span>
                    @if($announcement->division)
                        <div class="h-1 w-1 bg-slate-300 rounded-full"></div>
                        <span class="text-[10px] font-bold text-[#064e3b] uppercase tracking-widest bg-lime-100 px-3 py-1 rounded-md">
                            {{ $announcement->division->name }}
                        </span>
                    @endif
                </div>

                {{-- Title --}}
                <header class="mb-12">
                    <h1 class="text-4xl md:text-7xl font-black text-[#064e3b] uppercase italic leading-[0.85] tracking-tighter">
                        {{ $announcement->title }}
                    </h1>
                </header>

                {{-- Main Content Container --}}
                <div class="border-t border-dashed border-slate-200 pt-12">
                    <div class="prose prose-slate max-w-none 
                                prose-p:text-slate-600 prose-p:leading-relaxed prose-p:text-lg
                                prose-headings:uppercase prose-headings:italic prose-headings:font-black prose-headings:text-[#064e3b] prose-headings:tracking-tight
                                prose-strong:text-[#064e3b] prose-strong:font-black
                                prose-ul:list-disc prose-ol:list-decimal
                                prose-img:rounded-[2.5rem]
                                break-words overflow-x-hidden">
                        
                        {!! $announcement->content !!}

                    </div>
                </div>

                {{-- Signature Section --}}
                <div class="mt-20 flex flex-col md:flex-row md:items-center justify-between gap-8 p-10 bg-[#f8fafc] rounded-[2.5rem] border border-slate-100">
                    <div class="flex items-center gap-6">
                        <div class="w-20 h-20 bg-[#064e3b] rounded-[1.5rem] flex items-center justify-center font-black text-lime-400 text-3xl rotate-3 shadow-xl">
                            {{ substr($announcement->author->name, 0, 2) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase text-slate-400 tracking-[0.3em] mb-1">Authenticated By</p>
                            <p class="text-2xl font-black text-[#064e3b] uppercase italic leading-none">{{ $announcement->author->name }}</p>
                            <p class="text-[11px] font-bold text-lime-600 uppercase tracking-widest mt-2 flex items-center gap-2">
                                <span class="w-2 h-2 bg-lime-500 rounded-full animate-pulse"></span>
                                Verified Management
                            </p>
                        </div>
                    </div>

                    {{-- QR or Stamp Placeholder --}}
                    <div class="opacity-10 hidden md:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-[#064e3b]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                </div>
            </div>
            
            {{-- Expiry Notice --}}
            @if($announcement->expires_at)
            <div class="{{ $colors['light'] }} py-6 px-16 border-t border-dashed border-current/20">
                <p class="text-[10px] font-black {{ str_replace('bg-', 'text-', $colors['bg']) }} uppercase tracking-[0.4em] text-center">
                    Notice: This announcement will expire on {{ \Carbon\Carbon::parse($announcement->expires_at)->format('d F Y') }}
                </p>
            </div>
            @endif
        </article>

        {{-- Footer Decorative --}}


    </div>
</div>
@endsection
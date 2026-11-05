@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<style>
    .profile-card {
        background: #ffffff;
        border-radius: 40px;
        border: 1px solid #f1f5f9;
        overflow: hidden;
    }
    .stat-box {
        background: #fafafa;
        border-radius: 24px;
        padding: 24px;
        border: 1px solid #f1f5f9;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-box:hover {
        background: #ffffff;
        border-color: #bef264;
        transform: translateY(-8px);
        box-shadow: 0 20px 30px -10px rgba(6, 78, 59, 0.05);
    }
    .activity-line {
        position: absolute;
        left: 7px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #f1f5f9;
    }
</style>

<div class="p-8 md:p-12 bg-[#fafafa] min-h-screen font-['Plus_Jakarta_Sans']">
    <div class="max-w-6xl mx-auto">

        <div class="flex items-center gap-5 mb-12">
            <a href="{{ route('audit.index') }}" class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-[#064e3b] shadow-sm hover:bg-[#064e3b] hover:text-white transition-all">
                <i class="fas fa-chevron-left text-xs"></i>
            </a>
            <div>
                <h1 class="text-3xl font-black text-[#064e3b] uppercase italic tracking-tighter">User <span class="text-slate-300">Intelligence.</span></h1>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Digital Personnel Dossier</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            <div class="lg:col-span-1 space-y-8">
                <div class="profile-card p-10 text-center shadow-sm">
                    <div class="relative inline-block mb-8">
                        <div class="w-32 h-32 bg-[#064e3b] rounded-[40px] flex items-center justify-center text-4xl font-black text-lime-400 shadow-2xl shadow-emerald-900/20">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="absolute -bottom-2 -right-2 w-10 h-10 bg-white rounded-2xl flex items-center justify-center shadow-lg border border-slate-50">
                            <i class="fas fa-shield-alt text-[#064e3b] text-xs"></i>
                        </div>
                    </div>

                    <h2 class="text-2xl font-black text-[#064e3b] uppercase tracking-tight leading-tight mb-2">{{ $user->name }}</h2>
                    <p class="text-[10px] font-black text-lime-600 uppercase tracking-widest mb-8 bg-lime-50 py-2 rounded-xl inline-block px-4">
                        {{ $user->role->value ?? $user->role }} • {{ $user->division->name ?? 'Independen' }}
                    </p>

                    <div class="space-y-4 pt-8 border-t border-slate-50">
                        <div class="flex justify-between items-center text-[10px]">
                            <span class="font-black text-slate-300 uppercase tracking-widest">E-Mail Address</span>
                            <span class="font-bold text-[#064e3b]">{{ $user->email }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[10px]">
                            <span class="font-black text-slate-300 uppercase tracking-widest">Account Status</span>
                            <span class="bg-emerald-500 text-white px-3 py-1 rounded-lg font-black uppercase text-[8px] tracking-widest shadow-lg shadow-emerald-500/20">{{ $user->membership_status }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[10px]">
                            <span class="font-black text-slate-300 uppercase tracking-widest">Service Since</span>
                            <span class="font-black text-slate-500 italic">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="bg-[#064e3b] rounded-[35px] p-8 text-white relative overflow-hidden shadow-2xl">
                    <div class="relative z-10">
                        <p class="text-[10px] font-black uppercase tracking-[0.4em] text-lime-400 mb-4 italic">Security Notice</p>
                        <p class="text-xs font-medium leading-relaxed opacity-70 italic mb-0">Halaman ini merangkum data forensik digital pengurus. Penyebaran data tanpa izin melanggar protokol kerahasiaan Yayasan Yota.</p>
                    </div>
                    <i class="fas fa-fingerprint absolute -bottom-6 -right-6 text-8xl opacity-10 rotate-12"></i>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-10">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="stat-box">
                        <i class="fas fa-tasks text-indigo-500 text-lg mb-4"></i>
                        <h4 class="text-4xl font-black text-[#064e3b] leading-none mb-1">
                            {{ optional($user->kabidTasks)->count() ?? 0 }}
                        </h4>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Assigned Tasks</p>
                    </div>
                    <div class="stat-box">
                        <i class="fas fa-hand-holding-heart text-lime-500 text-lg mb-4"></i>
                        <h4 class="text-4xl font-black text-[#064e3b] leading-none mb-1">
                            {{ optional($user->handledServices)->count() ?? 0 }}
                        </h4>
                        <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Services Handled</p>
                    </div>
                </div>

                <div class="bg-white rounded-[40px] p-12 border border-slate-100 shadow-sm">
                    <div class="flex justify-between items-center mb-12">
                        <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter">Activity Audit Feed</h3>
                        <span class="text-[9px] font-black text-slate-300 uppercase tracking-widest border-b border-slate-100 pb-1">Real-time Tracing</span>
                    </div>

                    <div class="relative space-y-10">
                        <div class="activity-line"></div>

                        @forelse($activities ?? [] as $log)
                        <div class="relative flex items-start gap-8 group">
                            <div class="w-4 h-4 rounded-full bg-white border-4 border-slate-100 group-hover:border-lime-400 transition-all z-10 shadow-sm mt-1"></div>
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-1">
                                    <p class="text-[11px] font-black text-[#064e3b] uppercase tracking-tight">
                                        {{ $log->description }} <span class="text-slate-300 italic font-bold">on</span> {{ class_basename($log->subject_type) }}
                                    </p>
                                    <span class="text-[8px] font-black text-slate-200 uppercase">#ID-{{ $log->id }}</span>
                                </div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase italic">
                                    {{ $log->created_at->format('d M Y, H:i') }} • {{ $log->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16">
                            <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-ghost text-slate-200"></i>
                            </div>
                            <p class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">No activity footprints found</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <div class="bg-white rounded-[40px] p-12 border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-3 mb-10">
                        <div class="w-1.5 h-6 bg-lime-500 rounded-full"></div>
                        <h3 class="text-xl font-black text-[#064e3b] uppercase italic tracking-tighter leading-none">Recent Handled Services</h3>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        @forelse(optional($user->handledServices)->take(5) ?? [] as $service)
                        <div class="p-6 bg-slate-50 rounded-[2rem] border border-transparent hover:border-slate-200 hover:bg-white transition-all flex items-center justify-between">
                            <div>
                                <h5 class="text-[11px] font-black text-[#064e3b] uppercase tracking-tight">{{ Str::limit($service->title, 60) }}</h5>
                                <p class="text-[8px] font-bold text-slate-400 uppercase mt-1">{{ $service->created_at->format('d M Y') }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-lg text-[7px] font-black uppercase tracking-widest {{ $service->status == 'completed' ? 'bg-emerald-100 text-emerald-600' : 'bg-orange-100 text-orange-600' }}">
                                {{ $service->status }}
                            </span>
                        </div>
                        @empty
                        <p class="text-[10px] font-bold text-slate-300 uppercase italic py-4">Tidak ada riwayat pengerjaan layanan.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

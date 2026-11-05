@extends('kabid.layouts.app')


@section('content')
<div class="min-h-screen bg-[#FDFDFB] p-4 md:p-12" x-data="{ targetType: 'team' }">
    <div class="max-w-3xl mx-auto">

        <div class="mb-12">
            <a href="{{ route('kabid-tugas.index') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 hover:text-lime-500 transition-colors flex items-center gap-2 mb-4">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7"></path></svg>
                Back to Monitor
            </a>
            <h1 class="text-5xl font-black text-[#064e3b] tracking-tighter uppercase italic">Deploy <span class="text-lime-500">Task.</span></h1>
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-2">Assign new responsibilities to your division units</p>
        </div>

        <div class="bg-white rounded-[3rem] border border-slate-100 shadow-2xl shadow-lime-100/50 p-8 md:p-12">
            <form action="{{ route('kabid-tugas.store') }}" method="POST">
                @csrf

                <div class="space-y-8">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Task Subject</label>
                        <input type="text" name="title" placeholder="E.g. Laporan Audit Bulanan atau Riset Pasar"
                               class="w-full border-b-2 border-slate-100 focus:border-lime-400 border-t-0 border-x-0 px-0 py-4 text-xl font-bold text-[#064e3b] placeholder:text-slate-200 focus:ring-0 transition-all" required>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div @click="targetType = 'team'"
                             :class="targetType === 'team' ? 'border-lime-400 bg-lime-50' : 'border-slate-100 bg-slate-50'"
                             class="cursor-pointer border-2 p-6 rounded-[2rem] transition-all text-center">
                            <input type="radio" name="target_type" value="team" class="hidden" x-model="targetType">
                            <span :class="targetType === 'team' ? 'text-lime-700' : 'text-slate-400'" class="text-[10px] font-black uppercase tracking-widest">Group / Team</span>
                        </div>
                        <div @click="targetType = 'personal'"
                             :class="targetType === 'personal' ? 'border-blue-400 bg-blue-50' : 'border-slate-100 bg-slate-50'"
                             class="cursor-pointer border-2 p-6 rounded-[2rem] transition-all text-center">
                            <input type="radio" name="target_type" value="personal" class="hidden" x-model="targetType">
                            <span :class="targetType === 'personal' ? 'text-blue-700' : 'text-slate-400'" class="text-[10px] font-black uppercase tracking-widest">Individual</span>
                        </div>
                    </div>

                    <div class="animate-in fade-in slide-in-from-top-4 duration-500">
                        <template x-if="targetType === 'team'">
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Select Target Team</label>
                                <select name="team_id" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400">
                                    <option value="" disabled selected>Choose a team...</option>
                                    @foreach($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }} ({{ $team->members->count() }} Anggota)</option>
                                    @endforeach
                                </select>
                            </div>
                        </template>

                        <template x-if="targetType === 'personal'">
                            <div>
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Select Individual Member</label>
                                <select name="user_id" class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-blue-400">
                                    <option value="" disabled selected>Choose a person...</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </template>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Submission Deadline</label>
                        <input type="datetime-local" name="deadline"
                               class="w-full bg-slate-50 border-none rounded-2xl py-4 px-6 text-sm font-bold text-[#064e3b] focus:ring-2 focus:ring-lime-400" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-300 mb-4 block italic">Task Briefing / Instructions</label>
                        <textarea name="description" rows="6" placeholder="Jelaskan detail tugas, ekspektasi, dan kriteria pengumpulan link..."
                                  class="w-full bg-slate-50 border-none rounded-[2rem] py-6 px-8 text-sm font-medium text-slate-600 focus:ring-2 focus:ring-lime-400 placeholder:italic" required></textarea>
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full bg-[#064e3b] text-white py-6 rounded-[2rem] text-[11px] font-black uppercase tracking-[0.4em] shadow-2xl shadow-lime-200 hover:bg-lime-400 hover:text-[#064e3b] transition-all transform hover:-translate-y-1">
                            Deploy Task Now
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="mt-12 p-8 border-2 border-dashed border-slate-100 rounded-[3rem] text-center">
            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest italic">
                Tugas yang dideploy akan otomatis muncul di dashboard target (Tim/Individu). <br>
                Pastikan deskripsi mencakup instruksi pengumpulan link (Drive/Doc).
            </p>
        </div>
    </div>
</div>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection

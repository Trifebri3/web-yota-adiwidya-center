@php
    // Mencari user yang berulang tahun hari ini
    $birthdayUsers = \App\Models\User::whereMonth('dob', date('m'))
                        ->whereDay('dob', date('d'))
                        ->get();
@endphp

@if($birthdayUsers->isNotEmpty())
    {{-- CSS Khusus Banner (Bypass Global) --}}
    <style>
        .yota-birthday-banner {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #064e3b;
            border-radius: 3rem;
            padding: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.5);
            margin-bottom: 2.5rem;
            color: #ffffff;
        }
        .yota-avatar-stack {
            display: flex;
            align-items: center;
        }
        .yota-avatar-item {
            width: 100px;
            height: 100px;
            border-radius: 2rem;
            border: 4px solid #bef264;
            object-fit: cover;
            margin-left: -1rem;
            box-shadow: 0 10px 15px rgba(0,0,0,0.2);
            transition: transform 0.3s ease;
            background: #fff;
        }
        .yota-avatar-item:first-child { margin-left: 0; }
        .yota-avatar-item:hover { transform: scale(1.1) rotate(3deg); z-index: 50; }
        .yota-text-lime { color: #bef264; }
        .yota-font-serif { font-family: serif; font-style: italic; }

        @keyframes yota-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .yota-dot { width: 8px; height: 8px; border-radius: 50%; display: inline-block; }
    </style>

    <div class="yota-birthday-banner">
        {{-- Background Decoration --}}
        <div style="position: absolute; top: -20px; right: -20px; opacity: 0.1; color: #fff;">
            <svg width="200" height="200" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19 6h-3v-1c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v1h-3c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2v-12c0-1.103-.897-2-2-2zm-9-1h4v1h-4v-1zm9 15h-14v-12h3v1c0 1.103.897 2 2 2h4c1.103 0 2-.897 2-2v-1h3v12z"/>
            </svg>
        </div>

        <div style="position: relative; z-index: 10; display: flex; flex-wrap: wrap; align-items: center; gap: 2rem;">
            {{-- Foto Profil Stack --}}
            <div class="yota-avatar-stack">
                @foreach($birthdayUsers as $buser)
                    <div style="position: relative;">
                        <img src="{{ $buser->avatar ? asset('storage/'.$buser->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($buser->name).'&background=BEF264&color=064e3b&bold=true' }}"
                             class="yota-avatar-item" alt="Birthday User">
                        <div style="position: absolute; top: -5px; right: -5px; background: white; border-radius: 50%; padding: 4px; font-size: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">🎂</div>
                    </div>
                @endforeach
            </div>

            {{-- Ucapan --}}
            <div style="flex: 1; min-width: 300px;">
                <p style="font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.4em; color: #bef264; margin-bottom: 0.5rem;">Special Celebration</p>
                <h2 style="font-size: 2.5rem; font-weight: 900; text-transform: uppercase; letter-spacing: -2px; line-height: 1; margin-bottom: 1rem;">
                    Selamat Milad, <br>
                    <span class="yota-text-lime yota-font-serif" style="text-transform: none;">
                        @foreach($birthdayUsers as $buser)
                            {{ $buser->nickname ?? $buser->name }}{{ !$loop->last ? ' & ' : '' }}
                        @endforeach
                    </span>
                </h2>
                <p style="font-size: 14px; opacity: 0.8; font-style: italic; line-height: 1.6; max-width: 500px;">
                    "Semoga hari ini menjadi awal dari tahun yang penuh keberkahan, ide-ide segar, dan semangat yang tak padam untuk terus berkarya bersama kami di YOTA!"
                </p>
            </div>

            {{-- Status Badge --}}
            <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); padding: 1.5rem; border-radius: 2rem; border: 1px solid rgba(255,255,255,0.2); text-align: center; min-width: 180px;">
                <p style="font-size: 9px; font-weight: 900; text-transform: uppercase; color: #bef264; margin-bottom: 5px;">Status Member</p>
                <p style="font-size: 13px; font-weight: 700;">{{ $birthdayUsers->first()->division->name ?? 'Keluarga Besar' }}</p>
            </div>
        </div>

        {{-- Bouncing Dots Decoration --}}
        <div style="position: absolute; bottom: 1.5rem; right: 2.5rem; display: flex; gap: 8px;">
            <div class="yota-dot" style="background: #bef264; animation: yota-bounce 1s infinite;"></div>
            <div class="yota-dot" style="background: #ffffff; animation: yota-bounce 1s infinite 0.2s;"></div>
            <div class="yota-dot" style="background: #bef264; animation: yota-bounce 1s infinite 0.4s;"></div>
        </div>
    </div>
@endif

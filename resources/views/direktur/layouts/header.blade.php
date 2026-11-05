<header class="main-header">
    @php
        // Default ke 'direktur' jika session belum diset
        $activeMode = session('header_mode', 'direktur');
    @endphp

    <div class="header-wrapper">
        @if($activeMode === 'umum')
            @include('direktur.layouts.modeumum')
        @else
            @include('direktur.layouts.navdirektur')
        @endif

        {{-- Tombol Switch Melayang (Floating Switcher) --}}
        <div class="header-mode-switcher">
            @if($activeMode === 'direktur')
                <a href="{{ route('direktur.header.switch', 'umum') }}" class="switch-pill to-umum">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Switch to Common Mode
                </a>
            @else
                <a href="{{ route('direktur.header.switch', 'direktur') }}" class="switch-pill to-direktur">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    Back to Authority Nav
                </a>
            @endif
        </div>
    </div>
</header>

<style>
    .main-header { position: sticky; top: 0; z-index: 1000; background: #fff; border-bottom: 1px solid #f1f5f9; }
    .header-wrapper { position: relative; }

    .header-mode-switcher {
        position: absolute;
        bottom: -25px;
        right: 40px;
        z-index: 1001;
    }

    .switch-pill {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 9px;
        font-weight: 800;
        text-transform: uppercase;
        text-decoration: none;
        letter-spacing: 0.5px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        transition: 0.3s;
    }

    .to-umum { background: #0F172A; color: #BEF264; }
    .to-direktur { background: #BEF264; color: #0F172A; }
    .switch-pill:hover { transform: translateY(-2px); box-shadow: 0 15px 30px rgba(0,0,0,0.15); }
</style>

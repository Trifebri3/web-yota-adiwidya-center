@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="container-fluid py-4 yota-profile-wrapper" x-data="{ tab: 'identity' }" x-cloak>
    <div class="row g-4">

        <div class="col-xl-3 col-lg-4">
            <div class="card profile-header-card border-0 mb-4">
                <div class="card-body text-center py-5">
                    <div class="avatar-container mb-3">
                        <img src="{{ Auth::user()->identity->avatar_url ?? 'https://ui-avatars.com/api/?name='.Auth::user()->name }}"
                             class="rounded-circle profile-img-main" alt="Avatar">
                        <div class="status-indicator"></div>
                    </div>
                    <h5 class="fw-bold text-white mb-1">{{ Auth::user()->identity->full_name ?? Auth::user()->name }}</h5>
                    <p class="text-lemon-yota small fw-semibold mb-0">{{ Auth::user()->identity->professional_title ?? 'Grand Technology User' }}</p>
                </div>
            </div>

            <div class="card menu-card border-0 shadow-sm sticky-top" style="top: 20px; z-index: 10;">
                <div class="card-body p-3">
                    <h6 class="menu-label px-3 mb-3">CORE SETTINGS</h6>
                    <nav class="nav nav-pills flex-column gap-2">
                        @php
                            $menus = [
                                ['id' => 'identity', 'icon' => 'fa-user-circle', 'label' => 'Identitas Utama'],
                                ['id' => 'skills', 'icon' => 'fa-bolt', 'label' => 'Skills & Expertise'],
                                ['id' => 'experience', 'icon' => 'fa-briefcase', 'label' => 'Pengalaman Kerja'],
                                ['id' => 'education', 'icon' => 'fa-graduation-cap', 'label' => 'Pendidikan'],
                                ['id' => 'portfolios', 'icon' => 'fa-code', 'label' => 'Project Portfolio'],
                                ['id' => 'organizations', 'icon' => 'fa-sitemap', 'label' => 'Organisasi (NGO)'],
                                ['id' => 'achievements', 'icon' => 'fa-trophy', 'label' => 'Prestasi'],
                                ['id' => 'socials', 'icon' => 'fa-share-alt', 'label' => 'Social Links'],
                                ['id' => 'certifications', 'icon' => 'fa-certificate', 'label' => 'Sertifikasi'],
['id' => 'extra_skills', 'icon' => 'fa-lightbulb', 'label' => 'Additional Skills'],

                            ];
                        @endphp

                        @foreach($menus as $menu)
                        <button class="nav-link-custom d-flex align-items-center"
                                :class="tab === '{{ $menu['id'] }}' ? 'active-yota' : ''"
                                @click="tab = '{{ $menu['id'] }}'">
                            <span class="icon-box"><i class="fas {{ $menu['icon'] }}"></i></span>
                            <span class="label-text">{{ $menu['label'] }}</span>
                            <i class="fas fa-chevron-right ms-auto arrow-icon" x-show="tab === '{{ $menu['id'] }}'"></i>
                        </button>
                        @endforeach
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8">
            @if(session('success'))
                <div class="alert alert-yota-success d-flex align-items-center mb-4 fade show" role="alert">
                    <div class="icon-wrapper me-3">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <strong class="d-block">Success!</strong>
                        <span class="small">{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="content-display">
                <template x-if="tab === 'identity'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._identity_form')</div>
                </template>

                <template x-if="tab === 'skills'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._skills_manager')</div>
                </template>

                <template x-if="tab === 'experience'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._experience_manager')</div>
                </template>

                <template x-if="tab === 'education'">
                    <div x-transition:enter="fade-in">
                        @include('general.cv.partials._education_manager')
                        <div class="mt-4">@include('general.cv.partials._non_formal_manager')</div>
                    </div>
                </template>

                <template x-if="tab === 'portfolios'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._portfolio_manager')</div>
                </template>

                <template x-if="tab === 'organizations'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._organization_manager')</div>
                </template>

                <template x-if="tab === 'achievements'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._achievement_manager')</div>
                </template>

                <template x-if="tab === 'socials'">
                    <div x-transition:enter="fade-in">@include('general.cv.partials._social_manager')</div>
                </template>

                <div x-show="tab === 'certifications'" x-transition:enter.duration.300ms>
    @include('general.cv.partials._certification_manager')
</div>

<div x-show="tab === 'extra_skills'" x-transition:enter.duration.300ms>
    @include('general.cv.partials._additional_skills_manager')
</div>
            </div>
        </div>
    </div>
</div>

<style>
    /* 1. Root Variables & Font */
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    :root {
        --yota-dark: #052c24;
        --yota-dark-light: #0a4d3f;
        --yota-lemon: #BEF264;
        --yota-bg: #f4f7f6;
        --yota-text-muted: #64748b;
        --yota-white: #ffffff;
        --yota-transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .yota-profile-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: var(--yota-bg);
    }

    /* 2. Sidebar Header & Profile */
    .profile-header-card {
        background: linear-gradient(135deg, var(--yota-dark) 0%, var(--yota-dark-light) 100%);
        box-shadow: 0 15px 35px rgba(5, 44, 36, 0.15);
        overflow: hidden;
        position: relative;
    }

    .profile-header-card::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 150px;
        height: 150px;
        background: rgba(190, 242, 100, 0.05);
        border-radius: 50%;
    }

    .avatar-container {
        position: relative;
        display: inline-block;
    }

    .profile-img-main {
        width: 100px;
        height: 100px;
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        transition: var(--yota-transition);
    }

    .profile-img-main:hover {
        transform: rotate(5deg) scale(1.05);
    }

    .text-lemon-yota { color: var(--yota-lemon); }

    /* 3. Navigation Styling */
    .menu-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .menu-label {
        font-size: 10px;
        letter-spacing: 2px;
        color: var(--yota-text-muted);
        font-weight: 800;
    }

    .nav-link-custom {
        width: 100%;
        border: none;
        background: transparent;
        padding: 12px 16px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        transition: var(--yota-transition);
        color: #475569;
        text-decoration: none;
        margin-bottom: 4px;
    }

    .nav-link-custom:hover {
        background: #f1f5f9;
        color: var(--yota-dark);
        transform: translateX(8px);
    }

    .nav-link-custom .icon-box {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
        border-radius: 10px;
        margin-right: 12px;
        font-size: 14px;
        transition: var(--yota-transition);
    }

    .nav-link-custom.active-yota {
        background: var(--yota-dark);
        color: var(--yota-lemon);
        box-shadow: 0 10px 20px rgba(5, 44, 36, 0.15);
    }

    .nav-link-custom.active-yota .icon-box {
        background: rgba(190, 242, 100, 0.1);
        color: var(--yota-lemon);
    }

    .arrow-icon { font-size: 10px; opacity: 0.6; }

    /* 4. Alert Customization */
    .alert-yota-success {
        background: #ffffff;
        border-left: 5px solid #10b981;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        padding: 1.25rem;
    }

    .alert-yota-success .icon-wrapper {
        width: 40px;
        height: 40px;
        background: #ecfdf5;
        color: #10b981;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* 5. General Element Styling (For Partials) */
    .card {
        border-radius: 24px !important;
        transition: var(--yota-transition);
    }

    .form-control, .form-select {
        border-radius: 14px !important;
        padding: 12px 16px !important;
        border: 1.5px solid #eef2f6 !important;
        background-color: #fcfdfe !important;
        transition: var(--yota-transition) !important;
    }

    .form-control:focus {
        background-color: #fff !important;
        border-color: var(--yota-dark) !important;
        box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.08) !important;
    }

    /* 6. Animations */
    .fade-in {
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* 7. Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--yota-bg); }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--yota-text-muted); }

    [x-cloak] { display: none !important; }
</style>
@endsection

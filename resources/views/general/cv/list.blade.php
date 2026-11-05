@extends(Auth::user()->role->value . '.layouts.app')

@section('content')
<div class="container-fluid py-4 yota-list-wrapper">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-11">

            <div class="list-header-box d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
                <div class="d-flex align-items-center">
                    <div class="icon-circle-header me-3">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <div>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-1">
                                <li class="breadcrumb-item"><a href="{{ route('general.identity.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Management</li>
                            </ol>
                        </nav>
                        <h3 class="fw-800 text-yota-dark mb-0">
                            {{ str_replace('_', ' ', strtoupper($type)) }}
                        </h3>
                    </div>
                </div>

                <div class="action-zone">
                    <a href="{{ route('general.identity.index') }}" class="btn btn-back-custom">
                        <i class="fas fa-chevron-left me-2"></i> Kembali ke Menu Utama
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-yota-modern d-flex align-items-center mb-4 border-0 shadow-sm" role="alert">
                    <div class="alert-icon-box">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="ms-3">
                        <div class="fw-bold text-success">Berhasil Diperbarui</div>
                        <div class="small text-muted">{{ session('success') }}</div>
                    </div>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="main-content-card animate-slide-up">
                @switch($type)
                    @case('skills')
                        @include('general.cv.partials._skills_manager')
                        @break

                    @case('experience')
                        @include('general.cv.partials._experience_manager')
                        @break

                    @case('portfolios')
                        @include('general.cv.partials._portfolio_manager')
                        @break

                    @case('achievements')
                        @include('general.cv.partials._achievement_manager')
                        @break

                    @case('organizations')
                        @include('general.cv.partials._organization_manager')
                        @break

                    @case('education')
                        @include('general.cv.partials._education_manager')
                        <div class="mt-4">
                            @include('general.cv.partials._non_formal_manager')
                        </div>
                        @break

                    @case('socials')
                         @include('general.cv.partials._social_manager')
                         @break

                    @default
                        <div class="error-card text-center py-5">
                            <img src="https://illustrations.popsy.co/amber/error-404.svg" style="width: 200px;" class="mb-4">
                            <h4 class="fw-bold">Oops! Tipe Tidak Dikenali</h4>
                            <p class="text-muted">Kategori <strong>{{ $type }}</strong> belum terdaftar dalam sistem.</p>
                            <a href="{{ route('general.identity.index') }}" class="btn btn-dark rounded-pill">Pulang ke Dashboard</a>
                        </div>
                @endswitch
            </div>

        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

    .yota-list-wrapper {
        font-family: 'Plus Jakarta Sans', sans-serif;
        min-height: 100vh;
        background: #f8fafc;
    }

    /* Header Styling */
    .icon-circle-header {
        width: 56px;
        height: 56px;
        background: #052c24;
        color: #BEF264;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        box-shadow: 0 10px 20px rgba(5, 44, 36, 0.15);
    }

    .text-yota-dark { color: #052c24; }
    .fw-800 { font-weight: 800; }

    .breadcrumb-item, .breadcrumb-item a {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        text-decoration: none;
        font-weight: 600;
    }

    .breadcrumb-item.active { color: #64748b; }

    /* Button Back */
    .btn-back-custom {
        background: white;
        color: #052c24;
        border: 2px solid #e2e8f0;
        border-radius: 14px;
        padding: 10px 20px;
        font-weight: 700;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .btn-back-custom:hover {
        background: #052c24;
        color: #BEF264;
        border-color: #052c24;
        transform: translateY(-2px);
    }

    /* Modern Alert */
    .alert-yota-modern {
        background: white;
        border-radius: 20px;
        padding: 1rem 1.5rem;
    }

    .alert-icon-box {
        width: 38px;
        height: 38px;
        background: #ecfdf5;
        color: #10b981;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    /* Main Content Wrapper */
    .main-content-card {
        background: transparent;
    }

    /* Animations */
    .animate-slide-up {
        animation: slideUp 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Override Partials Styles agar Match */
    .card {
        border-radius: 24px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.04) !important;
        border: 1px solid rgba(226, 232, 240, 0.5) !important;
    }

    .error-card {
        background: white;
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(0,0,0,0.05);
    }
</style>
@endsection

<div class="yota-nonformal-isolated">
    <div class="nf-main-card">
        <div class="nf-card-header">
            <div class="nf-header-text">
                <h5 class="nf-title nf-dark-text">Pelatihan & Kursus</h5>
                <p class="nf-subtitle">Sertifikasi non-formal, kursus bahasa, dan bootcamp teknis.</p>
            </div>
            <button class="nf-btn-outline" data-bs-toggle="modal" data-bs-target="#addNonFormalModal">
                <i class="fas fa-plus me-1"></i> TAMBAH
            </button>
        </div>

        <div class="nf-card-body">
            <div class="nf-grid">
                @forelse(Auth::user()->nonFormalEducations as $non)
                <div class="nf-item-box">
                    <div class="nf-item-content">
                        <div class="nf-icon-wrapper">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <div class="nf-info">
                            <h6 class="nf-course-name">{{ $non->course_name }}</h6>
                            <div class="nf-meta">
                                <span class="nf-provider"><i class="fas fa-chalkboard-teacher me-1"></i> {{ $non->provider }}</span>
                                <span class="nf-divider">•</span>
                                <span class="nf-year"><i class="far fa-calendar-check me-1"></i> {{ $non->completion_year }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="nf-actions">
                        <form action="{{ route('general.cv.destroy', ['non_formal_educations', $non->id]) }}" method="POST" onsubmit="return confirm('Hapus data pelatihan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="nf-btn-delete" title="Hapus">
                                <i class="fas fa-times-circle"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="nf-empty">
                    <p class="small text-muted italic">Belum ada data pelatihan non-formal.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNonFormalModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content nf-modal-custom">
            <form action="{{ route('general.cv.store', 'non_formal_educations') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="nf-title nf-dark-text mb-0">Tambah Pelatihan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="nf-form-group mb-3">
                        <label class="nf-label">Nama Kursus / Pelatihan</label>
                        <input type="text" name="course_name" class="nf-input" placeholder="Contoh: Kursus Bahasa Jerman A1" required>
                    </div>
                    <div class="nf-form-group mb-3">
                        <label class="nf-label">Penyelenggara (Provider)</label>
                        <input type="text" name="provider" class="nf-input" placeholder="Contoh: Deutsche Sprache / Udemy" required>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="nf-label">Durasi (Opsional)</label>
                            <input type="text" name="duration" class="nf-input" placeholder="Contoh: 3 Bulan">
                        </div>
                        <div class="col-6">
                            <label class="nf-label">Tahun Selesai</label>
                            <input type="number" name="completion_year" class="nf-input" value="{{ date('Y') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="nf-btn-submit w-100">SIMPAN PELATIHAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS ISOLATION FOR NON-FORMAL EDUCATION */
    .yota-nonformal-isolated {
        --nf-primary: #052c24;
        --nf-lemon: #BEF264;
        --nf-bg-item: #f8fafc;
        --nf-border: #e2e8f0;
        --nf-text-main: #1e293b;
        --nf-text-muted: #64748b;

        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .yota-nonformal-isolated .nf-main-card {
        background: #ffffff;
        border-radius: 24px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        overflow: hidden;
    }

    .yota-nonformal-isolated .nf-card-header {
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
    }

    .yota-nonformal-isolated .nf-dark-text { color: var(--nf-primary); }
    .yota-nonformal-isolated .nf-title { font-weight: 800; margin: 0; font-size: 1.1rem; }
    .yota-nonformal-isolated .nf-subtitle { color: var(--nf-text-muted); font-size: 0.8rem; margin-top: 4px; }

    .yota-nonformal-isolated .nf-btn-outline {
        background: transparent;
        color: var(--nf-primary);
        border: 2px solid var(--nf-primary);
        padding: 6px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.75rem;
        transition: 0.3s;
    }

    .yota-nonformal-isolated .nf-btn-outline:hover {
        background: var(--nf-primary);
        color: var(--nf-lemon);
    }

    /* Items Styling */
    .yota-nonformal-isolated .nf-card-body { padding: 1.5rem 2rem; }

    .yota-nonformal-isolated .nf-item-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--nf-bg-item);
        padding: 1rem 1.25rem;
        border-radius: 16px;
        margin-bottom: 12px;
        border: 1px solid transparent;
        transition: 0.3s;
    }

    .yota-nonformal-isolated .nf-item-box:hover {
        background: #ffffff;
        border-color: var(--nf-primary);
        box-shadow: 0 8px 15px rgba(5, 44, 36, 0.05);
        transform: scale(1.01);
    }

    .yota-nonformal-isolated .nf-item-content {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .yota-nonformal-isolated .nf-icon-wrapper {
        width: 40px;
        height: 40px;
        background: rgba(5, 44, 36, 0.05);
        color: var(--nf-primary);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .yota-nonformal-isolated .nf-course-name {
        font-weight: 700;
        color: var(--nf-text-main);
        margin: 0;
        font-size: 0.95rem;
    }

    .yota-nonformal-isolated .nf-meta {
        font-size: 0.75rem;
        color: var(--nf-text-muted);
        margin-top: 2px;
    }

    .yota-nonformal-isolated .nf-divider { margin: 0 5px; color: #cbd5e1; }

    .yota-nonformal-isolated .nf-btn-delete {
        background: transparent;
        border: none;
        color: #94a3b8;
        font-size: 18px;
        transition: 0.2s;
    }

    .yota-nonformal-isolated .nf-btn-delete:hover { color: #ef4444; }

    /* Modal Styling */
    .nf-modal-custom { border-radius: 24px !important; border: none !important; }
    .nf-label { font-size: 12px; font-weight: 700; color: var(--nf-primary); margin-bottom: 6px; display: block; }
    .nf-input {
        width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #e2e8f0;
        border-radius: 12px; font-size: 14px; color: var(--nf-primary); transition: 0.3s;
    }
    .nf-input:focus { border-color: var(--nf-primary); outline: none; box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05); }
    .nf-btn-submit {
        background: var(--nf-primary); color: var(--nf-lemon); border: none; padding: 12px;
        border-radius: 12px; font-weight: 800; transition: 0.3s;
    }
</style>

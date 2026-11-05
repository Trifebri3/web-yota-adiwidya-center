<div class="yota-experience-isolated" x-data="{ isCurrentExp: false }">
    <div class="exp-main-card">
        <div class="exp-card-header">
            <div class="exp-header-text">
                <h5 class="exp-title exp-dark-text">Pengalaman Profesional</h5>
                <p class="exp-subtitle">Rekam jejak karier dan kepemimpinan di PT & Yayasan.</p>
            </div>
            <button class="exp-btn-add" data-bs-toggle="modal" data-bs-target="#addExpModal">
                <i class="fas fa-plus-circle me-1"></i> TAMBAH PENGALAMAN
            </button>
        </div>

        <div class="exp-card-body">
            <div class="exp-list">
                @forelse(Auth::user()->experiences as $exp)
                <div class="exp-item-wrapper">
                    <div class="exp-content-box">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="exp-info">
                                <div class="exp-badge-active-wrapper">
                                    <h6 class="exp-pos-title">{{ $exp->position }}</h6>
                                    @if($exp->is_active)
                                        <span class="exp-status-pill">ACTIVE</span>
                                    @endif
                                </div>
                                <div class="exp-company-tag">
                                    <i class="fas fa-building me-1"></i> {{ $exp->company_name }}
                                    <span class="exp-dot-separator">•</span>
                                    <i class="fas fa-clock me-1"></i> {{ $exp->duration_label }}
                                </div>
                                <div class="exp-desc-area">
                                    {!! nl2br(e($exp->job_desc)) !!}
                                </div>
                            </div>
                            <div class="exp-action-area">
                                <form action="{{ route('general.cv.destroy', ['experience', $exp->id]) }}" method="POST" onsubmit="return confirm('Hapus pengalaman ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="exp-btn-delete shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="exp-empty-state">
                    <div class="exp-empty-icon"><i class="fas fa-briefcase"></i></div>
                    <p>Belum ada pengalaman kerja yang tercatat.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addExpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content exp-modal-custom">
            <form action="{{ route('general.cv.store', 'experience') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="exp-title exp-dark-text mb-0">Tambah Pengalaman Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="exp-label">Posisi / Jabatan</label>
                            <input type="text" name="position" class="exp-input" placeholder="Contoh: Director" required>
                        </div>
                        <div class="col-md-6">
                            <label class="exp-label">Perusahaan / Instansi</label>
                            <input type="text" name="company_name" class="exp-input" placeholder="Contoh: PT Yota Inovasi Nusantara" required>
                        </div>
                        <div class="col-md-5">
                            <label class="exp-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="exp-input" required>
                        </div>
                        <div class="col-md-5" x-show="!isCurrentExp">
                            <label class="exp-label">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="exp-input">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <div class="exp-checkbox-group mb-2">
                                <input type="checkbox" name="is_active" id="is_active_exp" value="1" x-model="isCurrentExp">
                                <label for="is_active_exp" class="exp-label-check">Aktif</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="exp-label">Deskripsi & Pencapaian</label>
                            <textarea name="job_desc" class="exp-input exp-textarea" rows="4" placeholder="Jelaskan kontribusi nyata kamu..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="exp-btn-submit w-100">SIMPAN PENGALAMAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS ISOLATION ARCHITECTURE FOR EXPERIENCE SECTION */
    .yota-experience-isolated {
        --exp-primary: #052c24;
        --exp-lemon: #BEF264;
        --exp-border: #f1f5f9;
        --exp-muted: #64748b;
        --exp-white: #ffffff;
        --exp-bg-soft: #f8fafc;

        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .yota-experience-isolated .exp-main-card {
        background: var(--exp-white);
        border-radius: 28px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        border: none !important;
        overflow: hidden;
    }

    .yota-experience-isolated .exp-card-header {
        padding: 1.5rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--exp-border);
        background: var(--exp-white);
    }

    .yota-experience-isolated .exp-dark-text { color: var(--exp-primary); }
    .yota-experience-isolated .exp-title { font-weight: 800; margin: 0; font-size: 1.2rem; }
    .yota-experience-isolated .exp-subtitle { color: var(--exp-muted); font-size: 0.85rem; margin-top: 4px; }

    .yota-experience-isolated .exp-btn-add {
        background: var(--exp-lemon);
        color: var(--exp-primary);
        border: none;
        padding: 10px 20px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.75rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(190, 242, 100, 0.2);
    }

    .yota-experience-isolated .exp-btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(190, 242, 100, 0.3);
    }

    /* List Layout */
    .yota-experience-isolated .exp-card-body { padding: 2rem 2.5rem; }
    .yota-experience-isolated .exp-item-wrapper { margin-bottom: 1.5rem; position: relative; }

    .yota-experience-isolated .exp-content-box {
        background: var(--exp-bg-soft);
        padding: 1.5rem;
        border-radius: 20px;
        border: 1px solid var(--exp-border);
        transition: 0.3s;
    }

    .yota-experience-isolated .exp-content-box:hover {
        background: #fff;
        border-color: var(--exp-primary);
        box-shadow: 0 10px 25px rgba(5, 44, 36, 0.05);
    }

    .yota-experience-isolated .exp-badge-active-wrapper { display: flex; align-items: center; gap: 10px; margin-bottom: 5px; }
    .yota-experience-isolated .exp-pos-title { font-weight: 700; color: var(--exp-primary); margin: 0; font-size: 1.1rem; }

    .yota-experience-isolated .exp-status-pill {
        background: var(--exp-primary);
        color: var(--exp-lemon);
        font-size: 9px;
        font-weight: 800;
        padding: 3px 8px;
        border-radius: 6px;
        letter-spacing: 1px;
    }

    .yota-experience-isolated .exp-company-tag {
        font-size: 0.8rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 12px;
    }

    .yota-experience-isolated .exp-dot-separator { margin: 0 8px; color: #cbd5e1; }

    .yota-experience-isolated .exp-desc-area {
        font-size: 0.85rem;
        color: #64748b;
        line-height: 1.7;
        padding-top: 12px;
        border-top: 1px dashed #e2e8f0;
    }

    .yota-experience-isolated .exp-btn-delete {
        background: #fff;
        color: #ef4444;
        border: none;
        width: 36px;
        height: 36px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .yota-experience-isolated .exp-btn-delete:hover { background: #fee2e2; }

    /* Modal Isolated */
    .exp-modal-custom { border-radius: 28px !important; border: none !important; }
    .exp-label { font-size: 12px; font-weight: 700; color: var(--exp-primary); margin-bottom: 6px; display: block; }
    .exp-input {
        width: 100%; padding: 12px 16px; background: #f1f5f9; border: 1.5px solid #e2e8f0;
        border-radius: 14px; font-size: 14px; color: var(--exp-primary); transition: 0.3s;
    }
    .exp-input:focus { border-color: var(--exp-primary); background: #fff; outline: none; box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05); }
    .exp-checkbox-group { display: flex; align-items: center; gap: 8px; }
    .exp-label-check { font-size: 12px; font-weight: 700; color: var(--exp-primary); cursor: pointer; }
    .exp-btn-submit {
        background: var(--exp-primary); color: var(--exp-lemon); border: none; padding: 14px;
        border-radius: 16px; font-weight: 800; transition: 0.3s; margin-top: 10px;
    }

    .yota-experience-isolated .exp-empty-state {
        text-align: center;
        padding: 3rem 0;
    }
    .yota-experience-isolated .exp-empty-icon { font-size: 3rem; color: #e2e8f0; margin-bottom: 1rem; }
</style>

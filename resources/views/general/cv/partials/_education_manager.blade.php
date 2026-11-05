<div class="yota-edu-isolated" x-data="{ isCurrentEdu: false }">
    <div class="edu-main-card">
        <div class="edu-card-header">
            <div class="edu-title-group">
                <h5 class="edu-heading edu-dark-text">Pendidikan Formal</h5>
                <p class="edu-subheading">Kelola riwayat pendidikan tinggi dan menengah kamu.</p>
            </div>
            <button class="edu-btn-primary" data-bs-toggle="modal" data-bs-target="#addEduModal">
                <i class="fas fa-plus-circle me-1"></i> TAMBAH
            </button>
        </div>

        <div class="edu-card-body">
            <div class="edu-timeline">
                @forelse(Auth::user()->educations as $edu)
                <div class="edu-item">
                    <div class="edu-indicator">
                        <div class="edu-dot"></div>
                        <div class="edu-line"></div>
                    </div>
                    <div class="edu-content-card">
                        <div class="d-flex justify-content-between">
                            <div class="edu-info">
                                <h6 class="edu-inst-name">{{ $edu->institution }}</h6>
                                <p class="edu-major-text text-uppercase">{{ $edu->degree }} • {{ $edu->field_of_study }}</p>
                                <div class="edu-period-badge">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $edu->year_range }}
                                </div>
                                @if($edu->achievements_summary)
                                <div class="edu-summary-box">
                                    {!! nl2br(e($edu->achievements_summary)) !!}
                                </div>
                                @endif
                            </div>
                            <div class="edu-actions">
                                <form action="{{ route('general.cv.destroy', ['educations', $edu->id]) }}" method="POST" onsubmit="return confirm('Hapus riwayat pendidikan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="edu-btn-delete shadow-sm">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="edu-empty-state">
                    <i class="fas fa-graduation-cap fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                    <p>Belum ada riwayat pendidikan formal.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addEduModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content edu-modal-custom">
            <form action="{{ route('general.cv.store', 'educations') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="edu-heading edu-dark-text mb-0">Tambah Pendidikan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="edu-form-group mb-3">
                        <label class="edu-label">Nama Institusi</label>
                        <input type="text" name="institution" class="edu-input" placeholder="Contoh: Universitas Telkom" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="edu-label">Gelar / Jenjang</label>
                            <input type="text" name="degree" class="edu-input" placeholder="S1 / SMK">
                        </div>
                        <div class="col-6">
                            <label class="edu-label">Jurusan</label>
                            <input type="text" name="field_of_study" class="edu-input" placeholder="Teknik Informatika">
                        </div>
                    </div>
                    <div class="row g-2 mb-3" x-data="{ isCurrentEdu: false }">
                        <div class="col-6">
                            <label class="edu-label">Tgl Mulai</label>
                            <input type="date" name="start_date" class="edu-input" required>
                        </div>
                        <div class="col-6" x-show="!isCurrentEdu">
                            <label class="edu-label">Tgl Selesai</label>
                            <input type="date" name="end_date" class="edu-input">
                        </div>
                        <div class="col-12 mt-2">
                            <div class="edu-checkbox-wrapper">
                                <input type="checkbox" name="is_current" id="is_current_edu_modal" value="1" x-model="isCurrentEdu">
                                <label for="is_current_edu_modal">Masih Menempuh Studi</label>
                            </div>
                        </div>
                    </div>
                    <div class="edu-form-group mb-0">
                        <label class="edu-label">Pencapaian (Opsional)</label>
                        <textarea name="achievements_summary" class="edu-input edu-textarea" rows="3" placeholder="Contoh: IPK 3.8, Penerima Beasiswa KIPK, dsb."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="edu-btn-submit w-100">SIMPAN DATA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* ISOLATED CSS FOR EDUCATION SECTION */
    .yota-edu-isolated {
        --edu-primary: #052c24;
        --edu-lemon: #BEF264;
        --edu-border: #f1f5f9;
        --edu-muted: #94a3b8;
        --edu-bg: #f8fafc;

        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .yota-edu-isolated .edu-main-card {
        background: #fff;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: none !important;
        overflow: hidden;
    }

    .yota-edu-isolated .edu-card-header {
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--edu-border);
    }

    .yota-edu-isolated .edu-dark-text { color: var(--edu-primary); }
    .yota-edu-isolated .edu-heading { font-weight: 800; margin: 0; font-size: 1.25rem; }
    .yota-edu-isolated .edu-subheading { color: var(--edu-muted); font-size: 0.85rem; margin-top: 4px; }

    .yota-edu-isolated .edu-btn-primary {
        background: var(--edu-primary);
        color: var(--edu-lemon);
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    /* Timeline Styling */
    .yota-edu-isolated .edu-card-body { padding: 2rem; }
    .yota-edu-isolated .edu-timeline { position: relative; }

    .yota-edu-isolated .edu-item {
        display: flex;
        gap: 20px;
        margin-bottom: 25px;
    }

    .yota-edu-isolated .edu-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .yota-edu-isolated .edu-dot {
        width: 14px;
        height: 14px;
        background: var(--edu-primary);
        border: 3px solid var(--edu-lemon);
        border-radius: 50%;
        z-index: 2;
    }

    .yota-edu-isolated .edu-line {
        width: 2px;
        flex-grow: 1;
        background: var(--edu-border);
        margin: 4px 0;
    }

    .yota-edu-isolated .edu-item:last-child .edu-line { display: none; }

    .yota-edu-isolated .edu-content-card {
        flex-grow: 1;
        background: var(--edu-bg);
        padding: 1.25rem;
        border-radius: 18px;
        border: 1px solid var(--edu-border);
        transition: 0.3s;
    }

    .yota-edu-isolated .edu-content-card:hover {
        transform: translateX(5px);
        border-color: var(--edu-primary);
    }

    .yota-edu-isolated .edu-inst-name { font-weight: 700; color: var(--edu-primary); font-size: 1rem; margin-bottom: 4px; }
    .yota-edu-isolated .edu-major-text { font-size: 0.75rem; font-weight: 800; color: #64748b; letter-spacing: 0.5px; }

    .yota-edu-isolated .edu-period-badge {
        display: inline-block;
        font-size: 11px;
        color: var(--edu-primary);
        background: rgba(190, 242, 100, 0.3);
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 700;
        margin: 8px 0;
    }

    .yota-edu-isolated .edu-summary-box {
        font-size: 11px;
        color: #475569;
        line-height: 1.6;
        padding-top: 8px;
        border-top: 1px dashed #e2e8f0;
    }

    .yota-edu-isolated .edu-btn-delete {
        background: #fff;
        color: #ef4444;
        border: none;
        width: 35px;
        height: 35px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .yota-edu-isolated .edu-btn-delete:hover { background: #ef4444; color: #fff; }

    /* MODAL ISOLATED STYLES */
    .edu-modal-custom { border-radius: 24px !important; border: none !important; }
    .edu-label { font-size: 12px; font-weight: 700; color: var(--edu-primary); margin-bottom: 6px; display: block; }
    .edu-input {
        width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #eef2f6;
        border-radius: 12px; font-size: 14px; color: var(--edu-primary); transition: 0.3s;
    }
    .edu-input:focus { border-color: var(--edu-primary); box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05); outline: none; }
    .edu-checkbox-wrapper { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 600; color: #475569; }
    .edu-btn-submit {
        background: var(--edu-primary); color: var(--edu-lemon); border: none; padding: 12px;
        border-radius: 12px; font-weight: 800; transition: 0.3s;
    }
</style>

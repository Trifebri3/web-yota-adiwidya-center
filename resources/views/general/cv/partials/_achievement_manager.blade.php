<div class="yota-achievement-isolated">
    <div class="ach-main-card">
        <div class="ach-card-header">
            <div class="ach-title-area">
                <h5 class="ach-text-bold ach-dark-text">Prestasi & Penghargaan</h5>
                <p class="ach-muted-text ach-small">Rekam jejak apresiasi dan dedikasi kamu secara profesional.</p>
            </div>
            <button class="ach-btn-add" data-bs-toggle="modal" data-bs-target="#addAchModal">
                <i class="fas fa-plus ach-icon-spacing"></i> TAMBAH
            </button>
        </div>

        <div class="ach-card-body">
            <div class="ach-grid">
                @forelse(Auth::user()->achievements as $ach)
                <div class="ach-item-col">
                    <div class="ach-item-box shadow-hover-yota">
                        <div class="ach-flex-container">
                            <div class="ach-content-wrap">
                                <div class="ach-level-badge" style="--ach-color: {{ $ach->level_details['color'] }}">
                                    <i class="fas fa-award ach-icon-spacing"></i>
                                    {{ strtoupper($ach->level_details['label']) }}
                                </div>

                                <h6 class="ach-award-title ach-text-extrabold">{{ $ach->award_name }}</h6>

                                <div class="ach-meta-info">
                                    <span class="ach-meta-item">
                                        <i class="fas fa-university ach-icon-spacing"></i> {{ $ach->institution }}
                                    </span>
                                    <span class="ach-meta-divider">•</span>
                                    <span class="ach-meta-item">
                                        <i class="fas fa-calendar-alt ach-icon-spacing"></i> {{ $ach->attained_year }}
                                    </span>
                                </div>

                                <p class="ach-summary-desc">{{ $ach->summary }}</p>
                            </div>

                            <div class="ach-action-wrap">
                                <form action="{{ route('general.cv.destroy', ['achievements', $ach->id]) }}" method="POST" onsubmit="return confirm('Hapus prestasi ini?')">
                                    @csrf @method('DELETE')
                                    <button class="ach-btn-delete-circle" type="submit">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="ach-empty-container">
                    <div class="ach-empty-state">
                        <i class="fas fa-medal ach-empty-icon"></i>
                        <p class="ach-empty-text">Belum ada prestasi yang dicatat. Mulai bangun portofoliomu!</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addAchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content yota-modal-custom">
            <div class="modal-header border-0 pb-0 pt-4 px-4">
                <h5 class="fw-800 ach-dark-text mb-0">Tambah Pencapaian Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('general.cv.store', 'achievements') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="ach-form-group mb-3">
                        <label class="ach-label">Nama Penghargaan / Juara</label>
                        <input type="text" name="award_name" class="ach-input" placeholder="Contoh: Pemuda Pelopor Teknologi" required>
                    </div>

                    <div class="ach-form-group mb-3">
                        <label class="ach-label">Institusi Pemberi</label>
                        <input type="text" name="institution" class="ach-input" placeholder="Contoh: Dispora Jawa Barat" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="ach-label">Tahun Diraih</label>
                            <input type="number" name="attained_year" class="ach-input" value="{{ date('Y') }}" required>
                        </div>
                        <div class="col-6">
                            <label class="ach-label">Tingkat / Level</label>
                            <select name="level" class="ach-input ach-select" required>
                                <option value="regency">Kabupaten</option>
                                <option value="province">Provinsi</option>
                                <option value="national">Nasional</option>
                                <option value="international">Internasional</option>
                            </select>
                        </div>
                    </div>

                    <div class="ach-form-group mb-2">
                        <label class="ach-label">Ringkasan Singkat</label>
                        <textarea name="summary" class="ach-input ach-textarea" rows="3" placeholder="Jelaskan sedikit tentang pencapaian ini..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0 pb-4 px-4">
                    <button type="button" class="ach-btn-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="ach-btn-submit">Simpan Prestasi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    /* YOTA ACHIEVEMENT ISOLATED STYLES
       Mencegah Tabrakan dengan CSS Global / Bootstrap Global
    */
    .yota-achievement-isolated {
        --yota-primary: #052c24;
        --yota-accent: #BEF264;
        --yota-border: #f1f5f9;
        --yota-muted: #64748b;
        --yota-white: #ffffff;

        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
        margin-top: 2rem;
    }

    /* Card Shell */
    .yota-achievement-isolated .ach-main-card {
        background: var(--yota-white);
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
        border: none !important;
        overflow: hidden;
    }

    /* Header Styling */
    .yota-achievement-isolated .ach-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 2rem;
        background: var(--yota-white);
        border-bottom: 1px solid var(--yota-border);
    }

    .yota-achievement-isolated .ach-dark-text { color: var(--yota-primary); }
    .yota-achievement-isolated .ach-text-bold { font-weight: 700; margin: 0; }
    .yota-achievement-isolated .ach-text-extrabold { font-weight: 800; }
    .yota-achievement-isolated .ach-small { font-size: 0.875rem; }
    .yota-achievement-isolated .ach-muted-text { color: var(--yota-muted); margin-top: 0.25rem; }

    /* Button Styling */
    .yota-achievement-isolated .ach-btn-add {
        background: var(--yota-primary);
        color: var(--yota-accent);
        border: none;
        padding: 0.6rem 1.25rem;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .yota-achievement-isolated .ach-btn-add:hover {
        background: #0a4d3f;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(5, 44, 36, 0.2);
    }

    /* Grid Layout */
    .yota-achievement-isolated .ach-card-body { padding: 1.5rem 2rem; }
    .yota-achievement-isolated .ach-grid {
        display: flex;
        flex-wrap: wrap;
        margin: -0.75rem;
    }
    .yota-achievement-isolated .ach-item-col {
        flex: 0 0 50%;
        max-width: 50%;
        padding: 0.75rem;
    }

    @media (max-width: 768px) {
        .yota-achievement-isolated .ach-item-col { flex: 0 0 100%; max-width: 100%; }
    }

    /* Achievement Box Item */
    .yota-achievement-isolated .ach-item-box {
        background: var(--yota-white);
        border: 1.5px solid var(--yota-border);
        border-radius: 20px;
        padding: 1.25rem;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .yota-achievement-isolated .ach-item-box:hover {
        border-color: var(--yota-primary);
        box-shadow: 0 12px 24px rgba(5, 44, 36, 0.06);
        transform: translateY(-4px);
    }

    .yota-achievement-isolated .ach-flex-container {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
    }

    /* Content Elements */
    .yota-achievement-isolated .ach-level-badge {
        display: inline-flex;
        align-items: center;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 800;
        background: color-mix(in srgb, var(--ach-color), transparent 85%);
        color: var(--ach-color);
        margin-bottom: 0.75rem;
    }

    .yota-achievement-isolated .ach-award-title {
        color: var(--yota-primary);
        font-size: 1.05rem;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .yota-achievement-isolated .ach-meta-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.75rem;
        color: var(--yota-muted);
        font-size: 11px;
        font-weight: 600;
    }

    .yota-achievement-isolated .ach-summary-desc {
        font-size: 12px;
        color: #475569;
        line-height: 1.6;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Delete Button */
    .yota-achievement-isolated .ach-btn-delete-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: none;
        background: #fff1f2;
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    .yota-achievement-isolated .ach-btn-delete-circle:hover {
        background: #ef4444;
        color: #ffffff;
    }

    /* Empty State */
    .yota-achievement-isolated .ach-empty-container { width: 100%; padding: 2rem; }
    .yota-achievement-isolated .ach-empty-state { text-align: center; }
    .yota-achievement-isolated .ach-empty-icon {
        font-size: 3rem;
        color: #e2e8f0;
        margin-bottom: 1rem;
    }
    .yota-achievement-isolated .ach-empty-text {
        color: var(--yota-muted);
        font-size: 0.875rem;
    }

    .yota-achievement-isolated .ach-icon-spacing { margin-right: 6px; }

    /* CSS TAMBAHAN UNTUK MODAL AGAR TETAP ISOLATED */
    .yota-modal-custom {
        border-radius: 28px !important;
        border: none !important;
        box-shadow: 0 25px 50px -12px rgba(5, 44, 36, 0.25) !important;
    }

    .yota-modal-custom .ach-label {
        font-size: 12px;
        font-weight: 700;
        color: var(--yota-primary);
        margin-bottom: 6px;
        display: block;
    }

    .yota-modal-custom .ach-input {
        width: 100%;
        padding: 12px 16px;
        background: #f8fafc;
        border: 2px solid #f1f5f9;
        border-radius: 14px;
        font-size: 14px;
        color: var(--yota-primary);
        transition: all 0.2s;
    }

    .yota-modal-custom .ach-input:focus {
        background: #fff;
        border-color: var(--yota-primary);
        box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05);
        outline: none;
    }

    .yota-modal-custom .ach-btn-cancel {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 13px;
    }

    .yota-modal-custom .ach-btn-submit {
        background: var(--yota-primary);
        color: var(--yota-accent);
        border: none;
        padding: 10px 25px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 13px;
        box-shadow: 0 4px 12px rgba(5, 44, 36, 0.15);
    }

    .yota-modal-custom .ach-btn-submit:hover {
        transform: translateY(-2px);
        background: #0a4d3f;
    }
</style>

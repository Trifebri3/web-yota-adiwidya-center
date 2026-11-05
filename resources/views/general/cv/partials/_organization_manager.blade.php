<div class="yota-org-isolated">
    <div class="org-main-card">
        <div class="org-card-header">
            <div class="org-header-info">
                <h5 class="org-title org-dark-text">Organisasi & Komunitas (NGO)</h5>
                <p class="org-subtitle">Rekam jejak kepemimpinan dan kontribusi sosial di masyarakat.</p>
            </div>
            <button class="org-btn-add" data-bs-toggle="modal" data-bs-target="#addOrgModal">
                <i class="fas fa-plus-circle me-1"></i> TAMBAH
            </button>
        </div>

        <div class="org-card-body">
            <div class="org-list">
                @forelse(Auth::user()->organizations as $org)
                <div class="org-item-row">
                    <div class="org-logo-wrapper">
                        <img src="{{ $org->logo_url }}" class="org-img" alt="Logo">
                    </div>
                    <div class="org-details">
                        <h6 class="org-name">{{ $org->organization_name }}</h6>
                        <div class="org-status-badge">
                            <i class="fas fa-id-badge me-1"></i> {{ $org->full_status }}
                        </div>
                        @if($org->contribution_desc)
                        <p class="org-desc">{{ $org->contribution_desc }}</p>
                        @endif
                    </div>
                    <div class="org-actions">
                        <form action="{{ route('general.cv.destroy', ['organizations', $org->id]) }}" method="POST" onsubmit="return confirm('Hapus riwayat organisasi ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="org-btn-delete" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="org-empty">
                    <i class="fas fa-users-cog fa-3x mb-3"></i>
                    <p>Belum ada riwayat organisasi atau komunitas.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addOrgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content org-modal-custom">
            <form action="{{ route('general.cv.store', 'organizations') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="org-title org-dark-text mb-0">Tambah Riwayat Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="org-form-group mb-3">
                        <label class="org-label">Nama Organisasi / Yayasan</label>
                        <input type="text" name="organization_name" class="org-input" placeholder="Contoh: Yayasan Yota Wujudkan Asa" required>
                    </div>
                    <div class="org-form-group mb-3">
                        <label class="org-label">Jabatan / Peran</label>
                        <input type="text" name="position" class="org-input" placeholder="Contoh: Founder & Executive Director" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="org-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="org-input" required>
                        </div>
                        <div class="col-6">
                            <label class="org-label">Tanggal Selesai (Opsional)</label>
                            <input type="date" name="end_date" class="org-input">
                        </div>
                    </div>
                    <div class="org-form-group mb-0">
                        <label class="org-label">Deskripsi Kontribusi</label>
                        <textarea name="contribution_desc" class="org-input org-textarea" rows="3" placeholder="Apa dampak yang kamu berikan di organisasi ini?"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="org-btn-submit w-100">SIMPAN DATA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS ISOLATION FOR ORGANIZATION SECTION */
    .yota-org-isolated {
        --org-primary: #052c24;
        --org-lemon: #BEF264;
        --org-border: #f1f5f9;
        --org-muted: #64748b;
        --org-bg-soft: #f8fafc;

        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .yota-org-isolated .org-main-card {
        background: #ffffff;
        border-radius: 28px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        border: none !important;
        overflow: hidden;
    }

    .yota-org-isolated .org-card-header {
        padding: 1.5rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--org-border);
    }

    .yota-org-isolated .org-dark-text { color: var(--org-primary); }
    .yota-org-isolated .org-title { font-weight: 800; margin: 0; font-size: 1.15rem; }
    .yota-org-isolated .org-subtitle { color: var(--org-muted); font-size: 0.85rem; margin-top: 4px; }

    .yota-org-isolated .org-btn-add {
        background: var(--org-primary);
        color: var(--org-lemon);
        border: none;
        padding: 10px 20px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.75rem;
        transition: 0.3s;
    }

    .yota-org-isolated .org-btn-add:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(5, 44, 36, 0.2); }

    /* Items List */
    .yota-org-isolated .org-card-body { padding: 1.5rem 2.5rem; }

    .yota-org-isolated .org-item-row {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        padding: 1.5rem;
        background: var(--org-bg-soft);
        border-radius: 20px;
        margin-bottom: 15px;
        border: 1px solid transparent;
        transition: 0.3s;
    }

    .yota-org-isolated .org-item-row:hover {
        background: #ffffff;
        border-color: var(--org-primary);
        box-shadow: 0 10px 25px rgba(5, 44, 36, 0.05);
    }

    .yota-org-isolated .org-logo-wrapper {
        width: 60px;
        height: 60px;
        flex-shrink: 0;
        background: #fff;
        padding: 5px;
        border-radius: 14px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .yota-org-isolated .org-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 10px;
    }

    .yota-org-isolated .org-details { flex-grow: 1; }

    .yota-org-isolated .org-name { font-weight: 800; color: var(--org-primary); margin-bottom: 4px; font-size: 1rem; }

    .yota-org-isolated .org-status-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(5, 44, 36, 0.05);
        color: var(--org-primary);
        font-size: 11px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .yota-org-isolated .org-desc {
        font-size: 12px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 0;
    }

    .yota-org-isolated .org-btn-delete {
        background: #fff;
        color: #94a3b8;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        transition: 0.2s;
    }

    .yota-org-isolated .org-btn-delete:hover { color: #ef4444; background: #fee2e2; }

    /* Modal Isolated Styles */
    .org-modal-custom { border-radius: 28px !important; border: none !important; }
    .org-label { font-size: 12px; font-weight: 700; color: var(--org-primary); margin-bottom: 6px; display: block; }
    .org-input {
        width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #eef2f6;
        border-radius: 14px; font-size: 14px; color: var(--org-primary); transition: 0.3s;
    }
    .org-input:focus { border-color: var(--org-primary); outline: none; box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05); }
    .org-btn-submit {
        background: var(--org-primary); color: var(--org-lemon); border: none; padding: 14px;
        border-radius: 16px; font-weight: 800; transition: 0.3s;
    }

    .yota-org-isolated .org-empty { text-align: center; padding: 3rem 0; color: #cbd5e1; }
</style>

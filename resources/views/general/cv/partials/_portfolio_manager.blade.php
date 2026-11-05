<div class="yota-portfolio-isolated">
    <div class="port-main-card">
        <div class="port-card-header">
            <div class="port-header-info">
                <h5 class="port-title port-dark-text">Portofolio & Karya Unggulan</h5>
                <p class="port-subtitle">Etalase inovasi teknologi, sistem digital, dan proyek sosial.</p>
            </div>
            <button class="port-btn-add" data-bs-toggle="modal" data-bs-target="#addPortfolio">
                <i class="fas fa-plus-circle me-1"></i> TAMBAH PROYEK
            </button>
        </div>

        <div class="port-card-body">
            <div class="table-responsive custom-scroll">
                <table class="port-table">
                    <thead>
                        <tr>
                            <th>PROYEK</th>
                            <th>KATEGORI</th>
                            <th>PERAN</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(Auth::user()->portfolios as $p)
                        <tr>
                            <td>
                                <div class="port-project-info">
                                    <div class="port-img-placeholder">
                                        <i class="fas fa-project-diagram"></i>
                                    </div>
                                    <div class="port-text-group">
                                        <div class="port-project-name">{{ $p->project_name }}</div>
                                        <div class="port-project-year">{{ $p->year ?? date('Y') }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="port-badge" style="--badge-bg: {{ $p->type_styles['bg'] }}; --badge-color: {{ $p->type_styles['color'] }};">
                                    {{ strtoupper($p->type_styles['label']) }}
                                </span>
                            </td>
                            <td><span class="port-role-text">{{ $p->my_role }}</span></td>
                            <td>
                                <div class="port-action-group">
                                    <form action="{{ route('general.cv.destroy', ['portfolios', $p->id]) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="port-btn-delete shadow-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="port-empty">
                                    <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.2;"></i>
                                    <p class="text-muted small italic">Belum ada portofolio yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addPortfolio" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content port-modal-custom">
            <form action="{{ route('general.cv.store', 'portfolios') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="port-title port-dark-text mb-0">Tambah Proyek Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="port-label">Nama Proyek</label>
                            <input type="text" name="project_name" class="port-input" placeholder="Contoh: HUMA-ARSA (Robot Pertanian)" required>
                        </div>
                        <div class="col-md-4">
                            <label class="port-label">Tahun</label>
                            <input type="number" name="year" class="port-input" value="{{ date('Y') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="port-label">Kategori Proyek</label>
                            <select name="type" class="port-input port-select" required>
                                <option value="web">Web System</option>
                                <option value="iot">IoT & Robotics</option>
                                <option value="social">Social Impact</option>
                                <option value="research">Research & Data</option>
                                <option value="event">Program Management</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="port-label">Peran Kamu</label>
                            <input type="text" name="my_role" class="port-input" placeholder="Contoh: Lead Developer / Founder" required>
                        </div>
                        <div class="col-12">
                            <label class="port-label">Deskripsi Singkat</label>
                            <textarea name="short_description" class="port-input port-textarea" rows="3" placeholder="Jelaskan tujuan dan teknologi yang digunakan..."></textarea>
                        </div>
                        <div class="col-12">
                            <label class="port-label">Link Eksternal (Opsional)</label>
                            <input type="url" name="external_link" class="port-input" placeholder="https://github.com/yota/project">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="port-btn-submit w-100">PUBLIKASIKAN KARYA</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS ISOLATION FOR PORTFOLIO SECTION */
    .yota-portfolio-isolated {
        --p-primary: #052c24;
        --p-lemon: #BEF264;
        --p-border: #f1f5f9;
        --p-muted: #94a3b8;
        --p-white: #ffffff;

        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .yota-portfolio-isolated .port-main-card {
        background: var(--p-white);
        border-radius: 28px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        border: none !important;
        overflow: hidden;
    }

    .yota-portfolio-isolated .port-card-header {
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--p-border);
    }

    .yota-portfolio-isolated .port-dark-text { color: var(--p-primary); }
    .yota-portfolio-isolated .port-title { font-weight: 800; margin: 0; font-size: 1.15rem; }
    .yota-portfolio-isolated .port-subtitle { color: var(--p-muted); font-size: 0.8rem; margin-top: 4px; }

    .yota-portfolio-isolated .port-btn-add {
        background: var(--p-lemon);
        color: var(--p-primary);
        border: none;
        padding: 10px 18px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.75rem;
        transition: 0.3s;
    }

    .yota-portfolio-isolated .port-btn-add:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(190, 242, 100, 0.4); }

    /* Table Styling */
    .yota-portfolio-isolated .port-card-body { padding: 1rem 1.5rem; }
    .yota-portfolio-isolated .port-table { width: 100%; border-collapse: separate; border-spacing: 0 8px; }
    .yota-portfolio-isolated .port-table thead th {
        padding: 12px 15px;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--p-muted);
        border-bottom: 1px solid var(--p-border);
    }

    .yota-portfolio-isolated .port-table tbody td { padding: 15px; vertical-align: middle; background: #fff; border-top: 1px solid var(--p-border); border-bottom: 1px solid var(--p-border); }
    .yota-portfolio-isolated .port-table tbody tr td:first-child { border-left: 1px solid var(--p-border); border-radius: 12px 0 0 12px; }
    .yota-portfolio-isolated .port-table tbody tr td:last-child { border-right: 1px solid var(--p-border); border-radius: 0 12px 12px 0; text-align: center; }

    /* Project Info Styling */
    .yota-portfolio-isolated .port-project-info { display: flex; align-items: center; gap: 12px; }
    .yota-portfolio-isolated .port-img-placeholder {
        width: 40px; height: 40px; background: rgba(5, 44, 36, 0.05); color: var(--p-primary);
        border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px;
    }
    .yota-portfolio-isolated .port-project-name { font-weight: 700; color: var(--p-primary); font-size: 14px; }
    .yota-portfolio-isolated .port-project-year { font-size: 11px; color: var(--p-muted); }

    .yota-portfolio-isolated .port-badge {
        padding: 4px 10px; border-radius: 8px; font-size: 9px; font-weight: 800;
        background: var(--badge-bg); color: var(--badge-color);
    }

    .yota-portfolio-isolated .port-role-text { font-size: 13px; font-weight: 600; color: #475569; }

    .yota-portfolio-isolated .port-btn-delete {
        background: #fff; color: #ef4444; border: 1.5px solid #fee2e2; width: 32px; height: 32px;
        border-radius: 10px; transition: 0.2s;
    }
    .yota-portfolio-isolated .port-btn-delete:hover { background: #ef4444; color: #fff; }

    /* Modal Styling */
    .port-modal-custom { border-radius: 28px !important; border: none !important; }
    .port-label { font-size: 12px; font-weight: 700; color: var(--p-primary); margin-bottom: 6px; display: block; }
    .port-input {
        width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #eef2f6;
        border-radius: 12px; font-size: 14px; color: var(--p-primary); transition: 0.3s;
    }
    .port-input:focus { border-color: var(--p-primary); outline: none; box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05); }
    .port-btn-submit {
        background: var(--p-primary); color: var(--p-lemon); border: none; padding: 14px;
        border-radius: 16px; font-weight: 800; transition: 0.3s;
    }
</style>

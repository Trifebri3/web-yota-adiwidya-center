<div class="yota-skills-isolated">
    <div class="sk-main-card">
        <div class="sk-card-header">
            <div class="sk-header-text">
                <h5 class="sk-title sk-dark-text">Skills & Expertise</h5>
                <p class="sk-subtitle">Kelola matriks kompetensi teknis untuk kredibilitas GTU.</p>
            </div>
            <button class="sk-btn-add" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                <i class="fas fa-plus-circle me-1"></i> TAMBAH SKILL
            </button>
        </div>

        <div class="sk-card-body">
            <div class="sk-table-wrapper custom-scroll">
                <table class="sk-table">
                    <thead>
                        <tr>
                            <th style="width: 35%;">NAMA SKILL</th>
                            <th style="width: 25%;">KATEGORI</th>
                            <th style="width: 30%;">PROFICIENCY</th>
                            <th style="width: 10%; text-align: center;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(Auth::user()->skills as $skill)
                        <tr class="sk-row">
                            <td>
                                <div class="sk-name-box">
                                    <span class="sk-dot-decorator" style="background-color: {{ $skill->color }}"></span>
                                    <span class="sk-name-text">{{ $skill->name }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="sk-badge" style="--sk-color: {{ $skill->color }}">
                                    {{ strtoupper($skill->category) }}
                                </span>
                            </td>
                            <td>
                                <div class="sk-progress-container">
                                    <div class="sk-progress-bg">
                                        <div class="sk-progress-fill" style="width: {{ $skill->proficiency_percent }}%; background: {{ $skill->color }}; shadow: 0 0 10px {{ $skill->color }}40;"></div>
                                    </div>
                                    <span class="sk-percent-text">{{ $skill->proficiency_percent }}%</span>
                                </div>
                            </td>
                            <td style="text-align: center;">
                                <form action="{{ route('general.cv.destroy', ['skills', $skill->id]) }}" method="POST" onsubmit="return confirm('Hapus skill ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="sk-btn-delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="sk-empty-row">
                                <div class="sk-empty-state">
                                    <i class="fas fa-layer-group mb-3"></i>
                                    <p>Belum ada data skill teknis yang terdaftar.</p>
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

<div class="modal fade" id="addSkillModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content sk-modal-custom">
            <form action="{{ route('general.cv.store', 'skills') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="sk-title sk-dark-text mb-0">Tambah Skill Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="sk-form-group mb-3">
                        <label class="sk-label">Nama Skill</label>
                        <input type="text" name="name" class="sk-input" placeholder="Contoh: Laravel, IoT, AI" required>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="sk-label">Kategori</label>
                            <select name="category" class="sk-input sk-select" required>
                                <option value="web">Web Development</option>
                                <option value="mobile">Mobile Apps</option>
                                <option value="ai_iot">AI & IoT</option>
                                <option value="hardware">Hardware</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="sk-label">Kemahiran (%)</label>
                            <input type="number" name="proficiency_percent" class="sk-input" min="0" max="100" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="sk-btn-submit w-100">SIMPAN SKILL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* CSS ISOLATION FOR SKILLS SECTION */
    .yota-skills-isolated {
        --sk-primary: #052c24;
        --sk-lemon: #BEF264;
        --sk-border: #f1f5f9;
        --sk-text-main: #1e293b;
        --sk-text-muted: #64748b;
        --sk-white: #ffffff;

        width: 100%;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .yota-skills-isolated .sk-main-card {
        background: var(--sk-white);
        border-radius: 28px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        border: none !important;
        overflow: hidden;
    }

    .yota-skills-isolated .sk-card-header {
        padding: 1.5rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--sk-border);
    }

    .yota-skills-isolated .sk-dark-text { color: var(--sk-primary); }
    .yota-skills-isolated .sk-title { font-weight: 800; margin: 0; font-size: 1.2rem; }
    .yota-skills-isolated .sk-subtitle { color: var(--sk-text-muted); font-size: 0.85rem; margin-top: 4px; }

    .yota-skills-isolated .sk-btn-add {
        background: var(--sk-primary);
        color: var(--sk-lemon);
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.75rem;
        transition: 0.3s;
    }

    /* Table Styling */
    .yota-skills-isolated .sk-card-body { padding: 1rem 1.5rem; }
    .yota-skills-isolated .sk-table { width: 100%; border-collapse: collapse; }
    .yota-skills-isolated .sk-table thead th {
        padding: 15px;
        font-size: 11px;
        text-transform: uppercase;
        color: var(--sk-text-muted);
        border-bottom: 2px solid var(--sk-border);
        text-align: left;
    }

    .yota-skills-isolated .sk-row td { padding: 18px 15px; border-bottom: 1px solid var(--sk-border); }

    .yota-skills-isolated .sk-name-box { display: flex; align-items: center; gap: 12px; }
    .yota-skills-isolated .sk-dot-decorator { width: 8px; height: 8px; border-radius: 50%; }
    .yota-skills-isolated .sk-name-text { font-weight: 700; color: var(--sk-primary); }

    .yota-skills-isolated .sk-badge {
        padding: 5px 12px; border-radius: 8px; font-size: 10px; font-weight: 800;
        background: color-mix(in srgb, var(--sk-color), transparent 85%);
        color: var(--sk-color);
        border: 1px solid color-mix(in srgb, var(--sk-color), transparent 70%);
    }

    /* Progress Bar */
    .yota-skills-isolated .sk-progress-container { display: flex; align-items: center; gap: 12px; }
    .yota-skills-isolated .sk-progress-bg { flex-grow: 1; height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden; }
    .yota-skills-isolated .sk-progress-fill { height: 100%; border-radius: 10px; transition: width 1s ease-in-out; }
    .yota-skills-isolated .sk-percent-text { font-size: 11px; font-weight: 800; color: var(--sk-primary); min-width: 35px; }

    .yota-skills-isolated .sk-btn-delete {
        background: transparent; border: none; color: #94a3b8; font-size: 16px; transition: 0.2s;
    }
    .yota-skills-isolated .sk-btn-delete:hover { color: #ef4444; transform: scale(1.1); }

    /* Modal Isolated */
    .sk-modal-custom { border-radius: 28px !important; border: none !important; }
    .sk-label { font-size: 12px; font-weight: 700; color: var(--sk-primary); margin-bottom: 6px; display: block; }
    .sk-input {
        width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #eef2f6;
        border-radius: 14px; font-size: 14px; color: var(--sk-primary); transition: 0.3s;
    }
    .sk-input:focus { border-color: var(--sk-primary); outline: none; box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05); }
    .sk-btn-submit {
        background: var(--sk-primary); color: var(--sk-lemon); border: none; padding: 14px;
        border-radius: 16px; font-weight: 800; transition: 0.3s;
    }

    .yota-skills-isolated .sk-empty-state { text-align: center; color: var(--sk-text-muted); padding: 2rem 0; }
</style>

<div class="card border-0 shadow-sm mt-4 yota-social-section">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="fw-bold section-title">Koneksi & Media Sosial</h5>
        <p class="text-muted small">Hubungkan profil profesional kamu dengan platform eksternal.</p>
    </div>
    <div class="card-body px-4 pb-4">
        <form action="{{ route('general.cv.store', 'social_links') }}" method="POST" class="social-form mb-4">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="label-yota">Platform</label>
                    <div class="select-wrapper">
                        <select name="platform_name" class="form-select-yota" required>
                            <option value="GitHub">GitHub</option>
                            <option value="LinkedIn">LinkedIn</option>
                            <option value="Instagram">Instagram</option>
                            <option value="YouTube">YouTube</option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="TikTok">TikTok</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="label-yota">URL Profil</label>
                    <input type="url" name="url" class="form-control-yota" placeholder="https://linkedin.com/in/username" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn-yota-add">
                        <i class="fas fa-plus me-1"></i> ADD
                    </button>
                </div>
            </div>
        </form>

        <hr class="divider-yota">

        <div class="social-grid">
            @forelse(Auth::user()->socialLinks as $social)
            <div class="social-item-badge">
                <div class="social-icon-box">
                    <i class="{{ $social->bootstrap_icon }}"></i>
                </div>
                <div class="social-info">
                    <span class="platform-name">{{ $social->platform_name }}</span>
                </div>
                <form action="{{ route('general.cv.destroy', ['social_links', $social->id]) }}" method="POST" class="ms-2">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-delete-social" title="Hapus Link">
                        <i class="fas fa-times"></i>
                    </button>
                </form>
            </div>
            @empty
            <div class="empty-state text-center py-3">
                <p class="text-muted small italic">Belum ada link media sosial yang ditambahkan.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    .yota-social-section {
        background: #ffffff !important;
        border-radius: 25px !important;
    }

    .yota-social-section .section-title {
        color: #052c24;
        font-weight: 800;
    }

    /* Form Styling */
    .label-yota {
        font-size: 12px;
        font-weight: 700;
        color: #64748b;
        margin-bottom: 8px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-select-yota, .form-control-yota {
        width: 100%;
        padding: 12px 16px;
        background: #f8fafc;
        border: 2px solid #f1f5f9;
        border-radius: 12px;
        font-size: 14px;
        color: #052c24;
        transition: 0.3s;
    }

    .form-select-yota:focus, .form-control-yota:focus {
        border-color: #052c24;
        background: #fff;
        outline: none;
        box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05);
    }

    .btn-yota-add {
        background: #BEF264;
        color: #052c24;
        border: none;
        width: 100%;
        padding: 12px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 13px;
        transition: 0.3s;
    }

    .btn-yota-add:hover {
        background: #a8d650;
        transform: translateY(-2px);
    }

    .divider-yota {
        border-top: 2px dashed #f1f5f9;
        margin: 25px 0;
    }

    /* Social Grid & Badges */
    .social-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .social-item-badge {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid #f1f5f9;
        padding: 8px 12px;
        border-radius: 100px;
        transition: 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .social-item-badge:hover {
        border-color: #052c24;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }

    .social-icon-box {
        width: 32px;
        height: 32px;
        background: #052c24;
        color: #BEF264;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        margin-right: 10px;
    }

    .platform-name {
        font-size: 13px;
        font-weight: 700;
        color: #334155;
    }

    .btn-delete-social {
        background: transparent;
        border: none;
        color: #cbd5e1;
        font-size: 12px;
        padding: 0;
        margin-left: 5px;
        transition: 0.2s;
    }

    .btn-delete-social:hover {
        color: #ef4444;
        transform: scale(1.2);
    }

    .empty-state p {
        font-style: italic;
    }
</style>

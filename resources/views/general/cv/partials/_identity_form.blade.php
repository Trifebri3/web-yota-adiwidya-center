<div class="card border-0 shadow-sm yota-id-section">
    <div class="card-header bg-white border-0 pt-4 px-4">
        <h5 class="fw-bold section-title">Identitas Profesional</h5>
        <p class="text-muted small">Kelola data dasar dan representasi visual profil kamu.</p>
    </div>
    <div class="card-body px-4 pb-4">
        <form action="{{ route('general.identity.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-4 align-items-center">
                <div class="col-lg-4 text-center border-end-custom">
                    <div class="avatar-upload-wrapper">
                        <img src="{{ $identity->avatar_url }}" class="profile-preview shadow-sm" id="avatar-preview">
                        <div class="upload-overlay">
                            <i class="fas fa-camera"></i>
                            <input type="file" name="avatar_image" class="file-input" onchange="previewImage(event)">
                        </div>
                    </div>
                    <div class="mt-3">
                        <span class="badge rounded-pill bg-soft-yota text-dark px-3 py-2" style="font-size: 10px;">
                            <i class="fas fa-info-circle me-1"></i> Rekomendasi 1:1 (Max 2MB)
                        </span>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="label-yota">Nama Lengkap</label>
                            <div class="input-group-yota">
                                <i class="fas fa-user icon-field"></i>
                                <input type="text" name="full_name" class="form-control-yota" value="{{ $identity->full_name }}" placeholder="Tri Febriansah" required>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="label-yota">Professional Title</label>
                            <div class="input-group-yota">
                                <i class="fas fa-briefcase icon-field"></i>
                                <input type="text" name="professional_title" class="form-control-yota" value="{{ $identity->professional_title }}" placeholder="Fullstack Developer | Founder Yota">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2">
                    <label class="label-yota">Tentang Saya (Bio Profesional)</label>
                    <textarea name="about_me" class="form-control-yota area-yota" rows="5" placeholder="Ceritakan singkat tentang visi dan keahlianmu...">{{ $identity->about_me }}</textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn-yota-save">
                    <i class="fas fa-save me-2"></i> Perbarui Identitas
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Scope khusus agar tidak terganggu CSS Global */
    .yota-id-section {
        background: #ffffff !important;
        border-radius: 25px !important;
        overflow: hidden;
    }

    .yota-id-section .section-title {
        color: #052c24;
        letter-spacing: -0.5px;
    }

    /* Avatar Logic */
    .avatar-upload-wrapper {
        position: relative;
        width: 160px;
        height: 160px;
        margin: 0 auto;
        border-radius: 50%;
        padding: 5px;
        background: linear-gradient(135deg, #052c24 0%, #BEF264 100%);
    }

    .profile-preview {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffff;
        background: #f8fafc;
    }

    .upload-overlay {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 40px;
        height: 40px;
        background: #052c24;
        color: #BEF264;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 3px solid #ffffff;
        transition: 0.3s;
    }

    .upload-overlay:hover {
        transform: scale(1.1);
        background: #0a4d3f;
    }

    .file-input {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
    }

    /* Custom Input Styling */
    .label-yota {
        font-size: 13px;
        font-weight: 700;
        color: #475569;
        margin-bottom: 8px;
        display: block;
    }

    .input-group-yota {
        position: relative;
        display: flex;
        align-items: center;
    }

    .icon-field {
        position: absolute;
        left: 15px;
        color: #94a3b8;
        font-size: 14px;
    }

    .form-control-yota {
        width: 100%;
        padding: 12px 15px 12px 45px;
        background: #fcfdfe;
        border: 1.5px solid #eef2f6;
        border-radius: 12px;
        font-size: 14px;
        color: #052c24;
        transition: 0.3s;
    }

    .form-control-yota:focus {
        border-color: #052c24;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(5, 44, 36, 0.05);
        outline: none;
    }

    .area-yota {
        padding: 15px !important;
    }

    /* Button Styling */
    .btn-yota-save {
        background: #052c24;
        color: #BEF264;
        border: none;
        padding: 12px 30px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 14px;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(5, 44, 36, 0.2);
    }

    .btn-yota-save:hover {
        background: #0a4d3f;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 44, 36, 0.25);
    }

    .bg-soft-yota {
        background: rgba(5, 44, 36, 0.05);
    }

    @media (min-width: 992px) {
        .border-end-custom {
            border-right: 1.5px solid #f1f5f9;
        }
    }
</style>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('avatar-preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

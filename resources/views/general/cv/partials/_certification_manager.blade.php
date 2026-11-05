<div class="yota-cert-isolated">
    <div class="cert-main-card">
        <div class="cert-card-header">
            <div class="cert-header-text">
                <h5 class="cert-title cert-dark-text">Sertifikasi & Lisensi</h5>
                <p class="cert-subtitle">Validasi keahlian profesional dan kursus bersertifikat.</p>
            </div>
            <button class="cert-btn-add" data-bs-toggle="modal" data-bs-target="#addCertModal">
                <i class="fas fa-certificate me-1"></i> TAMBAH SERTIFIKAT
            </button>
        </div>

        <div class="cert-card-body">
            <div class="cert-grid">
                @forelse(Auth::user()->certifications as $cert)
                <div class="cert-item-box shadow-hover-yota">
                    <div class="cert-flex">
                        <div class="cert-icon-area">
                            <i class="fas fa-medal"></i>
                        </div>
                        <div class="cert-content">
                            <h6 class="cert-name">{{ $cert->cert_name }}</h6>
                            <p class="cert-org">{{ $cert->issuing_organization }}</p>
                            <div class="cert-meta">
                                <span>Terbit: {{ $cert->issue_date->format('M Y') }}</span>
                                @if($cert->expiry_date)
                                    <span class="mx-1">•</span>
                                    <span class="{{ $cert->is_expired ? 'text-danger' : '' }}">
                                        Exp: {{ $cert->expiry_date->format('M Y') }}
                                    </span>
                                @endif
                            </div>
                            @if($cert->credential_url)
                            <a href="{{ $cert->credential_url }}" target="_blank" class="cert-link-btn">
                                Lihat Kredensial <i class="fas fa-external-link-alt ms-1"></i>
                            </a>
                            @endif
                        </div>
                        <div class="cert-actions">
                            <form action="{{ route('general.cv.destroy', ['certifications', $cert->id]) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="cert-delete-btn"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="cert-empty">Belum ada sertifikasi yang ditambahkan.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addCertModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content cert-modal-custom">
            <form action="{{ route('general.cv.store', 'certifications') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="cert-title cert-dark-text mb-0">Tambah Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="cert-label">Nama Sertifikasi</label>
                        <input type="text" name="cert_name" class="cert-input" placeholder="Contoh: Laravel Developer Certification" required>
                    </div>
                    <div class="mb-3">
                        <label class="cert-label">Organisasi Penerbit</label>
                        <input type="text" name="issuing_organization" class="cert-input" placeholder="Contoh: Google / Dicoding" required>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="cert-label">Tanggal Terbit</label>
                            <input type="date" name="issue_date" class="cert-input" required>
                        </div>
                        <div class="col-6">
                            <label class="cert-label">Tanggal Kadaluarsa</label>
                            <input type="date" name="expiry_date" class="cert-input">
                        </div>
                    </div>
                    <div class="mb-0">
                        <label class="cert-label">URL Kredensial (Link Sertifikat)</label>
                        <input type="url" name="credential_url" class="cert-input" placeholder="https://...">
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="cert-btn-submit w-100">SIMPAN SERTIFIKAT</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .yota-cert-isolated { --c-p: #052c24; --c-l: #BEF264; font-family: 'Plus Jakarta Sans', sans-serif; }
    .cert-main-card { background: #fff; border-radius: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); overflow: hidden; }
    .cert-card-header { padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; }
    .cert-dark-text { color: var(--c-p); }
    .cert-title { font-weight: 800; margin: 0; font-size: 1.15rem; }
    .cert-subtitle { color: #94a3b8; font-size: 0.8rem; margin-top: 4px; }
    .cert-btn-add { background: var(--c-p); color: var(--c-l); border: none; padding: 10px 18px; border-radius: 12px; font-weight: 800; font-size: 0.75rem; }
    .cert-card-body { padding: 1.5rem 2rem; }
    .cert-item-box { background: #f8fafc; border-radius: 20px; padding: 1.25rem; margin-bottom: 1rem; border: 1.5px solid transparent; transition: 0.3s; }
    .cert-item-box:hover { border-color: var(--c-p); background: #fff; transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    .cert-flex { display: flex; align-items: start; gap: 15px; }
    .cert-icon-area { width: 45px; height: 45px; background: rgba(5, 44, 36, 0.05); color: var(--c-p); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .cert-content { flex-grow: 1; }
    .cert-name { font-weight: 700; margin-bottom: 2px; color: var(--c-p); }
    .cert-org { font-size: 13px; font-weight: 600; color: #64748b; margin-bottom: 5px; }
    .cert-meta { font-size: 11px; color: #94a3b8; font-weight: 600; }
    .cert-link-btn { display: inline-block; margin-top: 10px; font-size: 11px; font-weight: 800; color: var(--c-p); text-decoration: none; border-bottom: 2px solid var(--c-l); }
    .cert-delete-btn { border: none; background: transparent; color: #94a3b8; transition: 0.2s; }
    .cert-delete-btn:hover { color: #ef4444; }
    .cert-modal-custom { border-radius: 24px !important; border: none !important; }
    .cert-label { font-size: 12px; font-weight: 700; color: var(--c-p); margin-bottom: 6px; display: block; }
    .cert-input { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #eef2f6; border-radius: 12px; font-size: 14px; color: var(--c-p); }
    .cert-btn-submit { background: var(--c-p); color: var(--c-l); border: none; padding: 14px; border-radius: 16px; font-weight: 800; }
</style>

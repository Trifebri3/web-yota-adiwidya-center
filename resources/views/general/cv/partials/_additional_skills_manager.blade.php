<div class="yota-addskill-isolated">
    <div class="as-main-card">
        <div class="as-card-header">
            <div class="as-header-text">
                <h5 class="as-title as-dark-text">Kemampuan Tambahan</h5>
                <p class="as-subtitle">Bahasa, Soft Skills, dan Kompetensi pendukung lainnya.</p>
            </div>
            <button class="as-btn-add" data-bs-toggle="modal" data-bs-target="#addSkillExtraModal">
                <i class="fas fa-plus-circle me-1"></i> TAMBAH
            </button>
        </div>

        <div class="as-card-body">
            <div class="as-grid">
                @forelse(Auth::user()->additionalSkills as $askill)
                <div class="as-item-pill">
                    <div class="as-icon-box" style="background: {{ $askill->type_color }}20; color: {{ $askill->type_color }}">
                        <i class="fas {{ $askill->skill_type === 'language' ? 'fa-language' : 'fa-lightbulb' }}"></i>
                    </div>
                    <div class="as-info">
                        <span class="as-name">{{ $askill->skill_name }}</span>
                        <span class="as-level">{{ $askill->proficiency_level }}</span>
                    </div>
                    <form action="{{ route('general.cv.destroy', ['additional_skills', $askill->id]) }}" method="POST" class="ms-2">
                        @csrf @method('DELETE')
                        <button type="submit" class="as-delete-btn"><i class="fas fa-times"></i></button>
                    </form>
                </div>
                @empty
                <div class="as-empty">Belum ada kemampuan tambahan.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addSkillExtraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content as-modal-custom">
            <form action="{{ route('general.cv.store', 'additional_skills') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pt-4 px-4">
                    <h5 class="as-title as-dark-text mb-0">Tambah Kemampuan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="as-label">Nama Kemampuan</label>
                        <input type="text" name="skill_name" class="as-input" placeholder="Contoh: Bahasa Jerman, Public Speaking" required>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <label class="as-label">Tipe</label>
                            <select name="skill_type" class="as-input" required>
                                <option value="language">Bahasa</option>
                                <option value="soft_skill">Soft Skill</option>
                                <option value="hobby_tech">Hobby Tech</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="as-label">Level</label>
                            <select name="proficiency_level" class="as-input" required>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Expert">Expert</option>
                                <option value="Native">Native</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pb-4 px-4">
                    <button type="submit" class="as-btn-submit w-100">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .yota-addskill-isolated { --as-p: #052c24; --as-l: #BEF264; font-family: 'Plus Jakarta Sans', sans-serif; }
    .as-main-card { background: #fff; border-radius: 28px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); overflow: hidden; margin-top: 2rem; }
    .as-card-header { padding: 1.5rem 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f1f5f9; }
    .as-dark-text { color: var(--as-p); }
    .as-title { font-weight: 800; margin: 0; font-size: 1.15rem; }
    .as-subtitle { color: #94a3b8; font-size: 0.8rem; margin-top: 4px; }
    .as-btn-add { background: var(--as-p); color: var(--as-l); border: none; padding: 8px 18px; border-radius: 12px; font-weight: 800; font-size: 0.75rem; }
    .as-card-body { padding: 1.5rem 2rem; }
    .as-grid { display: flex; flex-wrap: wrap; gap: 12px; }
    .as-item-pill { display: flex; align-items: center; background: #fff; border: 1.5px solid #f1f5f9; padding: 8px 15px; border-radius: 100px; transition: 0.3s; }
    .as-item-pill:hover { border-color: var(--as-p); transform: translateY(-2px); }
    .as-icon-box { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; margin-right: 12px; }
    .as-info { display: flex; flex-direction: column; }
    .as-name { font-size: 13px; font-weight: 700; color: var(--as-p); line-height: 1.2; }
    .as-level { font-size: 10px; font-weight: 800; color: #94a3b8; text-transform: uppercase; }
    .as-delete-btn { border: none; background: transparent; color: #cbd5e1; font-size: 12px; }
    .as-delete-btn:hover { color: #ef4444; }
    .as-modal-custom { border-radius: 24px !important; border: none !important; }
    .as-label { font-size: 12px; font-weight: 700; color: var(--as-p); margin-bottom: 6px; display: block; }
    .as-input { width: 100%; padding: 12px 16px; background: #f8fafc; border: 1.5px solid #eef2f6; border-radius: 12px; font-size: 14px; color: var(--as-p); }
    .as-btn-submit { background: var(--as-p); color: var(--as-l); border: none; padding: 14px; border-radius: 16px; font-weight: 800; }
</style>

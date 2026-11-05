<div class="yota-public-container">
    {{-- 1. VERSATILE CAPABILITIES --}}
    <section id="skills">
        <div class="yota-public-as-showcase">
            <div class="as-public-header-area">
                <h2 class="as-main-heading">Versatile <br> <span class="text-lemon-highlight">Capabilities.</span></h2>
                <p class="as-lead-text">Beragam keahlian dan kompetensi yang mendukung kolaborasi, pengembangan, serta kontribusi profesional di berbagai bidang.</p>
            </div>

            <div class="as-public-grid">
                @forelse($user->additionalSkills as $askill)
                <div class="as-public-pill">
                    <div class="as-public-icon" style="background: {{ $askill->type_color }}15; color: {{ $askill->type_color }}">
                        <i class="fas {{ $askill->skill_type === 'language' ? 'fa-language' : 'fa-lightbulb' }}"></i>
                    </div>
                    <div class="as-public-info">
                        <span class="as-public-name">{{ $askill->skill_name }}</span>
                        <span class="as-public-level">{{ $askill->proficiency_level }}</span>
                    </div>
                </div>
                @empty
                <div class="as-public-empty">
                    <p>Data kompetensi tambahan segera diperbarui.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 2. INNOVATION PORTFOLIO --}}
    <section id="projects">
        <div class="yota-public-port-showcase">
            <div class="port-public-header-area">
                <h2 class="port-main-heading">Innovation <br> <span class="text-lemon-highlight">Showcase.</span></h2>
                <p class="port-lead-text">Koleksi karya dan pencapaian kreatif yang mencerminkan ide, inovasi, serta kontribusi dari berbagai bidang.</p>
            </div>

            <div class="port-public-grid">
                @forelse($user->portfolios as $p)
                <div class="port-item-card">
                    <div class="port-card-visual">
                        <div class="port-visual-overlay">
                            <span class="port-year-tag">{{ $p->year }}</span>
                            @if($p->external_link)
                            <a href="{{ $p->external_link }}" target="_blank" class="port-link-circle" title="View Source / Demo">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            @endif
                        </div>
                        <div class="port-icon-main">
                            <i class="{{ $p->type == 'iot' ? 'fas fa-robot' : ($p->type == 'web' ? 'fas fa-code' : 'fas fa-lightbulb') }}"></i>
                        </div>
                    </div>

                    <div class="port-card-details">
                        <div class="port-type-badge" style="--t-bg: {{ $p->type_styles['bg'] }}; --t-color: {{ $p->type_styles['color'] }}">
                            {{ strtoupper($p->type_styles['label']) }}
                        </div>
                        <h4 class="port-project-title">{{ $p->project_name }}</h4>
                        <div class="port-role-pill">
                            <i class="fas fa-user-tag me-1"></i> {{ $p->my_role }}
                        </div>

                        @if($p->short_description)
                        <p class="port-project-desc">
                            {{ $p->short_description }}
                        </p>
                        @endif
                    </div>

                    <div class="port-hover-line"></div>
                </div>
                @empty
                <div class="port-public-empty">
                    <i class="fas fa-folder-open mb-3 opacity-20"></i>
                    <p>Portofolio inovasi sedang dalam tahap dokumentasi sistem.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 3. LEADERSHIP & NGO --}}
    <section id="leadership">
        <div class="yota-public-org-showcase">
            <div class="org-public-header-area">
                <h2 class="org-main-heading">Leadership <span class="text-stroke">&</span> <br> <span class="text-lemon-highlight">Social Impact.</span></h2>
                <p class="org-lead-text">Membangun peradaban berkelanjutan melalui inisiatif teknologi dan kemanusiaan.</p>
            </div>

            <div class="org-public-grid">
                @forelse($user->organizations as $org)
                <div class="org-public-card">
                    <div class="org-card-top">
                        <div class="org-brand-box">
                            <img src="{{ $org->logo_url }}" alt="{{ $org->organization_name }}" class="org-public-logo">
                        </div>
                        <div class="org-status-chip">
                            {{ $org->full_status }}
                        </div>
                    </div>

                    <div class="org-card-body-public">
                        <h4 class="org-public-name">{{ $org->organization_name }}</h4>
                        <div class="org-public-position">{{ $org->position }}</div>

                        @if($org->contribution_desc)
                        <div class="org-public-contribution">
                            <p>{{ $org->contribution_desc }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="org-card-footer-line"></div>
                </div>
                @empty
                <div class="org-public-empty">
                    <p>Data kontribusi organisasi sedang dalam tahap kurasi dokumentasi.</p>
                </div>
                @endforelse
            </div>
        </div>

        {{-- ACHIEVEMENTS --}}
        <div class="yota-public-ach-showcase mt-5">
            <div class="ach-public-header-area">
                <h2 class="ach-main-heading">Recognized <br> <span class="text-lemon-highlight">Excellence.</span></h2>
                <p class="ach-lead-text">Apresiasi dan rekaman jejak dedikasi profesional dalam inovasi teknologi dan kontribusi sosial.</p>
            </div>

            <div class="ach-public-grid">
                @forelse($user->achievements as $ach)
                <div class="ach-public-card">
                    <div class="ach-card-inner">
                        <div class="ach-public-level" style="--ach-accent: {{ $ach->level_details['color'] }}">
                            <i class="fas fa-award me-2"></i>
                            {{ strtoupper($ach->level_details['label']) }}
                        </div>

                        <h4 class="ach-public-award-name">{{ $ach->award_name }}</h4>

                        <div class="ach-public-meta">
                            <div class="ach-meta-item">
                                <i class="fas fa-university opacity-50"></i> {{ $ach->institution }}
                            </div>
                            <div class="ach-meta-item">
                                <i class="fas fa-calendar-alt opacity-50"></i> {{ $ach->attained_year }}
                            </div>
                        </div>

                        @if($ach->summary)
                        <div class="ach-public-summary">
                            <p>{{ $ach->summary }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="ach-card-decorator" style="background: {{ $ach->level_details['color'] }}"></div>
                </div>
                @empty
                <div class="ach-public-empty">
                    <i class="fas fa-medal mb-3 opacity-20 fa-3x"></i>
                    <p>Daftar pencapaian sedang dalam proses verifikasi sistem.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- 4. ACADEMIC & VALIDATION --}}
    <section id="education">
        <div class="yota-public-edu-showcase">
            <div class="edu-public-header-area">
                <h2 class="edu-main-heading">Academic <br> <span class="text-lemon-highlight">Foundation.</span></h2>
                <p class="edu-lead-text">Perjalanan akademik dan pengembangan intelektual sebagai fondasi keahlian teknis.</p>
            </div>

            <div class="edu-public-timeline">
                @forelse($user->educations as $edu)
                <div class="edu-public-item">
                    <div class="edu-public-indicator">
                        <div class="edu-public-dot"></div>
                        <div class="edu-public-line"></div>
                    </div>

                    <div class="edu-public-card">
                        <div class="edu-public-header-content">
                            <div class="edu-public-meta">
                                <span class="edu-public-period">
                                    <i class="far fa-calendar-alt me-1"></i> {{ $edu->year_range }}
                                </span>
                                @if($edu->is_current)
                                    <span class="edu-public-tag-current">Ongoing</span>
                                @endif
                            </div>
                            <h4 class="edu-public-inst">{{ $edu->institution }}</h4>
                        </div>

                        <div class="edu-public-body">
                            <div class="edu-public-degree">
                                {{ $edu->degree }} in <span class="text-dark-yota">{{ $edu->field_of_study }}</span>
                            </div>

                            @if($edu->achievements_summary)
                            <div class="edu-public-achievements">
                                <div class="ach-label-tiny">KEY NOTES & ACHIEVEMENTS</div>
                                <p class="ach-text-small">{!! nl2br(e($edu->achievements_summary)) !!}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="edu-public-empty">
                    <p>Informasi latar belakang pendidikan sedang diperbarui.</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="mt-5">
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="yota-public-cert-showcase">
                        <div class="cert-public-header-area">
                            <h2 class="cert-main-heading">Expert <br> <span class="text-lemon-highlight">Validations.</span></h2>
                            <p class="cert-lead-text">Koleksi lisensi dan sertifikasi profesional yang memvalidasi kompetensi teknis saya sesuai standar industri.</p>
                        </div>

                        <div class="cert-public-grid">
                            @forelse($user->certifications as $cert)
                            <div class="cert-public-card">
                                <div class="cert-inner">
                                    <div class="cert-status-wrapper">
                                        @if($cert->is_expired)
                                            <span class="cert-badge-status expired">Expired</span>
                                        @else
                                            <span class="cert-badge-status active">Verified</span>
                                        @endif
                                    </div>

                                    <div class="cert-main-content">
                                        <div class="cert-visual-icon">
                                            <i class="fas fa-certificate"></i>
                                        </div>
                                        <div class="cert-text-info">
                                            <h5 class="cert-public-name">{{ $cert->cert_name }}</h5>
                                            <p class="cert-public-org">{{ $cert->issuing_organization }}</p>
                                        </div>
                                    </div>

                                    <div class="cert-footer-meta">
                                        <div class="cert-date-info">
                                            <i class="far fa-calendar-alt me-1"></i>
                                            <span>Issued {{ $cert->issue_date->format('M Y') }}</span>
                                        </div>

                                        @if($cert->credential_url)
                                        <a href="{{ $cert->credential_url }}" target="_blank" class="cert-verify-btn">
                                            <span>Check Link</span>
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        @endif
                                    </div>
                                </div>
                                <div class="cert-hover-glow"></div>
                            </div>
                            @empty
                            <div class="cert-public-empty">
                                <i class="fas fa-shield-alt mb-3 opacity-20 fa-3x"></i>
                                <p>Sertifikasi kompetensi sedang dalam tahap verifikasi dokumen.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="yota-public-nf-showcase">
                        <div class="nf-public-header-area">
                            <h2 class="nf-main-heading">Lifelong <span class="text-lemon-highlight">Learning.</span></h2>
                            <p class="nf-lead-text">Terus berkembang melalui berbagai pelatihan teknis, kursus bahasa, dan sertifikasi profesional.</p>
                        </div>

                        <div class="nf-public-grid">
                            @forelse($user->nonFormalEducations as $non)
                            <div class="nf-public-card">
                                <div class="nf-card-inner">
                                    <div class="nf-visual-side">
                                        <div class="nf-icon-box-public">
                                            <i class="fas fa-award"></i>
                                        </div>
                                    </div>

                                    <div class="nf-content-side">
                                        <div class="nf-year-badge">{{ $non->completion_year }}</div>
                                        <h4 class="nf-public-course">{{ $non->course_name }}</h4>
                                        <p class="nf-public-provider">
                                            <i class="fas fa-check-circle me-1 text-lemon-yota"></i> {{ $non->provider }}
                                        </p>
                                    </div>
                                </div>

                                <div class="nf-corner-glow"></div>
                            </div>
                            @empty
                            <div class="nf-public-empty">
                                <p>Riwayat pelatihan sedang dalam tahap verifikasi dokumen.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 5. CONNECT --}}
    <section id="contact">
        <div class="yota-public-social-showcase">
            <div class="social-container-safe">
                <div class="social-public-header-area">
                    <h2 class="social-main-heading">Digital <br> <span class="text-lemon-highlight">Ecosystem.</span></h2>
                    <p class="social-lead-text">Hubungkan kolaborasi dan jelajahi jejak digital saya melalui berbagai platform profesional.</p>
                </div>

                <div class="social-public-grid">
                    @forelse($user->socialLinks as $social)
                    <a href="{{ $social->url }}" target="_blank" class="social-public-anchor">
                        <div class="social-public-card">
                            <div class="social-icon-wrapper-public">
                                <i class="{{ $social->bootstrap_icon }}"></i>
                            </div>
                            <div class="social-text-wrapper">
                                <span class="social-platform-label">{{ $social->platform_name }}</span>
                                <span class="social-action-text">Follow / Connect <i class="fas fa-arrow-right ms-1"></i></span>
                            </div>

                            <div class="social-hover-glow"></div>
                        </div>
                    </a>
                    @empty
                    <div class="social-public-empty">
                        <p>Saluran komunikasi digital sedang dikonfigurasi.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    /* MAIN CONTAINER */
    .yota-public-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* GLOBAL VARIABLES */
    :root {
        --y-dark: #052c24;
        --y-lemon: #BEF264;
        --y-soft: #f8fafc;
        --y-border: rgba(5, 44, 36, 0.05);
        --y-gray: #f8fafc;
    }

    /* SECTION SPACING */
    section {
        margin-bottom: 120px;
        scroll-margin-top: 30px;
    }

    section:last-child {
        margin-bottom: 60px;
    }

    /* COMMON HEADING STYLES */
    .as-main-heading,
    .port-main-heading,
    .org-main-heading,
    .ach-main-heading,
    .edu-main-heading,
    .cert-main-heading,
    .nf-main-heading,
    .social-main-heading {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 800;
        color: var(--y-dark);
        line-height: 1.1;
        letter-spacing: -2px;
        margin-bottom: 20px;
    }

    .text-lemon-highlight {
        color: var(--y-lemon);
        background: var(--y-dark);
        padding: 0 15px;
        border-radius: 15px;
        display: inline-block;
    }

    /* COMMON LEAD TEXT */
    .as-lead-text,
    .port-lead-text,
    .org-lead-text,
    .ach-lead-text,
    .edu-lead-text,
    .cert-lead-text,
    .nf-lead-text,
    .social-lead-text {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        font-weight: 500;
        line-height: 1.6;
    }

    /* EMPTY STATES */
    .as-public-empty,
    .port-public-empty,
    .org-public-empty,
    .ach-public-empty,
    .edu-public-empty,
    .cert-public-empty,
    .nf-public-empty,
    .social-public-empty {
        text-align: center;
        padding: 40px;
        background: var(--y-soft);
        border-radius: 30px;
        color: #94a3b8;
        grid-column: 1 / -1;
    }

    /* RESPONSIVE BREAKPOINTS */
    @media (max-width: 992px) {
        .yota-public-container {
            padding: 0 15px;
        }

        section {
            margin-bottom: 80px;
        }

        .row.g-4 {
            margin: 0;
        }
    }

    @media (max-width: 768px) {
        .yota-public-container {
            padding: 0 12px;
        }

        .as-main-heading,
        .port-main-heading,
        .org-main-heading,
        .ach-main-heading,
        .edu-main-heading,
        .cert-main-heading,
        .nf-main-heading,
        .social-main-heading {
            font-size: 2.5rem;
        }

        section {
            margin-bottom: 60px;
        }

        /* Force single column layouts on mobile */
        .as-public-grid,
        .port-public-grid,
        .org-public-grid,
        .ach-public-grid,
        .cert-public-grid,
        .nf-public-grid,
        .social-public-grid {
            grid-template-columns: 1fr !important;
        }

        .edu-public-item {
            flex-direction: column;
            gap: 20px;
        }

        .edu-public-indicator {
            flex-direction: row;
            width: 100%;
        }

        .edu-public-dot {
            margin-right: 20px;
        }

        .edu-public-line {
            width: 100%;
            height: 2px;
            margin-top: 0;
        }
    }

    /* Keep all existing component-specific styles below this line */
    /* VERSATILE CAPABILITIES */
    .yota-public-as-showcase {
        width: 100%;
    }

    .as-public-header-area {
        margin-bottom: 40px;
    }

    .as-public-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
    }

    .as-public-pill {
        display: flex;
        align-items: center;
        background: #ffffff;
        border: 1px solid rgba(5, 44, 36, 0.08);
        padding: 12px 24px 12px 12px;
        border-radius: 100px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: default;
        position: relative;
    }

    .as-public-pill:hover {
        border-color: var(--y-dark);
        transform: scale(1.05) rotate(-1deg);
        box-shadow: 0 15px 30px rgba(5, 44, 36, 0.05);
        background: var(--y-soft);
    }

    .as-public-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 16px;
        transition: 0.3s;
    }

    .as-public-pill:hover .as-public-icon {
        transform: rotate(360deg);
        background: var(--y-dark) !important;
        color: var(--y-lemon) !important;
    }

    .as-public-info {
        display: flex;
        flex-direction: column;
    }

    .as-public-name {
        font-size: 15px;
        font-weight: 700;
        color: var(--y-dark);
        line-height: 1.2;
    }

    .as-public-level {
        font-size: 10px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 2px;
    }

    /* INNOVATION PORTFOLIO */
    .yota-public-port-showcase {
        width: 100%;
    }

    .port-public-header-area {
        margin-bottom: 60px;
    }

    .port-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .port-item-card {
        background: #ffffff;
        border-radius: 40px;
        overflow: hidden;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .port-item-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.08);
        border-color: var(--y-lemon);
    }

    .port-card-visual {
        height: 180px;
        background: var(--y-dark);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .port-icon-main {
        font-size: 60px;
        color: var(--y-lemon);
        opacity: 0.8;
        transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .port-item-card:hover .port-icon-main {
        transform: scale(1.3) rotate(-8deg);
        opacity: 1;
    }

    .port-visual-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        padding: 24px;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        z-index: 2;
    }

    .port-year-tag {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: #fff;
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 800;
        border: 1px solid rgba(255,255,255,0.15);
    }

    .port-link-circle {
        width: 44px; height: 44px;
        background: var(--y-lemon);
        color: var(--y-dark);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        transform: translateY(-20px) scale(0.5);
        opacity: 0;
    }

    .port-item-card:hover .port-link-circle {
        transform: translateY(0) scale(1);
        opacity: 1;
    }

    .port-card-details {
        padding: 35px;
        flex-grow: 1;
    }

    .port-type-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 12px;
        font-size: 9px;
        font-weight: 800;
        letter-spacing: 1px;
        background: var(--t-bg);
        color: var(--t-color);
        margin-bottom: 20px;
    }

    .port-project-title {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.4rem;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .port-role-pill {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
        display: flex;
        align-items: center;
        margin-bottom: 18px;
    }

    .port-project-desc {
        font-size: 14px;
        line-height: 1.7;
        color: #64748b;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .port-hover-line {
        position: absolute;
        bottom: 0; left: 0; width: 0%; height: 6px;
        background: var(--y-lemon);
        transition: 0.5s;
    }

    .port-item-card:hover .port-hover-line {
        width: 100%;
    }

    /* LEADERSHIP & NGO */
    .yota-public-org-showcase {
        width: 100%;
    }

    .text-stroke {
        color: transparent;
        -webkit-text-stroke: 1.5px var(--y-dark);
        opacity: 0.3;
    }

    .org-public-header-area {
        margin-bottom: 60px;
    }

    .org-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
        gap: 30px;
    }

    .org-public-card {
        background: #ffffff;
        border-radius: 40px;
        padding: 40px;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .org-public-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .org-card-top {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 30px;
    }

    .org-brand-box {
        width: 80px;
        height: 80px;
        background: #fff;
        padding: 10px;
        border-radius: 24px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        border: 1px solid #f1f5f9;
    }

    .org-public-logo {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 15px;
    }

    .org-status-chip {
        background: var(--y-gray);
        color: var(--y-dark);
        font-size: 10px;
        font-weight: 800;
        padding: 8px 16px;
        border-radius: 100px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .org-public-name {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.5rem;
        margin-bottom: 5px;
    }

    .org-public-position {
        color: #94a3b8;
        font-weight: 700;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 25px;
    }

    .org-public-contribution {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        position: relative;
        padding-left: 20px;
        border-left: 3px solid var(--y-lemon);
    }

    .org-card-footer-line {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0%;
        height: 6px;
        background: var(--y-lemon);
        transition: 0.5s;
    }

    .org-public-card:hover .org-card-footer-line {
        width: 100%;
    }

    /* ACHIEVEMENTS */
    .yota-public-ach-showcase {
        width: 100%;
    }

    .ach-public-header-area {
        margin-bottom: 60px;
    }

    .ach-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 30px;
    }

    .ach-public-card {
        background: #ffffff;
        border: 1px solid var(--y-border);
        border-radius: 40px;
        padding: 45px;
        position: relative;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: flex;
        flex-direction: column;
    }

    .ach-public-card:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.08);
        border-color: var(--y-lemon);
    }

    .ach-public-level {
        display: inline-flex;
        align-items: center;
        background: color-mix(in srgb, var(--ach-accent), transparent 90%);
        color: var(--ach-accent);
        padding: 6px 16px;
        border-radius: 100px;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 25px;
        width: fit-content;
    }

    .ach-public-award-name {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.5rem;
        line-height: 1.2;
        margin-bottom: 12px;
        letter-spacing: -0.5px;
    }

    .ach-public-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 25px;
    }

    .ach-meta-item {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .ach-public-summary {
        font-size: 14px;
        line-height: 1.7;
        color: #475569;
        font-weight: 500;
        padding-top: 20px;
        border-top: 1px solid #f1f5f9;
    }

    .ach-card-decorator {
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        clip-path: polygon(100% 0, 0 0, 100% 100%);
        opacity: 0.1;
        transition: 0.5s;
    }

    .ach-public-card:hover .ach-card-decorator {
        opacity: 0.4;
        transform: scale(1.5);
    }

    /* EDUCATION */
    .yota-public-edu-showcase {
        width: 100%;
    }

    .edu-public-header-area {
        margin-bottom: 60px;
    }

    .edu-public-timeline {
        position: relative;
        padding-left: 10px;
    }

    .edu-public-item {
        display: flex;
        gap: 40px;
        margin-bottom: 50px;
        position: relative;
    }

    .edu-public-indicator {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }

    .edu-public-dot {
        width: 20px;
        height: 20px;
        background: #ffffff;
        border: 5px solid var(--y-dark);
        border-radius: 50%;
        z-index: 2;
        transition: 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .edu-public-item:hover .edu-public-dot {
        border-color: var(--y-lemon);
        transform: scale(1.3);
        box-shadow: 0 0 15px rgba(190, 242, 100, 0.5);
    }

    .edu-public-line {
        width: 2px;
        flex-grow: 1;
        background: #e2e8f0;
        margin-top: 10px;
    }

    .edu-public-item:last-child .edu-public-line {
        display: none;
    }

    .edu-public-card {
        background: #ffffff;
        border: 1px solid rgba(5, 44, 36, 0.05);
        padding: 40px;
        border-radius: 40px;
        flex-grow: 1;
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .edu-public-item:hover .edu-public-card {
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.04);
        border-color: rgba(5, 44, 36, 0.1);
        transform: translateX(15px);
    }

    .edu-public-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .edu-public-period {
        font-size: 13px;
        font-weight: 700;
        color: #94a3b8;
        letter-spacing: 0.5px;
    }

    .edu-public-tag-current {
        background: var(--y-lemon);
        color: var(--y-dark);
        font-size: 10px;
        font-weight: 800;
        padding: 5px 12px;
        border-radius: 100px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .edu-public-inst {
        color: var(--y-dark);
        font-weight: 800;
        font-size: 1.6rem;
        margin-bottom: 5px;
        letter-spacing: -1px;
    }

    .edu-public-degree {
        font-size: 16px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 25px;
    }

    .text-dark-yota {
        color: var(--y-dark);
        font-weight: 700;
    }

    .edu-public-achievements {
        background: var(--y-gray);
        padding: 25px;
        border-radius: 25px;
        border: 1px solid rgba(0,0,0,0.02);
        position: relative;
    }

    .ach-label-tiny {
        font-size: 9px;
        font-weight: 800;
        color: #94a3b8;
        margin-bottom: 10px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
    }

    .ach-text-small {
        font-size: 14px;
        line-height: 1.7;
        color: #475569;
        margin-bottom: 0;
        font-weight: 500;
    }

    /* CERTIFICATIONS */
    .yota-public-cert-showcase {
        width: 100%;
    }

    .cert-public-header-area {
        margin-bottom: 60px;
    }

    .cert-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
        gap: 25px;
    }

    .cert-public-card {
        background: #ffffff;
        border: 1px solid var(--y-border);
        border-radius: 40px;
        padding: 35px;
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .cert-public-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 30px 60px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .cert-status-wrapper {
        position: absolute;
        top: 35px;
        right: 35px;
    }

    .cert-badge-status {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        padding: 6px 14px;
        border-radius: 100px;
        letter-spacing: 1px;
    }

    .cert-badge-status.active {
        background: rgba(16, 185, 129, 0.1);
        color: #10b981;
    }

    .cert-badge-status.expired {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
    }

    .cert-main-content {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        margin-right: 60px;
    }

    .cert-visual-icon {
        width: 56px;
        height: 56px;
        background: var(--y-dark);
        color: var(--y-lemon);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        transition: 0.3s;
    }

    .cert-public-card:hover .cert-visual-icon {
        transform: rotate(-10deg) scale(1.1);
    }

    .cert-public-name {
        font-weight: 800;
        color: var(--y-dark);
        margin: 0;
        line-height: 1.3;
        font-size: 1.2rem;
        letter-spacing: -0.5px;
    }

    .cert-public-org {
        font-size: 14px;
        color: #64748b;
        font-weight: 600;
        margin-top: 4px;
    }

    .cert-footer-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 20px;
        border-top: 2px dashed #f1f5f9;
    }

    .cert-date-info {
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
    }

    .cert-verify-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 800;
        color: var(--y-dark);
        text-decoration: none;
        transition: 0.2s;
        border-bottom: 2px solid var(--y-lemon);
    }

    .cert-verify-btn:hover {
        color: #000;
        padding-right: 5px;
    }

    .cert-hover-glow {
        position: absolute;
        width: 100px;
        height: 100px;
        background: var(--y-lemon);
        filter: blur(50px);
        opacity: 0;
        bottom: -50px;
        left: -50px;
        transition: 0.5s;
    }

    .cert-public-card:hover .cert-hover-glow {
        opacity: 0.2;
    }

    /* NON-FORMAL EDUCATION */
    .yota-public-nf-showcase {
        width: 100%;
    }

    .nf-public-header-area {
        margin-bottom: 50px;
    }

    .nf-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
    }

    .nf-public-card {
        background: #ffffff;
        border-radius: 35px;
        padding: 30px;
        border: 1px solid rgba(5, 44, 36, 0.05);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .nf-public-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(5, 44, 36, 0.06);
        border-color: var(--y-lemon);
    }

    .nf-card-inner {
        display: flex;
        align-items: center;
        gap: 20px;
        position: relative;
        z-index: 2;
    }

    .nf-icon-box-public {
        width: 54px;
        height: 54px;
        background: var(--y-dark);
        color: var(--y-lemon);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        transition: 0.3s;
    }

    .nf-public-card:hover .nf-icon-box-public {
        transform: rotate(-10deg);
        background: var(--y-lemon);
        color: var(--y-dark);
    }

    .nf-year-badge {
        font-size: 10px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 4px;
    }

    .nf-public-course {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.1rem;
        margin-bottom: 2px;
        line-height: 1.3;
    }

    .nf-public-provider {
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
        margin: 0;
    }

    .text-lemon-yota {
        color: var(--y-lemon);
    }

    .nf-corner-glow {
        position: absolute;
        width: 100px;
        height: 100px;
        background: var(--y-lemon);
        filter: blur(40px);
        opacity: 0;
        top: -50px;
        right: -50px;
        transition: 0.5s;
    }

    .nf-public-card:hover .nf-corner-glow {
        opacity: 0.2;
    }

    /* SOCIAL LINKS */
    .yota-public-social-showcase {
        width: 100%;
        padding: 20px 0;
    }

    .social-container-safe {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 10px;
    }

    .social-public-header-area {
        margin-bottom: 50px;
        position: relative;
    }

    .social-public-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 25px;
    }

    .social-public-anchor {
        text-decoration: none !important;
        color: inherit;
    }

    .social-public-card {
        background: #ffffff;
        border-radius: 30px;
        padding: 24px;
        border: 1.5px solid rgba(5, 44, 36, 0.08);
        display: flex;
        align-items: center;
        gap: 18px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        overflow: hidden;
    }

    .social-public-card:hover {
        transform: translateY(-10px) scale(1.02);
        border-color: var(--y-lemon);
        box-shadow: 0 25px 50px rgba(5, 44, 36, 0.08);
    }

    .social-icon-wrapper-public {
        width: 54px;
        height: 54px;
        background: var(--y-dark);
        color: var(--y-lemon);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        transition: 0.3s;
        z-index: 2;
        flex-shrink: 0;
    }

    .social-public-card:hover .social-icon-wrapper-public {
        background: var(--y-lemon);
        color: var(--y-dark);
        transform: rotate(-10deg);
    }

    .social-text-wrapper {
        display: flex;
        flex-direction: column;
        z-index: 2;
        overflow: hidden;
    }

    .social-platform-label {
        font-weight: 800;
        color: var(--y-dark);
        font-size: 1.05rem;
        margin-bottom: 2px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .social-action-text {
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: 0.3s;
    }

    .social-hover-glow {
        position: absolute;
        width: 120px;
        height: 120px;
        background: var(--y-lemon);
        filter: blur(60px);
        opacity: 0;
        top: -30px;
        right: -30px;
        transition: 0.6s;
    }

    .social-public-card:hover .social-hover-glow {
        opacity: 0.25;
    }
</style>

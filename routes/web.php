<?php

use App\Http\Controllers\ProfileController;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Route;

// 1. PUBLIC AREA
Route::get('/', function () {
    $heroSlides = null;
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('hero_slides')) {
            $heroSlides = \App\Models\HeroSlide::active()->ordered()->get();
        }
    } catch (\Throwable $e) {
        $heroSlides = collect();
    }
    return view('public.index', compact('heroSlides'));
})->name('home');
Route::prefix('tentang-kami')->name('public.tentangkami.')->group(function () {

    Route::get('/profil', fn () =>
        view('public.tentangkami.profil')
    )->name('profil');


    Route::get('/kontak', fn () =>
        view('public.tentangkami.kontak')
    )->name('kontak');


    Route::get('/visi', fn () =>
        view('public.tentangkami.visi')
    )->name('visi');

    Route::get('/legalitas', fn () =>
        view('public.tentangkami.legalitas')
    )->name('legalitas');

    Route::get('/sejarah', fn () =>
        view('public.tentangkami.sejarah')
    )->name('sejarah');



});

use App\Http\Controllers\Public\PublicPublicationController;

// Grouping Route Publikasi
Route::prefix('publications')->name('public.publications.')->group(function () {
    // Halaman List Publikasi (index)
    Route::get('/', [PublicPublicationController::class, 'index'])->name('index');

    // Halaman Detail Publikasi (show)
    Route::get('/{slug}', [PublicPublicationController::class, 'show'])->name('show');

    // Tracking Share (AJAX)
    Route::post('/{publication}/track-share', [PublicPublicationController::class, 'trackShare'])->name('track-share');
});


use App\Http\Controllers\Public\PubKajianIlmiahController;

// Rute Kajian Ilmiah (Scientific Articles)
Route::prefix('kajian-ilmiah')->name('public.kajianilmiah.')->group(function () {
    Route::get('/', [PubKajianIlmiahController::class, 'index'])->name('index');
    Route::get('/{slug}', [PubKajianIlmiahController::class, 'show'])->name('show');
});

Route::get('/publications', [PublicPublicationController::class, 'index'])->name('public.publications.index');
Route::get('/publications/{publication:slug}', [PublicPublicationController::class, 'show'])->name('public.publications.show');
Route::post('/publications/{publication:slug}/share', [PublicPublicationController::class, 'trackShare'])->name('public.publications.share');

// 6 Pilar Program (Impact Areas)
Route::prefix('impact-areas')->name('public.impact-areas.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Public\PublicImpactAreaController::class, 'index'])->name('index');
    Route::get('/{slug}', [\App\Http\Controllers\Public\PublicImpactAreaController::class, 'show'])->name('show');
});

use App\Http\Controllers\Public\PublicProgramController;
// Grouping Route Publik (Tanpa Middleware Auth)
Route::name('public.')->group(function () {
    Route::get('/programs', [PublicProgramController::class, 'index'])
         ->name('programs.index');
    Route::get('/programs/{slug}', [PublicProgramController::class, 'show'])
         ->name('programs.show');
});
use App\Http\Controllers\Public\PublicSocialProductController;
// Rute untuk publik (Tanpa middleware auth)
Route::get('/innovation', [PublicSocialProductController::class, 'index'])->name('public.products.index');
Route::get('/innovation/{product:slug}', [PublicSocialProductController::class, 'show'])->name('public.products.show');
use App\Http\Controllers\Public\PublicPartnerController;

Route::get('/partners', [PublicPartnerController::class, 'index'])->name('public.partners.index');


use App\Http\Controllers\Public\PublicReviewController;
Route::get('/testimonials', [PublicReviewController::class, 'index'])->name('public.reviews.index');
Route::post('/testimonials/submit', [PublicReviewController::class, 'store'])->name('public.reviews.store');

// SITEMAP XML (Technical SEO)
Route::get('/sitemap.xml', function () {
    $path = public_path('sitemap.xml');
    if (file_exists($path)) {
        return response()->file($path, ['Content-Type' => 'application/xml']);
    }
    abort(404);
})->name('sitemap');








use App\Http\Controllers\DocPublicationController;

// =============================================================
// ROUTE SISI ADMIN (CRUD)
// =============================================================
Route::prefix('admin/omc/docs')->as('omc.docs.')->middleware(['auth'])->group(function () {

    Route::get('/', [DocPublicationController::class, 'index'])->name('index');           // List Table
    Route::get('/create', [DocPublicationController::class, 'create'])->name('create');   // Form Tambah
    Route::post('/store', [DocPublicationController::class, 'store'])->name('store');     // Proses Simpan

    Route::get('/{doc}/edit', [DocPublicationController::class, 'edit'])->name('edit');   // Form Edit
    Route::put('/{doc}', [DocPublicationController::class, 'update'])->name('update');    // Proses Update
    Route::delete('/{doc}', [DocPublicationController::class, 'destroy'])->name('destroy'); // Proses Hapus
});



// =============================================================
// ROUTE SISI PUBLIK
// =============================================================
// URL: domain.com/doc-center
Route::get('/doc-center', [DocPublicationController::class, 'publicIndex'])->name('public.docs.index');

use App\Http\Controllers\OMC\ImpactReportController;
use App\Http\Controllers\OMC\PartnerController;
Route::prefix('admin/omc')->as('omc.')->middleware('auth')->group(function () {
    // Route CRUD lengkap (index, create, store, edit, update, destroy)
    Route::resource('impact', ImpactReportController::class);
        Route::resource('partners', PartnerController::class);
});


use App\Http\Controllers\OMC\AccReviewController;
Route::middleware(['auth'])->prefix('omc')->name('omc.')->group(function () {
    Route::get('/reviews', [AccReviewController::class, 'index'])->name('reviews.index');
    Route::patch('/reviews/{review}/toggle', [AccReviewController::class, 'togglePublish'])->name('reviews.toggle');
    Route::delete('/reviews/{review}', [AccReviewController::class, 'destroy'])->name('reviews.destroy');

});
use App\Http\Controllers\OMC\GalleryController;

Route::middleware(['auth'])->prefix('omc')->name('omc.')->group(function () {
    Route::resource('galleries', GalleryController::class);
});

use App\Http\Controllers\Public\PublicGalleryController;
Route::get('/gallery', [PublicGalleryController::class, 'index'])->name('public.gallery.index');
Route::get('/gallery/{slug}', [PublicGalleryController::class, 'show'])->name('public.gallery.show');



use App\Http\Controllers\Public\PubImpactController;
// Grouping untuk Public Impact
Route::prefix('impact')->group(function () {
    // Halaman daftar semua laporan: domain.com/impact
    Route::get('/', [PubImpactController::class, 'index'])->name('public.impact.index');

    // Halaman detail laporan: domain.com/impact/judul-laporan
    Route::get('/{slug}', [PubImpactController::class, 'show'])->name('public.impact.show');
});
use App\Http\Controllers\OMC\CampaignController;
Route::prefix('admin/omc')->as('omc.')->middleware(['auth'])->group(function () {
    // Route Resource untuk CRUD Campaign
    Route::resource('campaign', CampaignController::class);
});

use App\Http\Controllers\OMC\SocialProductController;
Route::prefix('omc')->name('omc.')->group(function () {
    // Resource route untuk produk inovasi sosial
    Route::resource('products', SocialProductController::class)->parameters([
        'products' => 'product' // Menyesuaikan binding $product di Controller
    ]);

});
// 2. REDIRECT DASHBOARD (Jalur Tengah)
// Fungsi ini mengarahkan user ke dashboard yang sesuai role-nya saat akses URL /dashboard
// 2. REDIRECT DASHBOARD (Jalur Tengah)
// 2. DASHBOARD & ROLE PROTECTION (Butuh login)

Route::get('lang/{lang}', [App\Http\Controllers\LanguageController::class, 'switch'])->name('lang.switch');
Route::middleware(['auth', 'verified'])->group(function () {

    // 1. Jalur tengah untuk redirect berdasarkan role
    Route::get('/dashboard', function () {
        $role = auth()->user()->role->value;
        return redirect()->route($role . '.dashboard');
    })->name('dashboard');

    // 2. Group yang mewajibkan profil lengkap (DIKUNCI OLEH MIDDLEWARE)
    Route::middleware(['profile.completed'])->group(function () {

        foreach (UserRole::cases() as $role) {
            Route::middleware(['role:' . $role->value])
                ->prefix($role->value)
                ->name($role->value . '.')
                ->group(function () use ($role) {

                    // Perbaikan: Tambahkan use ($role) di fungsi closure route
                    Route::get('/dashboard', function () use ($role) {
                        return view($role->value . '.dashboard');
                    })->name('dashboard');

                    // Route kerja divisi/proyek YOTA lainnya nanti masuk di sini
                });
        }
    });
});

// 3. PROFILE AREA (Terbuka untuk auth user agar bisa melengkapi data)
Route::middleware('auth')->group(function () {
    // Menampilkan halaman pengaturan profil
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.complete');

    // Proses update data (Gunakan PATCH untuk update parsial)
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // Proses hapus akun
    Route::delete('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Public\PubCampaignController;
// Route untuk Crowdfunding Publik
Route::prefix('donasi')->group(function () {
    Route::get('/', [PubCampaignController::class, 'index'])->name('public.campaign.index');
    Route::get('/{slug}', [PubCampaignController::class, 'show'])->name('public.campaign.show');
});

Route::get('/profile/complete', [ProfileController::class, 'edit'])->name('profile.complete');

    // Jalur untuk proses update data (Patch)

    // Jalur untuk hapus akun (Delete)
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// routes/web.php
Route::post('/donasi/checkout/{campaign:slug}', [App\Http\Controllers\Public\DonationController::class, 'checkout'])->name('public.donation.checkout');

    // ADMIN UTAMAMAAA
Route::middleware(['auth', 'role:admin', 'profile.completed'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

    // CRUD User Lengkap
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
});

use App\Http\Controllers\OMC\ProgramController;
// Grouping khusus untuk area Admin OMC
Route::middleware(['auth', 'verified', 'role:omc']) // Pastikan user login & memiliki role OMC
    ->prefix('omc')
    ->name('omc.')
    ->group(function () {
        Route::resource('programs', ProgramController::class);
        Route::patch('programs/{program}/update-status', [ProgramController::class, 'updateStatus'])
             ->name('programs.update-status');

    });




//PUSAT INFORMASI DAN KOMUNIKASI OMC

use App\Http\Controllers\OMC\PublicationController;

// Grouping untuk Admin OMC
Route::middleware(['auth', 'verified'])->prefix('admin/omc')->name('omc.')->group(function () {
    // Dashboard & List Berita
    Route::get('/', [PublicationController::class, 'index'])->name('index');

    // SMART UNIVERSAL CONTENT PUBLISHER & AI WORKFLOW
    Route::get('/publish', [\App\Http\Controllers\OMC\QuickPublishController::class, 'index'])->name('quick_publish.index');
    Route::get('/quick-publish', [\App\Http\Controllers\OMC\QuickPublishController::class, 'index']);
    Route::post('/publish/store', [\App\Http\Controllers\OMC\QuickPublishController::class, 'store'])->name('quick_publish.store');

    // Tambah Publikasi Baru
    Route::get('/create', [PublicationController::class, 'create'])->name('create');
    Route::get('/publications/create', [PublicationController::class, 'create'])->name('publications.create');
    Route::post('/store', [PublicationController::class, 'store'])->name('store');

    // Edit & Update
    Route::get('/{publication}/edit', [PublicationController::class, 'edit'])->name('edit');
    Route::get('/publications/{publication}/edit', [PublicationController::class, 'edit'])->name('publications.edit');
    Route::put('/{publication}', [PublicationController::class, 'update'])->name('update');
    Route::delete('/{publication}', [PublicationController::class, 'destroy'])->name('destroy');

    // Hero Carousel Slider Banner (Pertamina Style)
    Route::resource('hero-slides', \App\Http\Controllers\OMC\HeroSlideController::class)->parameters([
        'hero-slides' => 'heroSlide'
    ]);
    Route::patch('hero-slides/{heroSlide}/toggle', [\App\Http\Controllers\OMC\HeroSlideController::class, 'toggleStatus'])->name('hero-slides.toggle');

    // 6 Pilar Program (Impact Areas) Admin
    Route::resource('impact-areas', \App\Http\Controllers\OMC\ImpactAreaController::class);

    // AI Translation & Assistant Endpoints
    Route::post('/ai/translate', [\App\Http\Controllers\OMC\AiAssistantController::class, 'translate'])->name('ai.translate');
    Route::post('/ai/seo', [\App\Http\Controllers\OMC\AiAssistantController::class, 'generateSeo'])->name('ai.seo');
    Route::post('/ai/assist', [\App\Http\Controllers\OMC\AiAssistantController::class, 'assist'])->name('ai.assist');

    // Detail Berita (WAJIB di paling bawah agar tidak menabrak rute statis /publish atau /create)
    Route::get('/{publication:slug}', [PublicationController::class, 'show'])->name('show');
});
use App\Http\Controllers\OMC\ScientificArticleController;
Route::middleware(['auth'])->group(function () {
    Route::get('omc/scientific', [ScientificArticleController::class, 'index'])->name('omc.scientific.index');
    Route::get('omc/scientific/create', [ScientificArticleController::class, 'create'])->name('omc.scientific.create');
    Route::post('omc/scientific/store', [ScientificArticleController::class, 'store'])->name('omc.scientific.store');
    Route::get('omc/scientific/{article}/edit', [ScientificArticleController::class, 'edit'])->name('omc.scientific.edit');
    Route::put('omc/scientific/{article}', [ScientificArticleController::class, 'update'])->name('omc.scientific.update');
    Route::delete('omc/scientific/{article}', [ScientificArticleController::class, 'destroy'])->name('omc.scientific.destroy');
    Route::get('omc/scientific/{article:slug}', [ScientificArticleController::class, 'show'])->name('omc.scientific.show');
});




///ADMIN ROUTEEE
use App\Http\Controllers\Admin\AdminDivisionController;
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('divisions', AdminDivisionController::class);
    Route::post('divisions/{division}/add-members', [AdminDivisionController::class, 'addMembers'])->name('divisions.add-members');
});
use App\Http\Controllers\Public\TeamStructureController;
Route::get('/our-team', [TeamStructureController::class, 'index'])->name('public.team');

use App\Http\Controllers\CommentController;
// Pastikan rute ini bisa diakses publik
Route::post('/publications/{publication}/comments', [CommentController::class, 'store'])->name('comments.store');

/////direktur route
use App\Http\Controllers\Direktur\DirAgendaController;
use App\Http\Controllers\Direktur\DirAnnouncementController;
use App\Http\Controllers\Direktur\DirTaskController;
use App\Http\Controllers\Direktur\DirEvaluationController;
use App\Http\Controllers\Direktur\DirDelegationController;
use App\Http\Controllers\Direktur\DirWorkspaceController;
    Route::middleware(['auth', 'role:direktur'])->prefix('direktur')->name('direktur.')->group(function () {
    Route::resource('agenda', DirAgendaController::class);
    Route::get('agenda/{id}/report', [DirAgendaController::class, 'report'])->name('agenda.report');
    Route::patch('agenda/presence/{id}/update', [DirAgendaController::class, 'updatePresence'])->name('agenda.updatePresence');
});
use App\Http\Controllers\Direktur\DirTimelineController;
    Route::middleware(['auth', 'role:direktur'])->prefix('direktur')->name('direktur.')->group(function () {
    Route::resource('timeline', DirTimelineController::class);
    Route::patch('timeline-stage/{stage}', [DirTimelineController::class, 'updateStage'])->name('timeline.stage.update');
    Route::post('timeline/{timeline}/add-stage', [DirTimelineController::class, 'addStage'])->name('timeline.addStage');
    Route::resource('announcement', DirAnnouncementController::class);
    Route::patch('announcement/{announcement}/toggle', [DirAnnouncementController::class, 'toggleStatus'])->name('announcement.toggle');
    Route::resource('task', DirTaskController::class);
    Route::patch('task/{task}/approve', [DirTaskController::class, 'approve'])->name('task.approve');
    Route::resource('evaluation', DirEvaluationController::class);
    Route::resource('delegation', DirDelegationController::class);
Route::patch('delegation/{delegation}/complete', [DirDelegationController::class, 'complete'])->name('delegation.complete');
Route::resource('workspace', DirWorkspaceController::class);
});



///FITUR UMUM
use App\Http\Controllers\General\GenWorkspaceController;

Route::middleware(['auth'])->prefix('general')->name('general.')->group(function () {
    Route::get('/workspaces', [GenWorkspaceController::class, 'index'])->name('workspace.index');
    Route::get('/workspace/{workspace}', [GenWorkspaceController::class, 'show'])->name('workspace.show');
    Route::get('/task/{task}', [GenWorkspaceController::class, 'showTask'])->name('workspace.task.show');
    Route::patch('/task/{task}/status', [GenWorkspaceController::class, 'updateTaskStatus'])->name('workspace.task.update');
    Route::post('/task/{task}/comment', [GenWorkspaceController::class, 'storeComment'])->name('workspace.task.comment');
    Route::patch('/workspace/{workspace}/toggle-priority', [GenWorkspaceController::class, 'togglePriority'])->name('workspace.toggle-priority');
    Route::patch('/workspace/{workspace}/update-status', [GenWorkspaceController::class, 'updateStatus'])->name('workspace.update-status');
    Route::get('/workspace/{workspace_id}/task/create', [GenWorkspaceController::class, 'createTask'])->name('workspace.task.create');
    Route::post('/workspace/task/store', [GenWorkspaceController::class, 'storeTask'])->name('workspace.task.store');
});
Route::middleware(['auth', 'role:direktur'])->prefix('direktur')->name('direktur.')->group(function () {
    // Route Switcher
    Route::get('/switch-header/{mode}', [App\Http\Controllers\Direktur\DirDashboardController::class, 'switchHeaderMode'])->name('header.switch');
});


use App\Http\Controllers\General\GenTodoController;

Route::middleware('auth')->prefix('general')->name('general.')->group(function () {
    Route::get('/todos', [GenTodoController::class, 'index'])->name('todo.index');
    Route::post('/todos', [GenTodoController::class, 'store'])->name('todo.store');
    Route::patch('/todos/{todo}/toggle', [GenTodoController::class, 'toggle'])->name('todo.toggle');
    Route::delete('/todos/{todo}', [GenTodoController::class, 'destroy'])->name('todo.destroy');
});


use App\Http\Controllers\General\GenIdentityController;
use App\Http\Controllers\General\GenCvController;
Route::middleware(['auth'])->prefix('general')->name('general.')->group(function () {
    // Identity Routes
    Route::get('/identity', [GenIdentityController::class, 'index'])->name('identity.index');
    Route::post('/identity', [GenIdentityController::class, 'store'])->name('identity.store');
    // Dynamic CV Routes (Skills, Experience, Achievement, Portfolio, Organization)
    Route::get('/cv/{type}', [GenCvController::class, 'list'])->name('cv.list');
    Route::post('/cv/{type}', [GenCvController::class, 'store'])->name('cv.store');
    Route::delete('/cv/{type}/{id}', [GenCvController::class, 'destroy'])->name('cv.destroy');
});


use App\Http\Controllers\Kabid\KabTeamManagementController;
Route::middleware(['auth'])->prefix('kabid')->name('kabid.')->group(function () {
    Route::get('/teams', [KabTeamManagementController::class, 'index'])->name('teams.index');
    Route::post('/teams', [KabTeamManagementController::class, 'store'])->name('teams.store');
    Route::post('/teams/{team}/assign', [KabTeamManagementController::class, 'assignMember'])->name('teams.assign');
    Route::delete('/teams/{team}', [KabTeamManagementController::class, 'destroy'])->name('teams.destroy');
    Route::post('/teams/unassign/{user}', [KabTeamManagementController::class, 'unassignMember'])->name('teams.unassign');
});
use App\Http\Controllers\Kabid\KabidTugasController;
Route::middleware(['auth'])->group(function () {
    Route::resource('kabid-tugas', KabidTugasController::class);
    Route::post('kabid-tugas/{task}/revise', [KabidTugasController::class, 'revise'])->name('kabid-tugas.revise');
    Route::post('kabid-tugas/{task}/complete', [KabidTugasController::class, 'complete'])->name('kabid-tugas.complete');
});
use App\Http\Controllers\Kabid\KabidAgendaController;
Route::middleware(['auth'])->prefix('kabid')->name('kabid.')->group(function () {
    // Route Agenda & Timeline
    Route::get('/agenda', [KabidAgendaController::class, 'index'])->name('agenda.index');
    Route::post('/agenda', [KabidAgendaController::class, 'store'])->name('agenda.store');
    Route::put('/agenda/{id}', [KabidAgendaController::class, 'update'])->name('agenda.update');
    Route::delete('/agenda/{id}', [KabidAgendaController::class, 'destroy'])->name('agenda.destroy');
});


use App\Http\Controllers\Kabid\KabidPengumumanController;
use App\Http\Controllers\Kabid\KabidDokumenController;
use App\Http\Controllers\Kabid\KabLaporanBidangController;
Route::middleware(['auth', 'role:kabid'])->prefix('kabid')->name('kabid.')->group(function () {
    // Resource Route untuk Pengumuman Internal
    Route::get('/pengumuman', [KabidPengumumanController::class, 'index'])->name('pengumuman.index');
    Route::post('/pengumuman', [KabidPengumumanController::class, 'store'])->name('pengumuman.store');
    Route::patch('/pengumuman/{id}/toggle', [KabidPengumumanController::class, 'toggleStatus'])->name('pengumuman.toggle');
    Route::delete('/pengumuman/{id}', [KabidPengumumanController::class, 'destroy'])->name('pengumuman.destroy');
    Route::resource('dokumen', KabidDokumenController::class)->except(['create', 'show', 'edit']);
    Route::resource('laporan', KabLaporanBidangController::class);

});



use App\Http\Controllers\General\GeneralDokumenController;
Route::middleware(['auth'])->prefix('dashboard')->name('general.')->group(function () {
    // Route hanya untuk melihat (Index)
    Route::get('/vault', [GeneralDokumenController::class, 'index'])->name('dokumen.index');
    Route::get('/vault/search', [GeneralDokumenController::class, 'search'])->name('dokumen.search');
});




use App\Http\Controllers\General\GenPostController;
Route::middleware(['auth'])->group(function () {
    Route::resource('gen-posts', GenPostController::class);
});

Route::get('/read/{post:slug}', [GenPostController::class, 'show'])->name('posts.read');

use App\Http\Controllers\Public\PubCeritaPribadiController;
Route::prefix('cerita')->name('public.ceritapribadi.')->group(function () {
    Route::get('/', [PubCeritaPribadiController::class, 'index'])->name('index');
    Route::get('/{slug}', [PubCeritaPribadiController::class, 'show'])->name('show');
});

use App\Http\Controllers\Direktur\DirLaporanController;
Route::middleware(['auth', 'role:direktur'])->prefix('direktur')->name('direktur.')->group(function () {
    Route::get('/laporan', [DirLaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/{id}', [DirLaporanController::class, 'show'])->name('laporan.show');
    Route::patch('/laporan/{id}/status', [DirLaporanController::class, 'updateStatus'])->name('laporan.status');
    Route::put('/laporan/{id}', [DirLaporanController::class, 'update'])->name('laporan.update');
    Route::delete('/laporan/{id}', [DirLaporanController::class, 'destroy'])->name('laporan.destroy');

});



use App\Http\Controllers\SemuaDivisi\SemDivAnnouncementController;
use App\Http\Controllers\SemuaDivisi\SemDivPresenceController;
use App\Http\Controllers\SemuaDivisi\SemDivDelegationController;
Route::middleware(['auth'])->group(function () {
    // Route untuk klik absen
    Route::get('/presence/check/{agenda_id}', [SemDivPresenceController::class, 'markAttendance'])
        ->name('presence.check');
    // Route untuk lihat daftar agenda dari sisi user
    Route::get('/my-agendas', [SemDivPresenceController::class, 'myAgendas'])
        ->name('user.agendas');

        Route::get('/bulletins', [SemDivAnnouncementController::class, 'index'])
        ->name('announcement.index');
    // Route untuk melihat detail pengumuman
    Route::get('/bulletins/{announcement}', [SemDivAnnouncementController::class, 'show'])
        ->name('announcement.show');
    Route::get('/my-mandates', [SemDivDelegationController::class, 'index'])->name('delegation.index');
    Route::get('/my-mandates/{delegation}', [SemDivDelegationController::class, 'show'])->name('delegation.show');
    Route::patch('/my-mandates/{delegation}/progress', [SemDivDelegationController::class, 'updateProgress'])->name('delegation.progress');
Route::get('/announcements/{announcement}', [SemDivAnnouncementController::class, 'show'])->name('announcements.show');

});

use App\Http\Controllers\SemuaDivisi\SemDivKabidAnnouncementController;
Route::prefix('bulletins-internal')->name('semuadivisi.kabid-announcement.')->group(function() {
    Route::get('/', [SemDivKabidAnnouncementController::class, 'index'])->name('index');
    Route::get('/{kabidPengumuman}', [SemDivKabidAnnouncementController::class, 'show'])->name('show');
});


use App\Http\Controllers\SemuaDivisi\SemDivEvaluationController;

Route::prefix('evaluation')->name('evaluation.')->group(function () {
    Route::get('/', [SemDivEvaluationController::class, 'index'])->name('index');
    Route::get('/{id}', [SemDivEvaluationController::class, 'show'])->name('show');
});

use App\Http\Controllers\SemuaDivisi\SemDivTaskController;

// Rute khusus untuk User/Semua Divisi
Route::middleware(['auth'])->prefix('my-tasks')->name('task.')->group(function () {
    Route::get('/', [SemDivTaskController::class, 'index'])->name('index');
    Route::get('/{id}', [SemDivTaskController::class, 'show'])->name('show');
    Route::patch('/{id}/submit', [SemDivTaskController::class, 'submit'])->name('submit');
});



use App\Http\Controllers\SemuaDivisi\SemDivTimelineController;

Route::prefix('project-timeline')->name('timeline.')->group(function () {
    Route::get('/', [SemDivTimelineController::class, 'index'])->name('index');
    Route::get('/{id}', [SemDivTimelineController::class, 'show'])->name('show');
});

use App\Http\Controllers\SemuaDivisi\SemDivAgendadivisiController;
Route::middleware(['auth'])->prefix('divisi-agenda')->name('divisiagenda.')->group(function () {
    Route::get('/', [SemDivAgendadivisiController::class, 'index'])->name('index');
    Route::post('/store', [SemDivAgendadivisiController::class, 'store'])->name('store');
    Route::patch('/{id}/update', [SemDivAgendadivisiController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [SemDivAgendadivisiController::class, 'destroy'])->name('destroy');
});

use App\Http\Controllers\Anggota\AgtTugasController;
Route::middleware(['auth'])->prefix('tugas-saya')->name('anggota.tugas.')->group(function () {
    Route::get('/', [AgtTugasController::class, 'index'])->name('index'); // Jadi: anggota.tugas.index
    Route::get('/{id}', [AgtTugasController::class, 'show'])->name('show');   // Jadi: anggota.tugas.show
    // INI YANG BENAR:
    Route::patch('/{id}/submit', [AgtTugasController::class, 'submit'])->name('submit'); // Jadi: anggota.tugas.submit
});

use App\Http\Controllers\Kabid\KabidProposalController;
Route::middleware(['auth'])->prefix('kabid/proposal')->name('kabid.proposal.')->group(function () {
    // List & Detail
    Route::get('/', [KabidProposalController::class, 'index'])->name('index');
    Route::get('/create', [KabidProposalController::class, 'create'])->name('create');
    Route::get('/{proposal}', [KabidProposalController::class, 'show'])->name('show');
    // Simpan Data Baru
    Route::post('/', [KabidProposalController::class, 'store'])->name('store');
    // EDIT & UPDATE (Ini yang sering lupa)
    Route::get('/{proposal}/edit', [KabidProposalController::class, 'edit'])->name('edit');
    Route::put('/{proposal}', [KabidProposalController::class, 'update'])->name('update');
    // DELETE
    Route::delete('/{proposal}', [KabidProposalController::class, 'destroy'])->name('destroy');
});
use App\Http\Controllers\Direktur\DirProposalController;

Route::middleware(['auth', 'role:direktur'])->prefix('direktur/proposal')->name('direktur.proposal.')->group(function () {
    Route::get('/', [DirProposalController::class, 'index'])->name('index');
    Route::get('/{proposal}', [DirProposalController::class, 'show'])->name('show');

    // Aksi Keputusan
    Route::patch('/{id}/approve', [DirProposalController::class, 'approve'])->name('approve');
    Route::patch('/{id}/reject', [DirProposalController::class, 'reject'])->name('reject');
    Route::patch('/{id}/revise', [DirProposalController::class, 'revise'])->name('revise');
});
use App\Http\Controllers\General\GenArchiveController;

Route::middleware(['auth'])->prefix('archive')->name('general.archive.')->group(function () {
    Route::get('/', [GenArchiveController::class, 'index'])->name('index');
    Route::post('/store', [GenArchiveController::class, 'store'])->name('store');
    Route::get('/{archive}/download', [GenArchiveController::class, 'download'])->name('download');
    Route::patch('/{archive}/update', [GenArchiveController::class, 'update'])->name('update');
    Route::delete('/{archive}/destroy', [GenArchiveController::class, 'destroy'])->name('destroy');
});
use App\Http\Controllers\General\GenServiceRequestController;
Route::middleware(['auth'])->prefix('service-request')->name('general.service.')->group(function () {
    Route::get('/', [GenServiceRequestController::class, 'index'])->name('index');
    Route::post('/store', [GenServiceRequestController::class, 'store'])->name('store');
    // Actions untuk Divisi Tujuan
    Route::patch('/{id}/approve', [GenServiceRequestController::class, 'approve'])->name('approve');
    Route::patch('/{id}/take', [GenServiceRequestController::class, 'takeTask'])->name('take');
    Route::patch('/{id}/submit', [GenServiceRequestController::class, 'submitWork'])->name('submit');
});


use App\Http\Controllers\Direktur\DirMonitoringController;
Route::middleware(['auth', 'role:direktur'])->prefix('direktur')->group(function () {
    Route::get('/monitoring', [DirMonitoringController::class, 'index'])->name('dir.monitoring');
    Route::get('/monitoring/agenda', [DirMonitoringController::class, 'agenda'])->name('dir.monitoring.agenda');
    Route::get('/monitoring/tasks', [DirMonitoringController::class, 'tasks'])->name('dir.monitoring.tasks');
    Route::get('/monitoring/tasks/{id}', [DirMonitoringController::class, 'showTask'])->name('dir.monitoring.tasks.show');
    Route::get('/monitoring/documents', [DirMonitoringController::class, 'documents'])->name('dir.monitoring.documents');
    Route::get('/monitoring/archives', [DirMonitoringController::class, 'archives'])->name('dir.monitoring.archives');

    // Monitoring Requests & Proposals
    Route::get('/monitoring/service-requests', [DirMonitoringController::class, 'serviceRequests'])->name('dir.monitoring.service-requests');
    Route::get('/monitoring/proposals', [DirMonitoringController::class, 'proposals'])->name('dir.monitoring.proposals');
});

use App\Http\Controllers\Admin\AuditController; // <-- INI YANG SERING TERLEWAT
use App\Http\Controllers\Admin\AuditPerformanceController;
use App\Http\Controllers\Admin\AuditResourceController;
use App\Http\Controllers\Admin\AuditImpactController;
use App\Http\Controllers\Admin\AuditAdminController;
use App\Http\Controllers\Admin\AuditAnnouncementController;
// =========================================================================
// SECTION 1: ROLE PEMBINA (AKSES PENUH)
// =========================================================================
// =========================================================================
// AUDIT SYSTEM: AKSES PEMBINA & PENGAWAS
// =========================================================================
Route::middleware(['auth', 'role:pembina,pengawas'])->prefix('audit')->name('audit.')->group(function () {

    // Core & Logs
    Route::get('/', [AuditController::class, 'index'])->name('index');
    Route::get('/logs', [AuditController::class, 'activityLog'])->name('logs');
    Route::get('/user/{user}', [AuditController::class, 'showUser'])->name('user.show');

    // Performance
    Route::get('/performance', [AuditPerformanceController::class, 'index'])->name('performance.index');
    Route::get('/performance/user/{user}', [AuditPerformanceController::class, 'userPerformance'])->name('performance.user');
    Route::get('/timsoks', [AuditPerformanceController::class, 'timsoks'])->name('performance.timsoks');

    // Resources (Timeline, Archive)
    Route::prefix('resources')->name('resources.')->group(function () {
        Route::get('/', [AuditResourceController::class, 'index'])->name('index');
        Route::get('/timeline/{timeline}', [AuditResourceController::class, 'showTimeline'])->name('timeline');
        Route::get('/archive', [AuditResourceController::class, 'archiveDirectory'])->name('archive');
    });

    // Impact & Philanthropy
    Route::prefix('impact')->name('impact.')->group(function () {
        Route::get('/', [AuditImpactController::class, 'index'])->name('index');
        Route::get('/campaign/{campaign:slug}', [AuditImpactController::class, 'campaignTrace'])->name('campaign');
        Route::get('/report/{report:slug}', [AuditImpactController::class, 'showReport'])->name('report');
    });

    // Admin & Compliance
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AuditAdminController::class, 'index'])->name('index');
        Route::get('/proposal/{proposal}', [AuditAdminController::class, 'showProposal'])->name('proposal');
        Route::get('/program/{program}', [AuditAdminController::class, 'showProgram'])->name('program');
        Route::get('/report/{report}', [AuditAdminController::class, 'showReport'])->name('report');
    });

    // Announcement
    Route::resource('announcement', AuditAnnouncementController::class);
    Route::patch('announcement/{announcement}/toggle', [AuditAnnouncementController::class, 'toggleStatus'])->name('announcement.toggle');
});




require __DIR__.'/auth.php';

use App\Http\Controllers\PublicPortfolioController;
Route::get('/{slug}', [PublicPortfolioController::class, 'show'])->name('public.portfolio');

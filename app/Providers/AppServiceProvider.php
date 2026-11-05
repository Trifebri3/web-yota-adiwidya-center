<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Donation;
use App\Observers\DonationObserver;
use App\Enums\UserRole;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Donation::observe(DonationObserver::class);

        // Contoh Gate untuk Direktur & Admin
        Gate::define('manage-system', function (User $user) {
            return $user->role === UserRole::ADMIN || $user->role === UserRole::DIREKTUR;
        });

        // Gate untuk Kabid
        Gate::define('is-kabid', fn(User $user) => $user->role === UserRole::KABID);

        // Gate untuk OMC
        Gate::define('is-omc', fn(User $user) => $user->role === UserRole::OMC);


\App\Models\Agenda::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\Delegation::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\Proposal::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\Task::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\WorkspaceTask::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\LaporanBidang::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\ServiceRequest::observe(\App\Observers\GlobalActivityObserver::class);
    \App\Models\KabidPengumuman::observe(\App\Observers\GlobalActivityObserver::class);
\App\Models\Announcement::observe(\App\Observers\GlobalActivityObserver::class);
    }
}

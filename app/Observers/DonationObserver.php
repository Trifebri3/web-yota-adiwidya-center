<?php

namespace App\Observers;

use App\Models\Donation;

class DonationObserver
{
    /**
     * Handle the Donation "created" event.
     */
    public function created(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "updated" event.
     */
public function updated(Donation $donation)
{
    // Jika status berubah jadi success, update current_amount di kampanye
    if ($donation->wasChanged('status') && $donation->status === 'success') {
        $campaign = $donation->campaign;
        $campaign->increment('current_amount', $donation->amount);
    }
}

    /**
     * Handle the Donation "deleted" event.
     */
    public function deleted(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "restored" event.
     */
    public function restored(Donation $donation): void
    {
        //
    }

    /**
     * Handle the Donation "force deleted" event.
     */
    public function forceDeleted(Donation $donation): void
    {
        //
    }
}

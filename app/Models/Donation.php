<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'campaign_id', 'external_id', 'donor_name',
        'donor_email', 'amount', 'status', 'snap_token', 'payment_type'
    ];

    // Relasi balik ke Kampanye
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    // Scope untuk hanya mengambil donasi yang sudah lunas (Success)
    public function scopePaid($query)
    {
        return $query->where('status', 'success');
    }
}

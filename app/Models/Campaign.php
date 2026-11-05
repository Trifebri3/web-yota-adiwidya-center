<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Campaign extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'target_amount',
        'current_amount', 'end_date', 'image', 'status'
    ];

    // Casting JSON untuk multi-bahasa
    protected $casts = [
        'title' => 'json',
        'description' => 'json',
        'end_date' => 'date',
    ];

    // Relasi: Satu kampanye memiliki banyak donasi
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    // Accessor: Hitung persentase progres (Contoh: $campaign->progress_percentage)
    public function getProgressPercentageAttribute()
    {
        if ($this->target_amount <= 0) return 0;
        $percentage = ($this->current_amount / $this->target_amount) * 100;
        return $percentage > 100 ? 100 : round($percentage, 1);
    }

    // Hitung sisa hari
    public function getDaysLeftAttribute()
    {
        if ($this->end_date->isPast()) return 0;
        return now()->diffInDays($this->end_date);
    }

    // Otomatis buat Slug saat create
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($campaign) {
            $campaign->slug = Str::slug($campaign->title['id']) . '-' . Str::random(5);
        });
    }
public function getRouteKeyName()
{
    return 'slug';
}
}

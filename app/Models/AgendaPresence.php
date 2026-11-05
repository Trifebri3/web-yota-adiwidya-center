<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgendaPresence extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_id', 'user_id', 'status',
        'reason', 'attachment_link', 'confirmed_at'
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    /**
     * Relasi balik ke Agenda
     */
    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }

    /**
     * Relasi balik ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * LOGIKA "STATUS MERAH" (Otomatis Alpha jika telat konfirmasi)
     * Dipanggil di Blade: $presence->status_label
     */
    public function getStatusLabelAttribute()
    {
        // Jika belum konfirmasi dan waktu mulai sudah lewat = MERAH (Alpha)
        if ($this->status === 'pending' && now()->gt($this->agenda->start_time)) {
            return [
                'text' => 'ALPHA (MERAH)',
                'class' => 'bg-red-600 text-white animate-pulse',
                'icon' => '🚫'
            ];
        }

        return match($this->status) {
            'hadir'   => ['text' => 'HADIR', 'class' => 'bg-lime-500 text-white', 'icon' => '✅'],
            'izin'    => ['text' => 'IZIN', 'class' => 'bg-amber-400 text-[#064e3b]', 'icon' => '📝'],
            'sakit'   => ['text' => 'SAKIT', 'class' => 'bg-blue-400 text-white', 'icon' => '🏥'],
            'pending' => ['text' => 'MENUNGGU', 'class' => 'bg-slate-200 text-slate-500', 'icon' => '⏳'],
            default   => ['text' => 'ALPHA', 'class' => 'bg-red-600 text-white', 'icon' => '🚫'],
        };
    }

    /**
     * Scope: Filter yang butuh perhatian Direktur (Izin/Sakit yang ada bukti link)
     */
    public function scopeNeedReview($query)
    {
        return $query->whereIn('status', ['izin', 'sakit'])->whereNotNull('attachment_link');
    }
}

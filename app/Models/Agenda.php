<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Agenda extends Model
{
    use HasFactory;

protected $fillable = [
    'title',
'description',
    'start_time',
    'end_time',
    'type',
    'method',
    'location',
    'meeting_link',
    'repeat',
    'repeat_until',
    'created_by'
];

protected $casts = [
    'tanggal' => 'date',
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];

    /**
     * Otomatis buat slug saat judul diinput
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($agenda) {
            $agenda->slug = Str::slug($agenda->title) . '-' . Str::random(5);
        });
    }

    /**
     * Relasi ke Presensi (Satu agenda diikuti banyak user)
     */
    public function presences()
    {
        return $this->hasMany(AgendaPresence::class);
    }

    /**
     * Helper: Cek apakah agenda sedang berlangsung
     */
    public function getIsOngoingAttribute()
    {
        return now()->between($this->start_time, $this->end_time);
    }

    /**
     * Helper: Cek apakah agenda sudah selesai
     */
    public function getIsPastAttribute()
    {
        return now()->gt($this->end_time);
    }

    /**
     * Helper UI: Warna Badge berdasarkan Tipe
     */
    public function getTypeColorAttribute()
    {
        return match($this->type) {
            'rapat_rutin' => 'bg-blue-100 text-blue-700',
            'urgent'      => 'bg-red-100 text-red-700',
            default       => 'bg-slate-100 text-slate-700',
        };
    }


    // app/Models/Agenda.php

public function createNextRecurring()
{
    if ($this->repeat === 'none' || ($this->repeat_until && now()->gt($this->repeat_until))) {
        return null;
    }

    $nextStart = match($this->repeat) {
        'daily' => $this->start_time->addDay(),
        'weekly' => $this->start_time->addWeek(),
        'monthly' => $this->start_time->addMonth(),
    };

    // Pastikan tidak melewati batas akhir
    if ($this->repeat_until && $nextStart->gt($this->repeat_until)) return null;

    $newAgenda = $this->replicate();
    $newAgenda->start_time = $nextStart;
    $newAgenda->end_time = $nextStart->addHours(2); // Asumsi durasi 2 jam
    $newAgenda->slug = Str::slug($this->title) . '-' . Str::random(5);
    $newAgenda->save();

    return $newAgenda;
}
}

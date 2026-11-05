<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'description', 'kabid_id'];
protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];
    /**
     * Mendapatkan user yang bertindak sebagai Kabid di divisi ini
     */
    public function kabid()
    {
        return $this->belongsTo(User::class, 'kabid_id');
    }

    /**
     * Mendapatkan semua tim kecil (Bidang) di bawah divisi ini
     */
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    /**
     * Mendapatkan semua anggota yang terdaftar di divisi ini
     */
    public function members()
    {
        return $this->hasMany(User::class, 'division_id');
    }

    public function tasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Relasi: Satu Divisi juga memiliki banyak Pengumuman (Announcements)
     */
    public function announcements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Announcement::class);
    }
    public function agendas(): HasMany
    {
        return $this->hasMany(DivisionAgenda::class);
    }
public function kabidAnnouncements(): HasMany
    {
        return $this->hasMany(KabidPengumuman::class, 'division_id');
    }
public function reports(): \Illuminate\Database\Eloquent\Relations\HasMany
{
    return $this->hasMany(LaporanBidang::class, 'division_id');
}


}

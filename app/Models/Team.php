<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'division_id'];

    /**
     * Mendapatkan Divisi induk dari tim ini
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Mendapatkan anggota yang masuk ke dalam tim/bidang spesifik ini
     */
    public function members()
    {
        return $this->hasMany(User::class, 'team_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(KabidTask::class);
    }
}

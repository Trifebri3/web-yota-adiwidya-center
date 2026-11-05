<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KabidTask extends Model
{
    protected $fillable = [
        'kabid_id', 'team_id', 'user_id', 'title', 'description',
        'deadline', 'status', 'submission_link', 'submission_notes', 'revision_notes'
    ];
protected $casts = [
        'deadline' => 'datetime',
    ];
    // Relasi ke Pembuat (Kabid)
    public function kabid() {
        return $this->belongsTo(User::class, 'kabid_id');
    }

    // Relasi ke Tim (jika ada)
    public function team() {
        return $this->belongsTo(Team::class);
    }

    // Relasi ke User (jika ada)
    public function user() {
        return $this->belongsTo(User::class);
    }
}

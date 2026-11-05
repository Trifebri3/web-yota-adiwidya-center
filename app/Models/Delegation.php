<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delegation extends Model
{
    // List semua kolom agar bisa disimpan (Mass Assignment)
    protected $fillable = [
        'title',
        'instruction',
        'instruction_attachment',
        'submission_link',
        'result_notes', // Pastikan kolom ini ada di database!
        'deadline',
        'read_at',
        'completed_at',
        'director_id',
        'user_id',
        'status'
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'read_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function user() { return $this->belongsTo(User::class, 'user_id'); }
    public function director() { return $this->belongsTo(User::class, 'director_id'); }
}

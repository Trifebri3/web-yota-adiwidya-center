<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Announcement extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'priority', 'division_id', 'author_id', 'is_active', 'expires_at'];
protected $casts = [
    'expires_at' => 'datetime',
    'is_active'  => 'boolean',
    
];
    protected static function boot() {
        parent::boot();
        static::creating(fn($m) => $m->slug = Str::slug($m->title) . '-' . Str::random(5));
    }

    // Relasi ke divisi
    public function division() {
        return $this->belongsTo(Division::class);
    }

    // Relasi ke pembuat (Direktur)
    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Query khusus untuk Pengumuman Umum
    public function scopeGeneral($query) {
        return $query->whereNull('division_id');
    }

    // Query khusus untuk Divisi tertentu
    public function scopeByDivision($query, $divisionId) {
        return $query->where('division_id', $divisionId);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Archive extends Model
{
    use HasFactory;

    /**
     * Mass Assignment Protection
     */
    protected $fillable = [
        'user_id',
        'title',
        'category',
        'label_color',
        'description',
        'link_url',
        'attachment_path',
        'status',
        'is_public'
    ];

    /**
     * Casting data agar lebih mudah dikelola (Boolean & Datetime)
     */
    protected $casts = [
        'is_public' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // =========================================================
    // RELASI
    // =========================================================

    /**
     * Relasi ke User (Pemilik Arsip)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // =========================================================
    // SCOPES (Untuk Memudahkan Query di Controller)
    // =========================================================

    /**
     * Scope untuk mengambil arsip yang boleh dilihat oleh user saat ini
     * (Milik sendiri ATAU Public)
     */
    public function scopeAccessibleBy($query, $user)
    {
        return $query->where('is_public', true)
                     ->orWhere('user_id', $user->id);
    }

    /**
     * Scope khusus untuk kategori tertentu
     */
    public function scopeInCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    // =========================================================
    // ACCESSORS & MUTATORS
    // =========================================================

    /**
     * Mengecek apakah user yang sedang login adalah pemilik arsip ini
     */
    public function getIsOwnerAttribute()
    {
        return $this->user_id === Auth::id();
    }

    /**
     * Mengambil URL lengkap untuk lampiran file
     */
    public function getAttachmentUrlAttribute()
    {
        return $this->attachment_path
            ? asset('storage/' . $this->attachment_path)
            : null;
    }
}

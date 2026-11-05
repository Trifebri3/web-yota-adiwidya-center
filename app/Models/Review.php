<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang terkait dengan model.
     * @var string
     */
    protected $table = 'reviews';

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable).
     * Penting: Jika kolom di sini tidak terdaftar, data dari form
     * tidak akan pernah masuk ke database.
     * * @var array
     */
    protected $fillable = [
        'name',
        'position',
        'photo',
        'comment',
        'rating',
        'is_published',
    ];

    /**
     * Casting tipe data.
     * Memastikan is_published diperlakukan sebagai boolean (true/false)
     * dan rating sebagai integer.
     * * @var array
     */
    protected $casts = [
        'is_published' => 'boolean',
        'rating' => 'integer',
        'created_at' => 'datetime',
    ];

    /**
     * Scope untuk mempermudah pengambilan data yang sudah di-ACC saja.
     * Digunakan di Controller: Review::published()->get();
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Helper untuk mendapatkan URL foto profil.
     * Jika tidak ada foto, akan mengembalikan avatar inisial.
     */
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=d9f99d&color=064e3b';
    }
}

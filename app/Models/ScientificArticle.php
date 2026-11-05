<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScientificArticle extends Model
{
    protected $fillable = [
        'slug', 'user_id', 'title', 'abstract', 'introduction', 'methodology',
        'results', 'discussion', 'conclusion', 'references',
        'cover_image', 'pdf_version', 'is_verified', 'published_at'
    ];

    protected $casts = [
        'user_ids' => 'array',
        'title' => 'array',
        'abstract' => 'array',
        'introduction' => 'array',
        'methodology' => 'array',
        'results' => 'array',
        'discussion' => 'array',
        'conclusion' => 'array',
        'references' => 'array',
        'published_at' => 'datetime',
    ];

    // Relasi ke User untuk mendapatkan Penulis & Afiliasi
public function authors()
{
    // Relasi Many-to-Many
    return $this->belongsToMany(User::class, 'article_user');
}

// Accessor untuk mempermudah pemanggilan nama penulis di Blade
public function getAuthorDisplayAttribute()
{
    if ($this->authors->isEmpty()) {
        return 'Pusat Informasi dan Komunikasi';
    }
    return $this->authors->pluck('name')->implode(', ');
}

}

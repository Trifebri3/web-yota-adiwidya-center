<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'title', 'slug', 'excerpt',
        'content', 'cover_image', 'type', 'status',
        'reading_time', 'views_count', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Postingan ditulis oleh seorang User.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Postingan termasuk dalam sebuah Kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke metadata (khusus jurnal/ilmiah).
     */
    public function meta(): HasOne
    {
        return $this->hasOne(PostMeta::class);
    }

    /**
     * Relasi ke komentar.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function getCoverImageUrlAttribute()
{
    return $this->cover_image
        ? asset('storage/' . $this->cover_image)
        : 'https://ui-avatars.com/api/?name=' . urlencode($this->title) . '&color=7F9CF5&background=EBF4FF';
}


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Publication extends Model
{
    protected $fillable = ['slug', 'type', 'title', 'content', 'description', 'banner', 'pdf_file', 'author', 'published_at', 'is_verified', 'views', 'shares', 'comments_count'];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'description' => 'array',
        'published_at' => 'datetime'

    ];

    // Fungsi Otomatis Ambil Bahasa Sesuai Locale Website
    public function getTranslatedTitleAttribute() {
        return $this->title[App::getLocale()] ?? $this->title['id'];
    }

    public function getTranslatedContentAttribute() {
        return $this->content[App::getLocale()] ?? $this->content['id'];
    }

    // Di Model Publication
public function getTranslation($field, $lang) {
    return $this->$field[$lang] ?? '';
}

// app/Models/Publication.php

public function getRouteKeyName()
{
    return 'slug';
}
// app/Models/Publication.php

public function getEngagementScoreAttribute()
{
    // Rumus sederhana: Views + (Shares * 5)
    return $this->views + ($this->shares * 5);
}

// Scope untuk mempermudah pemanggilan data trending
public function scopeTrending($query)
{
    return $query->orderBy('views', 'desc');
}

public function comments() {
    // Beritahu Laravel bahwa foreign key di tabel comments adalah 'post_id'
    return $this->hasMany(Comment::class, 'post_id');
}
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    protected $fillable = ['title', 'slug', 'image', 'category', 'description', 'is_active', 'order'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($gallery) {
            $gallery->slug = Str::slug($gallery->title);
        });
    }
}

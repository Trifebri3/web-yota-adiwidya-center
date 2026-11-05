<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
    // Tambahkan publication_id jika Anda merubah migration tadi
    protected $fillable = ['post_id', 'publication_id', 'user_id', 'parent_id', 'body', 'is_approved'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Ubah nama fungsi ini agar sesuai dengan pemanggilan di Blade ($publication->comments)
    public function publication() {
        return $this->belongsTo(Publication::class, 'post_id'); // 'post_id' adalah nama kolom di DB Anda
    }

    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}

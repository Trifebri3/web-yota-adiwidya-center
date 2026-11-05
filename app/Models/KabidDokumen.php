<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class KabidDokumen extends Model
{
    protected $table = 'kabid_dokumen';
    protected $fillable = ['division_id', 'user_id', 'title', 'link_url', 'description', 'category'];

    public function user() { return $this->belongsTo(User::class); }
}

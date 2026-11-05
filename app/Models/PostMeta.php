<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostMeta extends Model
{
    // Nama tabel didefinisikan secara eksplisit jika Laravel bingung dengan penamaan plural
    protected $table = 'post_metas';

    protected $fillable = ['post_id', 'doi', 'issn', 'references', 'pdf_version'];

    /**
     * Meta data ini dimiliki oleh satu Postingan.
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}

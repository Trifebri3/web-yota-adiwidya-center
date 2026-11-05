<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     * Kita masukkan user_id, task, priority, dan is_completed.
     */
    protected $fillable = [
        'user_id',
        'task',
        'priority',
        'is_completed',
    ];

    /**
     * Relasi balik ke User.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

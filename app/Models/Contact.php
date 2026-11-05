<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'sender_name',
        'sender_email',
        'subject',
        'message_body',
        'is_read',
    ];

    /**
     * Casting atribut.
     */
    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * Helper: Mendapatkan inisial pengirim untuk avatar placeholder.
     */
    public function getSenderInitialsAttribute(): string
    {
        return collect(explode(' ', $this->sender_name))
            ->map(fn($name) => strtoupper(substr($name, 0, 1)))
            ->take(2)
            ->implode('');
    }
}

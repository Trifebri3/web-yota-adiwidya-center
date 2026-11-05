<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = ['title', 'content', 'type', 'division_id', 'user_id', 'author_id', 'label', 'is_read'];

    public function division() { return $this->belongsTo(Division::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }

    // Scope untuk mempermudah filter
    public function scopeForUser($query, $userId) {
        return $query->where('type', 'user')->where('user_id', $userId);
    }

    public function scopeForDivision($query, $divisionId) {
        return $query->where('type', 'division')->where('division_id', $divisionId);
    }
}

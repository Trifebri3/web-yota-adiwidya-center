<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
// app/Models/Task.php
protected $fillable = [
    'title', 'description', 'deadline', 'instruction_link',
    'submission_link', 'division_id', 'author_id',
    'status', 'director_note', 'opened_at'
];

protected $casts = [
    'deadline' => 'date',
    'opened_at' => 'datetime'
];

    public function division() { return $this->belongsTo(Division::class); }
    public function author() { return $this->belongsTo(User::class, 'author_id'); }

    // Helper untuk warna status di UI
    public function getStatusColorAttribute() {
        return match($this->status) {
            'pending'   => 'bg-slate-100 text-slate-500',
            'read'      => 'bg-blue-100 text-blue-600',
            'doing'     => 'bg-amber-100 text-amber-600',
            'submitted' => 'bg-purple-100 text-purple-600',
            'revision'  => 'bg-red-100 text-red-600',
            'completed' => 'bg-lime-100 text-lime-600',
        };
    }
}

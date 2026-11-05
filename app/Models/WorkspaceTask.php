<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkspaceTask extends Model
{
    protected $fillable = [
        'workspace_id', 'assignee_id', 'creator_id', 'title',
        'description', 'category', 'instruction_link',
        'submission_link', 'due_date', 'status', 'last_viewed_at'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'last_viewed_at' => 'datetime',
    ];

    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    /**
     * User yang ditugaskan mengerjakan (Penerima).
     */
    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    /**
     * User yang membuat tugas (Pemberi).
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    /**
     * Komentar/Diskusi di dalam tugas ini.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(WorkspaceComment::class, 'workspace_task_id');
    }

    // Helper untuk warna status di UI
    public function getStatusColorAttribute() {
        return match($this->status) {
            'to-do'     => 'bg-slate-100 text-slate-600',
            'doing'     => 'bg-amber-100 text-amber-600',
            'submitted' => 'bg-purple-100 text-purple-600',
            'revision'  => 'bg-red-100 text-red-600',
            'acc'       => 'bg-lime-100 text-lime-600',
        };
    }
}

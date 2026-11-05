<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkspaceComment extends Model
{
    protected $fillable = ['workspace_task_id', 'user_id', 'comment'];

    public function task(): BelongsTo
    {
        return $this->belongsTo(WorkspaceTask::class, 'workspace_task_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

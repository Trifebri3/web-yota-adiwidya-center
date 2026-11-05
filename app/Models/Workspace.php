<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workspace extends Model
{
    protected $fillable = ['name', 'description', 'general_instruction_link', 'created_by', 'status'];

    /**
     * User yang membuat workspace ini (biasanya Direktur/Kadiv).
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Anggota yang tergabung dalam workspace ini (Many-to-Many).
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'workspace_user');
    }

    /**
     * Semua daftar tugas yang ada di dalam workspace ini.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(WorkspaceTask::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimelineStage extends Model
{
    protected $fillable = ['timeline_id', 'stage_name', 'task_detail', 'start_date', 'end_date', 'order', 'is_completed', 'send_reminder'];
    protected $casts = ['start_date' => 'date', 'end_date' => 'date', 'is_completed' => 'boolean'];

    public function timeline() {
        return $this->belongsTo(Timeline::class);
    }

    // Helper: Cek apakah termin ini sedang berjalan hari ini
    public function getIsActiveAttribute() {
        return now()->between($this->start_date, $this->end_date);
    }

    // Helper: Cek apakah termin sudah telat (Deadline terlewati tapi belum selesai)
    public function getIsOverdueAttribute() {
        return now()->gt($this->end_date) && !$this->is_completed;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'requester_id', 'requester_division_id', 'target_division_id',
        'ticket_number', 'title', 'description', 'attachment_request',
        'status', 'handler_id', 'submission_notes', 'submission_file',
        'approved_at', 'completed_at'
    ];

    // Relasi ke Pengirim
    public function requester() { return $this->belongsTo(User::class, 'requester_id'); }

    // Relasi ke Divisi Pengirim
    public function requesterDivision() { return $this->belongsTo(Division::class, 'requester_division_id'); }

    // Relasi ke Divisi Tujuan
    public function targetDivision() { return $this->belongsTo(Division::class, 'target_division_id'); }

    // Relasi ke Staff yang menangani (Handler)
    public function handler() { return $this->belongsTo(User::class, 'handler_id'); }
}

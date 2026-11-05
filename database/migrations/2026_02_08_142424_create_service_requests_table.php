<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('service_requests', function (Blueprint $table) {
        $table->id();

        // PENGIRIM (Requestor)
        $table->foreignId('requester_id')->constrained('users'); // User A
        $table->foreignId('requester_division_id')->constrained('divisions'); // Divisi A

        // TUJUAN (Target)
        $table->foreignId('target_division_id')->constrained('divisions'); // Contoh: Divisi Admin

        // DETAIL PERMINTAAN
        $table->string('ticket_number')->unique(); // No Tiket Otomatis
        $table->string('title'); // Contoh: Permintaan Surat Keputusan
        $table->text('description');
        $table->string('attachment_request')->nullable(); // Lampiran dari pengirim

        // STATUS ALUR
        // pending: Menunggu ACC Kadiv Tujuan
        // approved: Disetujui Kadiv & Terlihat oleh Anggota Divisi Tujuan
        // in_progress: Sedang dikerjakan staf divisi tujuan
        // completed: Selesai
        // rejected: Ditolak Kadiv Tujuan
        $table->enum('status', ['pending', 'approved', 'in_progress', 'completed', 'rejected'])->default('pending');

        // PENANGANAN (Submission)
        $table->foreignId('handler_id')->nullable()->constrained('users'); // Siapa anggota divisi tujuan yang kerjain
        $table->text('submission_notes')->nullable(); // Catatan hasil kerja
        $table->string('submission_file')->nullable(); // File hasil (Misal: Surat yang sudah jadi)

        $table->timestamp('approved_at')->nullable();
        $table->timestamp('completed_at')->nullable();
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};

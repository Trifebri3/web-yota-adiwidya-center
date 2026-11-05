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
    Schema::create('proposals', function (Blueprint $table) {
        $table->id();

        // Identitas Pengaju
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang mengajukan
        $table->foreignId('division_id')->constrained()->onDelete('cascade'); // Dari divisi mana

        // Detail Inti Pengajuan
        $table->string('reference_number')->unique(); // No Surat/Referensi Otomatis
        $table->string('title'); // Judul Pengajuan
        $table->enum('category', ['budget', 'program', 'inventory', 'human_resource', 'other']); // Kategori
        $table->longText('description'); // Penjelasan Detail

        // Anggaran (Opsional, diisi jika kategori budget)
        $table->decimal('estimated_cost', 15, 2)->nullable();

        // Lampiran Berkas (Link Cloud/Drive)
        $table->string('document_url')->nullable();

        // Status Alur (Workflow)
        // pending: baru, review: dicek admin/pengawas, approved: disetujui dir, rejected: ditolak, revised: butuh perbaikan
        $table->enum('status', ['pending', 'review', 'approved', 'rejected', 'revised'])->default('pending');

        // Jejak Persetujuan
        $table->foreignId('reviewer_id')->nullable()->constrained('users'); // Admin/Pengawas yang cek awal
        $table->foreignId('approver_id')->nullable()->constrained('users'); // Direktur yang ACC

        // Umpan Balik (Feedback)
        $table->text('notes_from_reviewer')->nullable(); // Catatan Pengawas
        $table->text('notes_from_director')->nullable(); // Alasan disetujui/ditolak

        // Waktu Penting
        $table->timestamp('reviewed_at')->nullable();
        $table->timestamp('approved_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};

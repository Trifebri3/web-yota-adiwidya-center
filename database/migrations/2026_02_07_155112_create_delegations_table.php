<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('delegations', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul Mandat/Delegasi
        $table->text('instruction'); // Isi Instruksi Detail
        $table->string('instruction_attachment')->nullable(); // Link Lampiran dari Direktur (Gdrive/Doc/PDF)

        // Link Pengumpulan dari Penerima
        $table->string('submission_link')->nullable();

        // Waktu
        $table->datetime('deadline');
        $table->timestamp('read_at')->nullable(); // Mengetahui kapan user membaca delegasi ini
        $table->timestamp('completed_at')->nullable(); // Kapan tugas diselesaikan

        // Relasi
        $table->foreignId('director_id')->constrained('users'); // Pemberi Mandat
        $table->foreignId('user_id')->constrained('users'); // Penerima Mandat (Individu)

        // Status
        $table->enum('status', ['sent', 'read', 'in_progress', 'submitted', 'revision', 'completed'])->default('sent');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegations');
    }
};

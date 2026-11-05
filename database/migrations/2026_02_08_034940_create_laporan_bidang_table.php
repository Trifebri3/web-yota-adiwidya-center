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
    Schema::create('laporan_bidang', function (Blueprint $table) {
        $table->id();
        $table->foreignId('division_id')->constrained();
        $table->foreignId('user_id')->constrained(); // Kabid pengirim
        $table->string('title'); // Contoh: Laporan Bulanan Januari 2024
        $table->string('report_type')->default('Bulanan'); // Bulanan, Program Khusus, dsb.
        $table->date('report_date'); // Tanggal periode laporan
        $table->text('description')->nullable();

        // Resource dari Direktur
        $table->string('instruction_link')->nullable(); // Link instruksi dari Direktur
        $table->string('template_link')->nullable();    // Link template dari Direktur

        // File dari Kabid
        $table->string('report_link'); // Link laporan yang sudah jadi (Gdrive/PDF)

        // Review System
        $table->enum('status', ['pending', 'reviewed', 'approved', 'rejected'])->default('pending');
        $table->text('feedback')->nullable(); // Masukan dari Direktur
        $table->timestamp('reviewed_at')->nullable();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_bidang');
    }
};

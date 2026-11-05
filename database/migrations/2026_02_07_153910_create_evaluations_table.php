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
    Schema::create('evaluations', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Judul Evaluasi (misal: Evaluasi Kinerja Januari)
        $table->text('content'); // Isi Catatan/Kritik/Saran

        // Jenis Evaluasi: 'division' atau 'user'
        $table->enum('type', ['division', 'user'])->default('user');

        // Relasi (Dibuat Nullable karena tergantung tipe)
        $table->foreignId('division_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');

        // Penulis (Direktur)
        $table->foreignId('author_id')->constrained('users');

        // Status & Level (Optional untuk visual)
        $table->enum('label', ['improvement', 'warning', 'praise', 'general'])->default('general');
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};

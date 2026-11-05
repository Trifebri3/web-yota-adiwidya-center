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
Schema::create('publications', function (Blueprint $table) {
    $table->id();
    $table->string('slug')->unique();
    $table->string('type');
    // Data Multi-Bahasa disimpan dalam JSON
    $table->json('title');       // {"id": "...", "en": "..."}
    $table->json('content');     // {"id": "...", "en": "..."} (Bisa simpan HTML/Body)
    $table->json('description'); // {"id": "...", "en": "..."} (Untuk ringkasan/caption)

    $table->string('banner');    // Path Image
    $table->string('pdf_file')->nullable(); // Khusus laporan (PDF)
    $table->string('author');
    $table->timestamp('published_at');
    $table->boolean('is_verified')->default(true);
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};

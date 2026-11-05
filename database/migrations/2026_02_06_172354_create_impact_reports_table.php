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
    Schema::create('impact_reports', function (Blueprint $table) {
        $table->id();
        $table->json('title'); // Multi-lang
        $table->string('slug')->unique();
        $table->string('category'); // Buku, Program, Kegiatan, Bibit, dll
        $table->json('description')->nullable();
        $table->string('cover_image')->nullable();
        $table->string('pdf_path')->nullable(); // Link eksternal PDF

        // Komponen Detail Program (Multi-lang)
        $table->json('goals')->nullable();
        $table->json('targets')->nullable();
        $table->string('location')->nullable();
        $table->json('methodology')->nullable();

        // Data Statistik (Dynamic JSON)
        // Format: {"label": "Desa Berdaya", "value": "120+", "sub": "Titik kolaborasi..."}
        $table->json('stats_data')->nullable();

        $table->json('impact_stories')->nullable(); // Cerita Terkurasi
        $table->date('published_at');
        $table->boolean('is_verified')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_reports');
    }
};

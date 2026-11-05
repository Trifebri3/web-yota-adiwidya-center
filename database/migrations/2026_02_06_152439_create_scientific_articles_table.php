<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scientific_articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();

            // Relasi ke User (Penulis/Afiliasi)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Komponen Utama (JSON untuk Multi-bahasa)
            $table->json('title');         // Judul
            $table->json('abstract');      // Abstrak (Wajib ID & EN)
            $table->json('introduction');  // Pendahuluan
            $table->json('methodology');   // Metodologi
            $table->json('results');       // Hasil
            $table->json('discussion');    // Diskusi
            $table->json('conclusion');    // Kesimpulan
            $table->json('references');    // Daftar Pustaka

            // Metadata & Media
            $table->string('cover_image')->nullable();
            $table->string('pdf_version')->nullable(); // Link download versi jurnal
            $table->string('doi_link')->nullable();    // Jika ada Digital Object Identifier

            // Status & Tracking
            $table->boolean('is_verified')->default(true); // Tag: Verified Scientific Article
            $table->string('verification_badge')->default('Verified Scientific Article');
            $table->integer('views')->default(0);
            $table->integer('citations')->default(0); // Jumlah sitasi (opsional)

            $table->timestamp('published_at');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scientific_articles');
    }
};

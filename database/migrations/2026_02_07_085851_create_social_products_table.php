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
    Schema::create('social_products', function (Blueprint $table) {
        $table->id();
        $table->string('category'); // Kategori produk
        $table->string('banner_image'); // File gambar wajib

        // Data Multi-bahasa (Disimpan sebagai JSON)
        $table->json('name'); // Contoh: {"id": "Robot Tani", "en": "Agri Robot"}
        $table->json('description');
        $table->json('features'); // Fungsi
        $table->json('benefits');  // Manfaat

        // Link Opsional (Hanya Link, Tidak Ada Upload File)
        $table->string('video_url')->nullable();
        $table->string('pdf_url')->nullable();
        $table->string('external_link')->nullable(); // Link tambahan

        $table->string('slug')->unique();
        $table->boolean('is_active')->default(true);
        $table->string('published_by')->default('OMC Office');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_products');
    }
};

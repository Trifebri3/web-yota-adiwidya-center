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
    Schema::create('archives', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Konten Inti
        $table->string('title');
        $table->string('category'); // Misal: Keuangan, HR, Teknis
        $table->string('label_color')->default('#64748b'); // Warna hex untuk kategori
        $table->text('description')->nullable();

        // Media & Link
        $table->string('link_url')->nullable();
        $table->string('attachment_path')->nullable(); // File pendukung

        // Status & Privasi
        $table->string('status')->default('active'); // active, archived, draft
        $table->boolean('is_public')->default(false); // false = Private, true = Public

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archives');
    }
};

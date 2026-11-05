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
    Schema::create('doc_publications', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->enum('category', ['annual_report', 'policy_brief', 'official_statement']);
        $table->text('description'); // Untuk isi teks resmi atau deskripsi singkat
        $table->string('cover_image')->nullable();
        $table->string('pdf_path')->nullable();
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
        Schema::dropIfExists('doc_publications');
    }
};

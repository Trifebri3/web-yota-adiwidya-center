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
Schema::create('post_metas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('post_id')->constrained()->onDelete('cascade');
    $table->string('doi')->nullable(); // Digital Object Identifier
    $table->string('issn')->nullable();
    $table->text('references')->nullable(); // Daftar pustaka
    $table->string('pdf_version')->nullable(); // Link download file ilmiah
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_metas');
    }
};

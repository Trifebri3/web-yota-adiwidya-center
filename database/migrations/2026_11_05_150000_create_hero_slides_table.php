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
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publication_id')->nullable()->constrained('publications')->nullOnDelete();
            $table->string('title');
            $table->string('category')->default('PENGUMUMAN');
            $table->text('summary')->nullable();
            $table->string('image')->nullable();
            $table->string('button_text')->default('Baca Selengkapnya');
            $table->string('button_link')->default('#');
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};


<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_skills_table.php
public function up(): void {
    Schema::create('skills', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Contoh: Laravel, React, IoT Engineering
        $table->enum('category', ['web', 'mobile', 'ai_iot', 'hardware'])->default('web');
        $table->integer('proficiency_percent')->default(0); // 0-100 untuk progress bar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};

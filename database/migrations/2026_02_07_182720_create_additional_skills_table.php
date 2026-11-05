<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void {
    Schema::create('additional_skills', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('skill_name'); // Drone Pilot / Public Speaking
        $table->enum('skill_type', ['language', 'soft_skill', 'hobby_tech']);
        $table->string('proficiency_level')->nullable(); // Beginner / Expert
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_skills');
    }
};

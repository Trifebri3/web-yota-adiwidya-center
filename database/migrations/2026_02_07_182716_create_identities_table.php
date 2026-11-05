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
    Schema::create('identities', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('full_name');
        $table->string('professional_title')->nullable(); // Digital Strategy | AI Engineer
        $table->string('tagline')->nullable();
        $table->text('about_me')->nullable();
        $table->string('avatar_image')->nullable();
        $table->string('cv_pdf_path')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identities');
    }
};

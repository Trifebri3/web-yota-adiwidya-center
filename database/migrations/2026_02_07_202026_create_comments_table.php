<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Parent ID untuk fitur Reply (Komentar Bersarang)
        $table->unsignedBigInteger('parent_id')->nullable();

        $table->text('body');
        $table->boolean('is_approved')->default(true); // Untuk moderasi
        $table->timestamps();

        // Foreign key manual untuk parent_id
        $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

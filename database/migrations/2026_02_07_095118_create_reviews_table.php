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
    Schema::create('reviews', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('position')->nullable(); // Misal: "Petani di Desa X" atau "CEO Mitra Y"
        $table->string('photo')->nullable();
        $table->text('comment');
        $table->integer('rating')->default(5);
        $table->boolean('is_published')->default(false); // Default: Menunggu ACC
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};

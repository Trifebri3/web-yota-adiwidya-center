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
    Schema::create('division_agendas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('division_id')->constrained()->onDelete('cascade');
        $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // Kabid yang buat

        $table->string('title'); // Contoh: Rapat Koordinasi, Workshop, Visitasi
        $table->enum('type', ['meeting', 'event', 'project_deadline', 'other']);
        $table->text('description')->nullable();
        $table->string('location')->nullable(); // Link Zoom atau lokasi fisik

        $table->datetime('start_time');
        $table->datetime('end_time');
        $table->string('color')->default('#064e3b'); // Warna di kalender

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_agendas');
    }
};

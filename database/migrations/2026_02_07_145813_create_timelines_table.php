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
    Schema::create('timelines', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Nama Project Besar (contoh: Milad ke-10)
        $table->string('slug')->unique();
        $table->text('description')->nullable();
        $table->date('start_date');
        $table->date('end_date');
        $table->enum('status', ['planned', 'on_progress', 'completed', 'delayed'])->default('planned');
        $table->string('category')->nullable(); // Event, Project, Research, dll
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};

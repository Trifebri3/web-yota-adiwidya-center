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
    Schema::create('kabid_dokumen', function (Blueprint $table) {
        $table->id();
        $table->foreignId('division_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->string('link_url');
        $table->text('description')->nullable();
        $table->string('category')->default('Template'); // e.g., SOP, Asset, Template
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabid_dokumen');
    }
};

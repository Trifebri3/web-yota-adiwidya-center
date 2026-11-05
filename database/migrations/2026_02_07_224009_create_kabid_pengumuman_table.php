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
    Schema::create('kabid_pengumuman', function (Blueprint $table) {
        $table->id();
        $table->foreignId('division_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa Kabid yang buat
        $table->string('title');
        $table->text('content');
        $table->enum('priority', ['normal', 'urgent', 'critical'])->default('normal');
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kabid_pengumuman');
    }
};

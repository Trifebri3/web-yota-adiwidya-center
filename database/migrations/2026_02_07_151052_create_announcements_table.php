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
    Schema::create('announcements', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('content');
        $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');

        // Target Pengumuman
        // Jika null = UMUM, jika ada ID = Spesifik Divisi
        $table->foreignId('division_id')->nullable()->constrained()->onDelete('cascade');

        // Metadata
        $table->foreignId('author_id')->constrained('users'); // Siapa yang buat
        $table->boolean('is_active')->default(true);
        $table->timestamp('expires_at')->nullable(); // Pengumuman bisa otomatis hilang
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};

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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description')->nullable();
        $table->date('deadline');
        $table->string('instruction_link')->nullable(); // Link Instruksi (Gdrive/Doc)
        $table->string('submission_link')->nullable();  // Link Pengumpulan dari Divisi

        // Target & Pembuat
        $table->foreignId('division_id')->constrained()->onDelete('cascade');
        $table->foreignId('author_id')->constrained('users');

        // Status Flow
        // pending: belum dibuka, read: sudah dibuka, doing: dikerjakan, submitted: dikumpul, revision: revisi, completed: ACC
        $table->enum('status', ['pending', 'read', 'doing', 'submitted', 'revision', 'completed'])->default('pending');

        // Feedback Direktur
        $table->text('director_note')->nullable(); // Catatan revisi atau feedback
        $table->timestamp('opened_at')->nullable(); // Kapan pertama kali dibuka oleh divisi

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

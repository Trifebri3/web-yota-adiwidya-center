<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kabid_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kabid_id')->constrained('users')->onDelete('cascade'); // Siapa Kabid pembuatnya

            // Pengalamatan Tugas (Fleksibel)
            $table->foreignId('team_id')->nullable()->constrained('teams')->onDelete('cascade'); // Jika dikirim ke tim
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // Jika dikirim ke personal

            // Detail Tugas
            $table->string('title');
            $table->text('description');
            $table->datetime('deadline');

            // Status & Progress
            $table->enum('status', ['pending', 'in_progress', 'submitted', 'revised', 'completed'])->default('pending');

            // Kolom untuk User (Pengumpulan)
            $table->string('submission_link')->nullable(); // Link hasil kerja (Gdrive/Figma/Github/dll)
            $table->text('submission_notes')->nullable(); // Catatan dari staf saat mengumpulkan

            // Kolom untuk Kabid (Revisi/Feedback)
            $table->text('revision_notes')->nullable(); // Catatan revisi jika ditolak

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kabid_tasks');
    }
};

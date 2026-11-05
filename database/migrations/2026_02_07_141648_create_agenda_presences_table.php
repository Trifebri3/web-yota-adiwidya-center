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
    Schema::create('agenda_presences', function (Blueprint $table) {
        $table->id();
        $table->foreignId('agenda_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Status Kehadiran
        $table->enum('status', ['pending', 'hadir', 'izin', 'sakit', 'alpha'])->default('pending');
        $table->text('reason')->nullable(); // Alasan jika izin/sakit
        $table->string('attachment_link')->nullable(); // Bukti berupa link (G-Drive/Image)

        $table->timestamp('confirmed_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agenda_presences');
    }
};

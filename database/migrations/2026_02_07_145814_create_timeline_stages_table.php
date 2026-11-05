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
    Schema::create('timeline_stages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('timeline_id')->constrained()->onDelete('cascade');
        $table->string('stage_name'); // Nama Termin (contoh: Persiapan A, Eksekusi B)
        $table->text('task_detail')->nullable();
        $table->date('start_date');
        $table->date('end_date');
        $table->integer('order')->default(0); // Urutan fase (1, 2, 3...)
        $table->boolean('is_completed')->default(false);
        $table->boolean('send_reminder')->default(true); // Flag untuk pengingat
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_stages');
    }
};

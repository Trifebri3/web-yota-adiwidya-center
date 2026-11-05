<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_educations_table.php
public function up(): void {
    Schema::create('educations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('institution'); // Nama Kampus/Sekolah
        $table->string('degree')->nullable(); // S1, SMK, dsb
        $table->string('field_of_study')->nullable(); // Jurusan
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->boolean('is_current')->default(false);
        $table->text('achievements_summary')->nullable(); // IPK atau prestasi selama sekolah
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educations');
    }
};

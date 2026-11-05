<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // 1. Identitas Dasar
        $table->string('member_id')->unique()->nullable(); // Auto-generate nantinya
        $table->string('nickname')->nullable();
        $table->enum('gender', ['L', 'P'])->nullable();
        $table->string('pob')->nullable(); // Place of Birth
        $table->date('dob')->nullable();   // Date of Birth
        $table->string('citizenship')->default('WNI');

        // 2. Kontak & Alamat
        $table->string('phone_number')->nullable();
        $table->text('domicile_address')->nullable();
        $table->string('province')->nullable();
        $table->string('city')->nullable();
        $table->string('district')->nullable();

        // 3. Status Keanggotaan
        $table->enum('membership_status', ['calon', 'aktif', 'nonaktif', 'alumni'])->default('calon');
        $table->date('joined_at')->nullable();
        $table->string('assignment_area')->nullable();

        // 4. Pendidikan & Kompetensi
        $table->string('last_education')->nullable();
        $table->string('institution')->nullable();
        $table->text('main_skill')->nullable();

        // 5. Data Darurat
        $table->string('emergency_contact_name')->nullable();
        $table->string('emergency_contact_phone')->nullable();
        $table->string('blood_type', 3)->nullable();

        // 6. DATA SENSITIF (Akan Dienkripsi)
        $table->text('id_number')->nullable(); // KTP
        $table->string('id_card_path')->nullable(); // Path File KTP
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('impact_reports', function (Blueprint $blueprint) {
            // Menambahkan kolom provinsi untuk statistik pesebaran
            $blueprint->string('province')->nullable()->after('category')->index();

            // Opsional: Menambahkan impact_value untuk perhitungan rata-rata analitik
            $blueprint->decimal('impact_value', 15, 2)->default(0)->after('province');
        });
    }

    public function down(): void
    {
        Schema::table('impact_reports', function (Blueprint $blueprint) {
            $blueprint->dropColumn(['province', 'impact_value']);
        });
    }
};

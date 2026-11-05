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
    Schema::table('users', function (Blueprint $table) {
        // Cek apakah kolom sudah ada, jika sudah ada jangan di-add lagi (pakai manual db)
        $table->foreignId('division_id')->nullable()->after('id')->constrained('divisions')->onDelete('set null');
        $table->foreignId('team_id')->nullable()->after('division_id')->constrained('teams')->onDelete('set null');
    });
}
public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['division_id']);
        $table->dropForeign(['team_id']);
        $table->dropColumn(['division_id', 'team_id', 'role']);
    });
}
};

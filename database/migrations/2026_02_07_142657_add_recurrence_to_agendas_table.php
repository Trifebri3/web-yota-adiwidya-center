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
        Schema::table('agendas', function (Blueprint $table) {
            // Tambahkan kolom yang hilang dari tabel (BUKAN change)
            $table->string('type')->nullable()->default('agenda_umum')->after('slug');
            $table->string('method')->nullable()->default('offline')->after('type');
            $table->string('location')->nullable()->after('method');
            $table->string('meeting_link')->nullable()->after('location');

            // Kolom Recurrence (Pengulangan)
            $table->string('repeat')->nullable()->default('none')->after('end_time');
            $table->date('repeat_until')->nullable()->after('repeat');
            $table->boolean('is_parent')->default(false)->after('repeat_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('agendas', function (Blueprint $table) {
            $table->dropColumn([
                'type', 'method', 'location', 'meeting_link',
                'repeat', 'repeat_until', 'is_parent'
            ]);
        });
    }
};

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
    Schema::table('publications', function (Blueprint $table) {
        $table->unsignedBigInteger('shares')->default(0)->after('views');
        $table->unsignedBigInteger('comments_count')->default(0)->after('shares'); // Agregat untuk efisiensi
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publications', function (Blueprint $table) {
            //
        });
    }
};

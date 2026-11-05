<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_portfolio_organizations_table.php
public function up(): void {
    Schema::create('portfolio_organizations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('organization_name');
        $table->string('position'); // Contoh: Founder, Director, Coordinator
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->text('contribution_desc')->nullable(); // Dampak yang dihasilkan
        $table->string('org_logo')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_organizations');
    }
};

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
    Schema::create('campaigns', function (Blueprint $table) {
        $table->id();
        $table->json('title'); // Pastikan ini ada
        $table->string('slug')->unique();
        $table->json('description'); // Pastikan ini ada
        $table->decimal('target_amount', 15, 2);
        $table->decimal('current_amount', 15, 2)->default(0);
        $table->date('end_date');
        $table->string('image')->nullable();
        $table->enum('status', ['active', 'completed', 'paused'])->default('active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};

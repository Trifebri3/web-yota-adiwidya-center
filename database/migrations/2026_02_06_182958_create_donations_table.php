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
    // PASTIKAN INI ADALAH 'donations', BUKAN 'campaigns'
    Schema::create('donations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('campaign_id')->constrained()->onDelete('cascade');
        $table->string('external_id')->nullable(); // Untuk Order ID Midtrans
        $table->string('donor_name');
        $table->string('donor_email');
        $table->decimal('amount', 15, 2);
        $table->string('status')->default('pending'); // pending, success, failed
        $table->string('snap_token')->nullable();
        $table->string('payment_type')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};

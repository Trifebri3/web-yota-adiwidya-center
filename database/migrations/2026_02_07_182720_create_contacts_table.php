<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
// database/migrations/xxxx_xx_xx_create_contacts_table.php
public function up(): void {
    Schema::create('contacts', function (Blueprint $table) {
        $table->id();
        $table->string('sender_name');
        $table->string('sender_email');
        $table->string('subject');
        $table->text('message_body');
        $table->boolean('is_read')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void {
    Schema::create('portfolios', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('project_name');
        $table->string('slug')->unique();
        $table->enum('type', ['web', 'iot', 'robotics', 'social']);
        $table->string('my_role')->nullable();
        $table->text('short_description')->nullable();
        $table->string('thumbnail_url')->nullable();
        $table->string('external_link')->nullable(); // Demo/Github
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};

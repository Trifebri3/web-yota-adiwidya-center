<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up() {
    Schema::create('workspace_tasks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('workspace_id')->constrained()->onDelete('cascade');
        $table->foreignId('assignee_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('creator_id')->constrained('users')->onDelete('cascade');
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('category');
        $table->string('instruction_link')->nullable();
        $table->string('submission_link')->nullable();
        $table->datetime('due_date');
        $table->enum('status', ['to-do', 'doing', 'submitted', 'revision', 'acc'])->default('to-do');
        $table->timestamp('last_viewed_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workspace_tasks');
    }
};

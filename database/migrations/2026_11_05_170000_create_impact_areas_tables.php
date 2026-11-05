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
        Schema::create('impact_areas', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. '01', '02', ..., '06'
            $table->string('slug')->unique(); // e.g. 'youth-development'
            $table->string('name');            // e.g. 'Youth Development'
            $table->string('tagline')->nullable();
            $table->string('color', 20)->default('#0361a4'); // Hex color
            $table->string('logo')->nullable();  // Path ke logo (public/pilar/... atau storage)
            $table->string('motif')->nullable(); // Path ke motif poster
            $table->string('banner')->nullable();
            $table->text('description')->nullable();
            $table->json('focus_areas')->nullable();
            $table->json('example_programs')->nullable();
            $table->text('target_beneficiaries')->nullable();
            $table->text('strategic_direction')->nullable();
            $table->text('expected_outcomes')->nullable();

            // 5W1H Fields
            $table->text('what_desc')->nullable();
            $table->text('why_desc')->nullable();
            $table->text('who_desc')->nullable();
            $table->text('where_desc')->nullable();
            $table->text('when_desc')->nullable();
            $table->text('how_desc')->nullable();

            // Stats Cache
            $table->json('stats')->nullable();

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Pivot table many-to-many Program & ImpactArea
        Schema::create('program_impact_areas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete();
            $table->foreignId('impact_area_id')->constrained('impact_areas')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['program_id', 'impact_area_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_impact_areas');
        Schema::dropIfExists('impact_areas');
    }
};


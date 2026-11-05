<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('banner_image'); // Path untuk banner kegiatan

            // Pengelola (CMO)
            $table->string('published_by')->default('CMO Office');

            // Detail Program
            $table->text('goal'); // Tujuan
            $table->text('target_audience'); // Sasaran
            $table->text('methodology'); // Metodologi

            // Lokasi
            $table->string('location_name');
            $table->string('location_link'); // URL Google Maps
            $table->string('coordinates'); // Latitude, Longitude

            // Kuota & Target
            $table->integer('quota_total')->default(0);
            $table->integer('quota_used')->default(0);
            $table->decimal('target_amount', 15, 2)->default(0);
            $table->decimal('current_amount', 15, 2)->default(0);

            // Waktu & Status
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->enum('status', ['upcoming', 'ongoing', 'history'])->default('upcoming');

            // Dampak (Bisa diisi setelah program selesai/history)
            $table->text('impact_summary')->nullable();
            $table->json('impact_stats')->nullable(); // Data statistik dalam bentuk JSON
            $table->text('curated_story')->nullable(); // Cerita dampak terkurasi

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};

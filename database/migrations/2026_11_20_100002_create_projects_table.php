<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title_uz');
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();

            $table->text('description_uz')->nullable();
            $table->text('description_ru')->nullable();
            $table->text('description_en')->nullable();

            $table->string('category')->default('reels'); // reels, commercial, event, brand
            $table->string('aspect_ratio')->default('vertical'); // vertical (9:16), horizontal (16:9)
            $table->string('client_name')->nullable();
            $table->string('duration')->nullable(); // e.g. 0:45
            $table->string('views_count')->nullable(); // e.g. 1.4M
            $table->string('year', 10)->default('2026');
            $table->string('camera_spec')->nullable(); // e.g. iPhone 16 Pro · 4K 60fps
            $table->string('thumbnail_path')->nullable();
            $table->string('video_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

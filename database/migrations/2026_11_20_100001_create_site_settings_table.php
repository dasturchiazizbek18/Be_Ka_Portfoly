<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name')->default('Erkinjonov Bexruz');
            $table->string('logo_path')->nullable();
            $table->string('hero_image_path')->nullable();
            $table->string('showreel_url')->nullable();
            $table->boolean('is_available')->default(true);

            $table->string('status_text_uz')->default('Syomka uchun ochiqman');
            $table->string('status_text_ru')->default('Открыт для съёмок');
            $table->string('status_text_en')->default('Available for shoots');

            $table->string('role_title_uz')->default('Mobilograf');
            $table->string('role_title_ru')->default('Мобилограф');
            $table->string('role_title_en')->default('Mobilographer');

            $table->string('hero_eyebrow_uz')->default('4K · 60FPS · MOBILOGRAFIYA & REELS');
            $table->string('hero_eyebrow_ru')->default('4K · 60FPS · МОБИЛОГРАФИЯ И REELS');
            $table->string('hero_eyebrow_en')->default('4K · 60FPS · MOBILOGRAPHY & REELS');

            $table->text('hero_bio_uz')->nullable();
            $table->text('hero_bio_ru')->nullable();
            $table->text('hero_bio_en')->nullable();

            $table->string('about_title_uz')->nullable();
            $table->string('about_title_ru')->nullable();
            $table->string('about_title_en')->nullable();

            $table->text('about_text_uz')->nullable();
            $table->text('about_text_ru')->nullable();
            $table->text('about_text_en')->nullable();

            $table->string('stat_projects')->default('120+');
            $table->string('stat_clients')->default('45+');
            $table->string('stat_views')->default('8M+');
            $table->string('stat_experience')->default('3+');

            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('telegram')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('location_uz')->default("Toshkent, O'zbekiston");
            $table->string('location_ru')->default('Ташкент, Узбекистан');
            $table->string('location_en')->default('Tashkent, Uzbekistan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasTranslations;

    protected $fillable = [
        'brand_name',
        'logo_path',
        'hero_image_path',
        'showreel_url',
        'is_available',
        'status_text_uz',
        'status_text_ru',
        'status_text_en',
        'role_title_uz',
        'role_title_ru',
        'role_title_en',
        'hero_eyebrow_uz',
        'hero_eyebrow_ru',
        'hero_eyebrow_en',
        'hero_bio_uz',
        'hero_bio_ru',
        'hero_bio_en',
        'about_title_uz',
        'about_title_ru',
        'about_title_en',
        'about_text_uz',
        'about_text_ru',
        'about_text_en',
        'stat_projects',
        'stat_clients',
        'stat_views',
        'stat_experience',
        'phone',
        'email',
        'telegram',
        'telegram_channel',
        'instagram',
        'youtube',
        'location_uz',
        'location_ru',
        'location_en',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public static function current(): self
    {
        return static::first() ?? static::create([
            'brand_name' => 'Erkinjonov Bexruz',
        ]);
    }

    /**
     * Resolve logo URL: checks DB uploaded logo first, then drop-in public/images/logo.{svg,png,webp,jpg}.
     */
    public function resolvedLogoUrl(): ?string
    {
        if ($this->logo_path) {
            if (str_starts_with($this->logo_path, 'http://') || str_starts_with($this->logo_path, 'https://')) {
                return $this->logo_path;
            }
            if (file_exists(public_path('storage/' . $this->logo_path))) {
                return asset('storage/' . $this->logo_path);
            }
            if (file_exists(public_path($this->logo_path))) {
                return asset($this->logo_path);
            }
        }

        foreach (['images/logo.svg', 'images/logo.png', 'images/logo.webp', 'images/logo.jpg'] as $candidate) {
            if (file_exists(public_path($candidate))) {
                return asset($candidate);
            }
        }

        return null;
    }

    /**
     * Resolve compact emblem mark URL for navbar, footer, admin sidebar, and favicon.
     */
    public function resolvedLogoMarkUrl(): ?string
    {
        if ($this->logo_path) {
            return $this->resolvedLogoUrl();
        }

        if (file_exists(public_path('images/logo-mark.png'))) {
            return asset('images/logo-mark.png');
        }

        return $this->resolvedLogoUrl();
    }

    public function heroImageUrl(): ?string
    {
        if ($this->hero_image_path) {
            if (str_starts_with($this->hero_image_path, 'http')) {
                return $this->hero_image_path;
            }
            if (file_exists(public_path('storage/' . $this->hero_image_path))) {
                return asset('storage/' . $this->hero_image_path);
            }
        }

        if (file_exists(public_path('images/hero-person.png'))) {
            return asset('images/hero-person.png');
        }

        return null;
    }
}

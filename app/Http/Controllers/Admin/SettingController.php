<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'setting' => SiteSetting::current(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $setting = SiteSetting::current();

        $validated = $request->validate([
            'brand_name' => ['required', 'string', 'max:120'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:4096'],
            'hero_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:6144'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_hero_image' => ['nullable', 'boolean'],
            'showreel_url' => ['nullable', 'string', 'max:500'],
            'is_available' => ['nullable', 'boolean'],
            'status_text_uz' => ['nullable', 'string', 'max:120'],
            'status_text_ru' => ['nullable', 'string', 'max:120'],
            'status_text_en' => ['nullable', 'string', 'max:120'],
            'role_title_uz' => ['nullable', 'string', 'max:120'],
            'role_title_ru' => ['nullable', 'string', 'max:120'],
            'role_title_en' => ['nullable', 'string', 'max:120'],
            'hero_eyebrow_uz' => ['nullable', 'string', 'max:150'],
            'hero_eyebrow_ru' => ['nullable', 'string', 'max:150'],
            'hero_eyebrow_en' => ['nullable', 'string', 'max:150'],
            'hero_bio_uz' => ['nullable', 'string', 'max:1000'],
            'hero_bio_ru' => ['nullable', 'string', 'max:1000'],
            'hero_bio_en' => ['nullable', 'string', 'max:1000'],
            'about_title_uz' => ['nullable', 'string', 'max:200'],
            'about_title_ru' => ['nullable', 'string', 'max:200'],
            'about_title_en' => ['nullable', 'string', 'max:200'],
            'about_text_uz' => ['nullable', 'string', 'max:3000'],
            'about_text_ru' => ['nullable', 'string', 'max:3000'],
            'about_text_en' => ['nullable', 'string', 'max:3000'],
            'stat_projects' => ['nullable', 'string', 'max:30'],
            'stat_clients' => ['nullable', 'string', 'max:30'],
            'stat_views' => ['nullable', 'string', 'max:30'],
            'stat_experience' => ['nullable', 'string', 'max:30'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:120'],
            'telegram' => ['nullable', 'string', 'max:255'],
            'telegram_channel' => ['nullable', 'string', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'youtube' => ['nullable', 'string', 'max:255'],
            'location_uz' => ['nullable', 'string', 'max:120'],
            'location_ru' => ['nullable', 'string', 'max:120'],
            'location_en' => ['nullable', 'string', 'max:120'],
        ]);

        $data = collect($validated)->except(['logo', 'hero_image', 'remove_logo', 'remove_hero_image'])->toArray();
        $data['is_available'] = $request->boolean('is_available');

        if ($request->boolean('remove_logo') && $setting->logo_path) {
            Storage::disk('public')->delete($setting->logo_path);
            $data['logo_path'] = null;
        }

        if ($request->hasFile('logo')) {
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('logos', 'public');
        }

        if ($request->boolean('remove_hero_image') && $setting->hero_image_path) {
            Storage::disk('public')->delete($setting->hero_image_path);
            $data['hero_image_path'] = null;
        }

        if ($request->hasFile('hero_image')) {
            if ($setting->hero_image_path) {
                Storage::disk('public')->delete($setting->hero_image_path);
            }
            $data['hero_image_path'] = $request->file('hero_image')->store('hero', 'public');
        }

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Sozlamalar va logotip muvaffaqiyatli saqlandi.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $setting = SiteSetting::current();
        $projects = Project::orderBy('sort_order')->orderByDesc('id')->get();
        $skills = Skill::where('type', 'skill')->orderBy('sort_order')->get();
        $gears = Skill::where('type', 'gear')->orderBy('sort_order')->get();
        $services = Service::orderBy('sort_order')->get();
        $experiences = Experience::orderBy('sort_order')->get();

        return view('portfolio.index', compact(
            'setting',
            'projects',
            'skills',
            'gears',
            'services',
            'experiences'
        ));
    }

    public function switchLocale(string $locale): RedirectResponse
    {
        if (in_array($locale, SetLocale::SUPPORTED, true)) {
            session(['locale' => $locale]);
        }

        return back();
    }

    public function storeContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:160'],
            'service_type' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return redirect()
            ->to(route('home') . '#contact')
            ->with('contact_success', __('contact.success'));
    }
}

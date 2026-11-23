<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function index(): View
    {
        return view('admin.experiences.index', [
            'experiences' => Experience::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.experiences.form', [
            'experience' => new Experience(['sort_order' => 0]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Experience::create($this->validateExperience($request));

        return redirect()->route('admin.experiences.index')->with('success', "Tajriba yozuvi qo'shildi.");
    }

    public function edit(Experience $experience): View
    {
        return view('admin.experiences.form', compact('experience'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $experience->update($this->validateExperience($request));

        return redirect()->route('admin.experiences.index')->with('success', 'Tajriba yozuvi yangilandi.');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('admin.experiences.index')->with('success', "Tajriba yozuvi o'chirildi.");
    }

    private function validateExperience(Request $request): array
    {
        $validated = $request->validate([
            'period' => ['required', 'string', 'max:60'],
            'company' => ['required', 'string', 'max:150'],
            'role_uz' => ['required', 'string', 'max:150'],
            'role_ru' => ['nullable', 'string', 'max:150'],
            'role_en' => ['nullable', 'string', 'max:150'],
            'description_uz' => ['nullable', 'string', 'max:1500'],
            'description_ru' => ['nullable', 'string', 'max:1500'],
            'description_en' => ['nullable', 'string', 'max:1500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}

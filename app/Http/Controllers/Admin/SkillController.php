<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    public function index(): View
    {
        return view('admin.skills.index', [
            'skills' => Skill::orderBy('type')->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateSkill($request);
        Skill::create($data);

        return redirect()->route('admin.skills.index')->with('success', "Ko'nikma / texnika qo'shildi.");
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $data = $this->validateSkill($request);
        $skill->update($data);

        return redirect()->route('admin.skills.index')->with('success', 'Yangilandi.');
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('success', "O'chirildi.");
    }

    private function validateSkill(Request $request): array
    {
        $validated = $request->validate([
            'name_uz' => ['required', 'string', 'max:120'],
            'name_ru' => ['nullable', 'string', 'max:120'],
            'name_en' => ['nullable', 'string', 'max:120'],
            'subtitle_uz' => ['nullable', 'string', 'max:160'],
            'subtitle_ru' => ['nullable', 'string', 'max:160'],
            'subtitle_en' => ['nullable', 'string', 'max:160'],
            'type' => ['required', 'in:skill,gear'],
            'level' => ['required', 'integer', 'min:10', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}

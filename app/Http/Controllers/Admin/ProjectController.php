<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('admin.projects.index', [
            'projects' => Project::orderBy('sort_order')->orderByDesc('id')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.form', [
            'project' => new Project(['aspect_ratio' => 'vertical', 'category' => 'reels', 'year' => date('Y'), 'sort_order' => 0]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateProject($request);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail_path'] = $request->file('thumbnail')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')->with('success', "Loyiha muvaffaqiyatli qo'shildi.");
    }

    public function edit(Project $project): View
    {
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validateProject($request);

        if ($request->boolean('remove_thumbnail') && $project->thumbnail_path) {
            Storage::disk('public')->delete($project->thumbnail_path);
            $data['thumbnail_path'] = null;
        }

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail_path) {
                Storage::disk('public')->delete($project->thumbnail_path);
            }
            $data['thumbnail_path'] = $request->file('thumbnail')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')->with('success', 'Loyiha yangilandi.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        if ($project->thumbnail_path) {
            Storage::disk('public')->delete($project->thumbnail_path);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', "Loyiha o'chirildi.");
    }

    private function validateProject(Request $request): array
    {
        $validated = $request->validate([
            'title_uz' => ['required', 'string', 'max:200'],
            'title_ru' => ['nullable', 'string', 'max:200'],
            'title_en' => ['nullable', 'string', 'max:200'],
            'description_uz' => ['nullable', 'string', 'max:2000'],
            'description_ru' => ['nullable', 'string', 'max:2000'],
            'description_en' => ['nullable', 'string', 'max:2000'],
            'category' => ['required', 'in:reels,commercial,event,brand'],
            'aspect_ratio' => ['required', 'in:vertical,horizontal'],
            'client_name' => ['nullable', 'string', 'max:120'],
            'duration' => ['nullable', 'string', 'max:20'],
            'views_count' => ['nullable', 'string', 'max:30'],
            'year' => ['nullable', 'string', 'max:10'],
            'camera_spec' => ['nullable', 'string', 'max:120'],
            'video_url' => ['nullable', 'string', 'max:500'],
            'thumbnail' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:5120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $data = collect($validated)->except(['thumbnail'])->toArray();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['sort_order'] = $validated['sort_order'] ?? 0;

        return $data;
    }
}

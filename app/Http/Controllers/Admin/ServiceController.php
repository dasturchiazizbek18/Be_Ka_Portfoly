<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::orderBy('sort_order')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', [
            'service' => new Service(['sort_order' => 0]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        Service::create($this->validateService($request));

        return redirect()->route('admin.services.index')->with('success', "Xizmat paketi qo'shildi.");
    }

    public function edit(Service $service): View
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->update($this->validateService($request));

        return redirect()->route('admin.services.index')->with('success', 'Xizmat paketi yangilandi.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', "Xizmat paketi o'chirildi.");
    }

    private function validateService(Request $request): array
    {
        $validated = $request->validate([
            'title_uz' => ['required', 'string', 'max:150'],
            'title_ru' => ['nullable', 'string', 'max:150'],
            'title_en' => ['nullable', 'string', 'max:150'],
            'description_uz' => ['nullable', 'string', 'max:1000'],
            'description_ru' => ['nullable', 'string', 'max:1000'],
            'description_en' => ['nullable', 'string', 'max:1000'],
            'price_label' => ['nullable', 'string', 'max:60'],
            'features_uz' => ['nullable', 'string', 'max:2000'],
            'features_ru' => ['nullable', 'string', 'max:2000'],
            'features_en' => ['nullable', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['is_popular'] = $request->boolean('is_popular');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}

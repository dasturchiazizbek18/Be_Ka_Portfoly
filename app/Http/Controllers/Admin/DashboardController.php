<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Skill;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'setting' => SiteSetting::current(),
            'stats' => [
                'projects' => Project::count(),
                'services' => Service::count(),
                'skills' => Skill::count(),
                'experiences' => Experience::count(),
                'unread_messages' => ContactMessage::where('is_read', false)->count(),
                'total_messages' => ContactMessage::count(),
            ],
            'recentMessages' => ContactMessage::latest()->take(5)->get(),
            'recentProjects' => Project::orderBy('sort_order')->orderByDesc('id')->take(4)->get(),
        ]);
    }
}

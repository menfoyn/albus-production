<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteSetting;

class AboutController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        $projects = Project::where('is_active', true)
            ->where('show_on_about', true)
            ->orderBy('order')
            ->take(3)
            ->get();

        return view('frontend.about', compact('settings', 'projects'));
    }
}

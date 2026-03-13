<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Project;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $heroSlides = HeroSlide::where('is_active', true)->orderBy('order')->get();
        $featuredProjects = Project::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('order')
            ->take(6)
            ->get();
        $services = Service::where('is_active', true)->orderBy('order')->take(4)->get();

        return view('frontend.home', compact('heroSlides', 'featuredProjects', 'services'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index(Request $request)
    {
        $cat = $request->query('cat');

        $query = Project::where('is_active', true)->orderBy('order');

        if ($cat && $cat !== 'all') {
            $query->where('category', $cat);
        }

        $projects = $query->get();

        // Kategoriler — tab listesi
        $tabs = [
            ['key' => 'all',       'label' => 'Tüm İşler'],
            ['key' => 'konser',    'label' => 'Konser & Festival & Tiyatro'],
            ['key' => 'toplanti',  'label' => 'Toplantı & Konferans'],
            ['key' => 'lansman',   'label' => 'Lansman & Gala & Sergi'],
            ['key' => 'fuar',      'label' => 'Fuar & Stand Uygulamaları'],
        ];

        $activeCat = $cat ?: 'all';

        return view('frontend.portfolio', compact('projects', 'tabs', 'activeCat'));
    }

    public function show(Project $project)
    {
        $project->load('media');
        $related = Project::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->orderBy('order')
            ->take(3)
            ->get();
        return view('frontend.project-detail', compact('project', 'related'));
    }
}

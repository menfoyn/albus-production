<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'cover_image'       => 'nullable|image|max:20480',
            'order'             => 'nullable|integer',
            'is_active'         => 'boolean',
        ]);

        $validated['slug']      = Str::slug($validated['title']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('services', 'public');
        }

        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla eklendi.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'cover_image'       => 'nullable|image|max:20480',
            'order'             => 'nullable|integer',
            'is_active'         => 'boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($service->cover_image) Storage::disk('public')->delete($service->cover_image);
            $validated['cover_image'] = $request->file('cover_image')->store('services', 'public');
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Hizmet güncellendi.');
    }

    public function destroy(Service $service)
    {
        if ($service->cover_image) Storage::disk('public')->delete($service->cover_image);
        $service->delete();
        return back()->with('success', 'Hizmet silindi.');
    }
}

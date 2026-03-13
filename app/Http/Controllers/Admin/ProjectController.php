<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('order')->orderBy('created_at', 'desc')->get();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.form');
    }

    public function store(Request $request)
    {
        // POST verisi boşsa (PHP upload limiti aşıldığında olur)
        if (empty($request->input('title'))) {
            return back()->with('error', 'Form verisi alınamadı. Dosya boyutu çok büyük olabilir. Lütfen daha küçük dosyalar deneyin veya tek tek yükleyin.')
                         ->withInput();
        }

        $request->validate([
            'title'             => 'required|string|max:255',
            'client'            => 'nullable|string|max:255',
            'category'          => 'required|string|max:100',
            'short_label'       => 'nullable|string|max:100',
            'location'          => 'nullable|string|max:255',
            'date'              => 'nullable|string|max:50',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'cover_image'       => 'nullable|image|max:20480',
            'hero_video'        => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:512000',
            'intro_video'       => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:512000',
            'intro_image'       => 'nullable|image|max:20480',
            'quote_text'        => 'nullable|string|max:1000',
            'hero_image_position' => 'nullable|string|max:50',
            'hero_image_zoom'   => 'nullable|numeric|min:0.1|max:2',
            'color'             => 'nullable|string|max:20',
            'is_featured'       => 'boolean',
            'show_on_about'     => 'boolean',
            'order'             => 'nullable|integer',
            'is_active'         => 'boolean',
            'media_files.*'     => 'nullable|file|max:512000',
        ]);

        // Sadece text alanlarını al (dosya alanlarını hariç tut)
        $data = $request->only([
            'title', 'client', 'category', 'short_label', 'location', 'date',
            'short_description', 'description', 'quote_text',
            'hero_image_position', 'hero_image_zoom', 'color',
        ]);

        $data['slug'] = Str::slug($data['title']);
        // Unique slug
        $count = 1;
        $originalSlug = $data['slug'];
        while (Project::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count++;
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        if ($request->hasFile('hero_video')) {
            $data['hero_video'] = $request->file('hero_video')->store('projects/videos', 'public');
        }

        if ($request->hasFile('intro_video')) {
            $data['intro_video'] = $request->file('intro_video')->store('projects/videos', 'public');
        }

        if ($request->hasFile('intro_image')) {
            $data['intro_image'] = $request->file('intro_image')->store('projects/images', 'public');
        }

        $data['is_featured']   = $request->boolean('is_featured');
        $data['show_on_about'] = $request->boolean('show_on_about');
        $data['is_active']     = $request->boolean('is_active', true);
        $data['order']         = $request->input('order', 0);

        $project = Project::create($data);

        // Medya dosyaları
        if ($request->hasFile('media_files')) {
            foreach ($request->file('media_files') as $index => $file) {
                $type = str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image';
                $path = $file->store('projects/media', 'public');
                ProjectMedia::create([
                    'project_id' => $project->id,
                    'file_path'  => $path,
                    'type'       => $type,
                    'order'      => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla eklendi.');
    }

    public function edit(Project $project)
    {
        $project->load('media');
        return view('admin.projects.form', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        // POST verisi boşsa (PHP upload limiti aşıldığında olur) güncelleme yapma
        if (empty($request->input('title')) && empty($request->all())) {
            return back()->with('error', 'Form verisi alınamadı. Dosya boyutu çok büyük olabilir. Lütfen daha küçük dosyalar deneyin veya tek tek yükleyin.')
                         ->withInput();
        }

        $request->validate([
            'title'             => 'required|string|max:255',
            'client'            => 'nullable|string|max:255',
            'category'          => 'required|string|max:100',
            'short_label'       => 'nullable|string|max:100',
            'location'          => 'nullable|string|max:255',
            'date'              => 'nullable|string|max:50',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'cover_image'       => 'nullable|image|max:20480',
            'hero_video'        => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:512000',
            'intro_video'       => 'nullable|file|mimetypes:video/mp4,video/quicktime,video/webm|max:512000',
            'intro_image'       => 'nullable|image|max:20480',
            'quote_text'        => 'nullable|string|max:1000',
            'hero_image_position' => 'nullable|string|max:50',
            'hero_image_zoom'   => 'nullable|numeric|min:0.1|max:2',
            'color'             => 'nullable|string|max:20',
            'is_featured'       => 'boolean',
            'show_on_about'     => 'boolean',
            'order'             => 'nullable|integer',
            'is_active'         => 'boolean',
            'media_files.*'     => 'nullable|file|max:512000',
        ]);

        // Sadece text alanlarını al (dosya alanlarını hariç tut)
        $data = $request->only([
            'title', 'client', 'category', 'short_label', 'location', 'date',
            'short_description', 'description', 'quote_text',
            'hero_image_position', 'hero_image_zoom', 'color',
        ]);

        $data['is_featured']   = $request->boolean('is_featured');
        $data['show_on_about'] = $request->boolean('show_on_about');
        $data['is_active']     = $request->boolean('is_active', true);
        $data['order']         = $request->input('order', 0);

        // Dosya alanları — yalnızca yeni dosya yüklendiyse güncelle
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::disk('public')->delete($project->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        if ($request->hasFile('hero_video')) {
            if ($project->hero_video) {
                Storage::disk('public')->delete($project->hero_video);
            }
            $data['hero_video'] = $request->file('hero_video')->store('projects/videos', 'public');
        }

        if ($request->hasFile('intro_video')) {
            if ($project->intro_video) {
                Storage::disk('public')->delete($project->intro_video);
            }
            $data['intro_video'] = $request->file('intro_video')->store('projects/videos', 'public');
        }

        if ($request->hasFile('intro_image')) {
            if ($project->intro_image) {
                Storage::disk('public')->delete($project->intro_image);
            }
            $data['intro_image'] = $request->file('intro_image')->store('projects/images', 'public');
        }

        // Slug güncelle (eğer başlık değiştiyse)
        $newTitle = $request->input('title');
        if ($newTitle && $newTitle !== $project->title) {
            $slug = Str::slug($newTitle);
            if (empty($slug)) {
                $slug = Str::slug($project->title); // fallback: mevcut slug'ı koru
            }
            $count = 1;
            $originalSlug = $slug;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            $data['slug'] = $slug;
        }

        $project->update($data);

        // Yeni medya dosyaları
        if ($request->hasFile('media_files')) {
            $currentMax = $project->media()->max('order') ?? -1;
            foreach ($request->file('media_files') as $index => $file) {
                $type = str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image';
                $path = $file->store('projects/media', 'public');
                ProjectMedia::create([
                    'project_id' => $project->id,
                    'file_path'  => $path,
                    'type'       => $type,
                    'order'      => $currentMax + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')->with('success', 'Proje başarıyla güncellendi.');
    }

    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::disk('public')->delete($project->cover_image);
        }
        if ($project->hero_video) {
            Storage::disk('public')->delete($project->hero_video);
        }
        if ($project->intro_video) {
            Storage::disk('public')->delete($project->intro_video);
        }
        if ($project->intro_image) {
            Storage::disk('public')->delete($project->intro_image);
        }
        foreach ($project->media as $media) {
            Storage::disk('public')->delete($media->file_path);
        }
        $project->delete();
        return back()->with('success', 'Proje silindi.');
    }

    public function destroyMedia(Request $request, ProjectMedia $media)
    {
        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Medya silindi.');
    }
}

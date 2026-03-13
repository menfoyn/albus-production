<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('order')->get();
        return view('admin.hero.index', compact('slides'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'file'     => 'required|file|max:51200',
            'alt_text' => 'nullable|string|max:255',
            'order'    => 'nullable|integer',
        ]);

        $file = $request->file('file');
        $type = str_starts_with($file->getMimeType(), 'video') ? 'video' : 'image';
        $path = $file->store('hero', 'public');

        HeroSlide::create([
            'file_path' => $path,
            'type'      => $type,
            'alt_text'  => $request->input('alt_text'),
            'order'     => $request->input('order', HeroSlide::max('order') + 1),
            'is_active' => true,
        ]);

        return back()->with('success', 'Medya başarıyla eklendi.');
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $heroSlide->update([
            'alt_text'  => $request->input('alt_text'),
            'order'     => $request->input('order', $heroSlide->order),
            'is_active' => $request->boolean('is_active', true),
        ]);
        return back()->with('success', 'Güncellendi.');
    }

    public function destroy(HeroSlide $heroSlide)
    {
        Storage::disk('public')->delete($heroSlide->file_path);
        $heroSlide->delete();
        return back()->with('success', 'Medya silindi.');
    }
}

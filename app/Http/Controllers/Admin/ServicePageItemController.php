<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServicePageItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicePageItemController extends Controller
{
    public function index()
    {
        $items = ServicePageItem::orderBy('order')->get();
        return view('admin.service-page-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.service-page-items.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'bullets'     => 'nullable|string',
            'image'       => 'nullable|image|max:20480',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        // Maddeleri satır satır parse et
        $validated['bullets'] = $this->parseBullets($request->input('bullets'));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('service-page', 'public');
        }

        ServicePageItem::create($validated);

        return redirect()->route('admin.service-page-items.index')
                         ->with('success', 'Hizmet bloğu başarıyla eklendi.');
    }

    public function edit(ServicePageItem $servicePageItem)
    {
        return view('admin.service-page-items.form', ['item' => $servicePageItem]);
    }

    public function update(Request $request, ServicePageItem $servicePageItem)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'bullets'     => 'nullable|string',
            'image'       => 'nullable|image|max:20480',
            'order'       => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order']     = $request->input('order', 0);

        // Maddeleri satır satır parse et
        $validated['bullets'] = $this->parseBullets($request->input('bullets'));

        if ($request->hasFile('image')) {
            if ($servicePageItem->image) {
                Storage::disk('public')->delete($servicePageItem->image);
            }
            $validated['image'] = $request->file('image')->store('service-page', 'public');
        }

        $servicePageItem->update($validated);

        return redirect()->route('admin.service-page-items.index')
                         ->with('success', 'Hizmet bloğu güncellendi.');
    }

    public function destroy(ServicePageItem $servicePageItem)
    {
        if ($servicePageItem->image) {
            Storage::disk('public')->delete($servicePageItem->image);
        }
        $servicePageItem->delete();

        return back()->with('success', 'Hizmet bloğu silindi.');
    }

    /**
     * Textarea'dan gelen satırları JSON-uyumlu diziye çevir.
     */
    private function parseBullets(?string $raw): array
    {
        if (!$raw) return [];

        return array_values(
            array_filter(
                array_map('trim', explode("\n", $raw))
            )
        );
    }
}

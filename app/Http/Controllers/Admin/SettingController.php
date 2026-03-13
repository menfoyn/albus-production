<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_logo'   => 'nullable|image|max:5120',
            'footer_logo' => 'nullable|image|max:5120',
            'footer_bg'   => 'nullable|image|max:20480',
            'about_image' => 'nullable|image|max:51200',
        ]);

        $keys = [
            'site_name', 'site_tagline', 'contact_email', 'contact_phone',
            'contact_address', 'instagram_url', 'footer_text',
            // Biz Kimiz sayfası
            'about_description',
            'mission_subtitle', 'mission_text',
            'vision_text_1', 'vision_text_2',
        ];

        foreach ($keys as $key) {
            if ($request->has($key)) {
                SiteSetting::set($key, $request->input($key));
            }
        }

        // Logo, arka plan ve görsel dosyaları
        foreach (['site_logo', 'footer_logo', 'footer_bg', 'about_image'] as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $old = SiteSetting::get($fileKey);
                if ($old) {
                    Storage::disk('public')->delete($old);
                }
                $folder = $fileKey === 'about_image' ? 'about' : 'logos';
                $path = $request->file($fileKey)->store($folder, 'public');
                SiteSetting::set($fileKey, $path);
            }
        }

        return back()->with('success', 'Ayarlar güncellendi.');
    }
}

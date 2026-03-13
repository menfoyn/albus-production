<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcı
        User::updateOrCreate(
            ['email' => 'admin@albusproduction.com'],
            [
                'name'     => 'Albus Admin',
                'password' => Hash::make('albus2024!'),
                'is_admin' => true,
            ]
        );

        // Site ayarları
        $settings = [
            'site_name'       => 'Albus Production',
            'site_tagline'    => 'Etkinlik ve sahne prodüksiyonuna dair tüm süreçlerde; ileri teknoloji ile yaratıcı prodüksiyon çözümleri sunan profesyonel bir ekibiz.',
            'contact_email'   => 'info@albusproduction.com',
            'contact_phone'   => '+90 xxx xxx xx xx',
            'contact_address' => 'Çırçır Mah. Tatlıkuyu Cad. Tatlıkuyu OSB Blok No:17/A05, İç Kapı No:712, 34235, Esenler/İstanbul',
            'instagram_url'   => 'https://www.instagram.com/albusproduction',
            'footer_text'     => '© 2024 Albus Production. Tüm hakları saklıdır.',
        ];
        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Örnek Projeler
        $projects = [
            [
                'title'             => 'Binghattı',
                'slug'              => 'binghatti',
                'client'            => 'Binghattı',
                'category'          => 'Lansman',
                'short_description' => 'Binghattı Stüdyoda Lansman Projesi, Ricca Tersanesi',
                'color'             => '#E8001C',
                'is_featured'       => true,
                'order'             => 1,
            ],
            [
                'title'             => 'Kültür Bakanlığı',
                'slug'              => 'kultur-bakanligi',
                'client'            => 'Kültür Bakanlığı',
                'category'          => 'Ödül Gecesi',
                'short_description' => '"Umudun İşleri" Fotoğraf Yarışması, Rami Kütüphanesi',
                'color'             => '#0B2FCA',
                'is_featured'       => true,
                'order'             => 2,
            ],
            [
                'title'             => 'Türk Telekom',
                'slug'              => 'turk-telekom',
                'client'            => 'Türk Telekom',
                'category'          => 'Sergi',
                'short_description' => 'Dijital Tasarım Sergisi, Atatürk Kültür Merkezi',
                'color'             => '#E8001C',
                'is_featured'       => true,
                'order'             => 3,
            ],
        ];

        foreach ($projects as $p) {
            Project::updateOrCreate(['slug' => $p['slug']], $p + ['is_active' => true]);
        }

        // Örnek Hizmetler
        $services = [
            ['title' => '3D Sahne Tasarımı', 'slug' => '3d-sahne-tasarimi', 'short_description' => 'Etkinlik ve prodüksiyon süreçlerinde mekanın tüm dinamiklerini ortadan kaldırmayı sağlayan profesyonel 3D sahne tasarımları oluşturuyoruz.', 'order' => 1],
            ['title' => 'LED Ekran Çözümleri', 'slug' => 'led-ekran-cozumleri', 'short_description' => 'Her boyut ve formatta özel LED ekran tasarımı ve kurulumu.', 'order' => 2],
            ['title' => 'Işık & Ses Tasarımı', 'slug' => 'isik-ses-tasarimi', 'short_description' => 'Profesyonel ışık ve ses sistemleriyle etkinliğinizi zirveye taşıyın.', 'order' => 3],
            ['title' => 'Dijital İçerik Üretimi', 'slug' => 'dijital-icerik-uretimi', 'short_description' => 'Etkinlikleriniz için özel dijital içerik ve görsel tasarım.', 'order' => 4],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['slug' => $s['slug']], $s + ['is_active' => true]);
        }
    }
}

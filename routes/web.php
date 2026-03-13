<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ServicePageItemController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// ─── Frontend ─────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolyo', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolyo/{project:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::get('/hizmetlerimiz', [ServiceController::class, 'index'])->name('services');
Route::get('/biz-kimiz', [AboutController::class, 'index'])->name('about');
Route::get('/iletisim', [ContactController::class, 'index'])->name('contact');
Route::post('/iletisim', [ContactController::class, 'send'])->name('contact.send');

// ─── Admin Auth ────────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/giris', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/giris', [AuthController::class, 'login'])->name('login.post');
    Route::post('/cikis', [AuthController::class, 'logout'])->name('logout');

    // ─── Admin Panel (korumalı) ───────────────────────────────────────────────
    Route::middleware(['auth', 'admin', 'check.post.size'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Projeler
        Route::get('/projeler', [AdminProjectController::class, 'index'])->name('projects.index');
        Route::get('/projeler/yeni', [AdminProjectController::class, 'create'])->name('projects.create');
        Route::post('/projeler', [AdminProjectController::class, 'store'])->name('projects.store');
        Route::get('/projeler/{project}/duzenle', [AdminProjectController::class, 'edit'])->name('projects.edit');
        Route::put('/projeler/{project}', [AdminProjectController::class, 'update'])->name('projects.update');
        Route::delete('/projeler/{project}', [AdminProjectController::class, 'destroy'])->name('projects.destroy');
        Route::delete('/proje-medya/{media}', [AdminProjectController::class, 'destroyMedia'])->name('projects.media.destroy');

        // Hizmetler
        Route::get('/hizmetler', [AdminServiceController::class, 'index'])->name('services.index');
        Route::get('/hizmetler/yeni', [AdminServiceController::class, 'create'])->name('services.create');
        Route::post('/hizmetler', [AdminServiceController::class, 'store'])->name('services.store');
        Route::get('/hizmetler/{service}/duzenle', [AdminServiceController::class, 'edit'])->name('services.edit');
        Route::put('/hizmetler/{service}', [AdminServiceController::class, 'update'])->name('services.update');
        Route::delete('/hizmetler/{service}', [AdminServiceController::class, 'destroy'])->name('services.destroy');

        // Hizmetlerimiz Sayfası Blokları
        Route::get('/hizmetler-sayfa', [ServicePageItemController::class, 'index'])->name('service-page-items.index');
        Route::get('/hizmetler-sayfa/yeni', [ServicePageItemController::class, 'create'])->name('service-page-items.create');
        Route::post('/hizmetler-sayfa', [ServicePageItemController::class, 'store'])->name('service-page-items.store');
        Route::get('/hizmetler-sayfa/{servicePageItem}/duzenle', [ServicePageItemController::class, 'edit'])->name('service-page-items.edit');
        Route::put('/hizmetler-sayfa/{servicePageItem}', [ServicePageItemController::class, 'update'])->name('service-page-items.update');
        Route::delete('/hizmetler-sayfa/{servicePageItem}', [ServicePageItemController::class, 'destroy'])->name('service-page-items.destroy');

        // Hero Slider
        Route::get('/slider', [HeroSlideController::class, 'index'])->name('hero.index');
        Route::post('/slider', [HeroSlideController::class, 'store'])->name('hero.store');
        Route::put('/slider/{heroSlide}', [HeroSlideController::class, 'update'])->name('hero.update');
        Route::delete('/slider/{heroSlide}', [HeroSlideController::class, 'destroy'])->name('hero.destroy');

        // Mesajlar
        Route::get('/mesajlar', [MessageController::class, 'index'])->name('messages.index');
        Route::get('/mesajlar/{message}', [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/mesajlar/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');

        // Ayarlar
        Route::get('/ayarlar', [SettingController::class, 'index'])->name('settings.index');
        Route::put('/ayarlar', [SettingController::class, 'update'])->name('settings.update');
    });
});

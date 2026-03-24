<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\EditorUploadController;
use App\Http\Controllers\Admin\ExternalServiceController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FlyPointController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeSeoInfoController;
use App\Http\Controllers\Admin\LegalPageController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\RoutsContentController;
use App\Http\Controllers\Admin\SeoPageController;
use App\Http\Controllers\Admin\SertificateController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StoryController;
use App\Http\Controllers\Admin\StoryMediaController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TrainingMaterialController;
use App\Http\Controllers\Admin\WhyUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParaplanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ParaplanController::class, 'welcome'])->name('welcome');

Route::get('/contacts', function () {
    return view('contacts');
})->name('contacts');

Route::get('/privacy-policy', [ParaplanController::class, 'privacyPolicy'])
    ->name('privacy-policy');

Route::get('/personal-data', [ParaplanController::class, 'personalData'])
    ->name('personal-data');

Route::get('/galereya', [ParaplanController::class, 'galereya'])->name('gallery');

Route::get('/thanks', [ParaplanController::class, 'thanks'])->name('thanks');
Route::post('/thanks', [ParaplanController::class, 'submitLead'])->name('lead.submit');

Route::get('/uslugi', [ParaplanController::class, 'uslugi'])->name('service');
Route::get('/marshruty', [ParaplanController::class, 'marshruty'])->name('marshruty');
Route::get('/stati', [ParaplanController::class, 'stati'])->name('stati');
Route::get('/stati/{slug}', [ParaplanController::class, 'statiShow'])->name('stati.show');

Route::get('/about', [ParaplanController::class, 'about'])->name('about');

Route::get('/obuchenie-poletam-na-paraplane', [ParaplanController::class, 'training'])->name('training');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    Route::resource('whyUs', WhyUsController::class)->parameters([
        'whyUs' => 'whyUs',
    ]);
    Route::resource('tarif', TarifController::class);
    Route::resource('service', ServiceController::class);
    Route::resource('team', TeamController::class);
    Route::resource('sertificate', SertificateController::class);
    Route::resource('offer', OfferController::class);
    Route::resource('review', ReviewController::class);
    Route::get('about/edit', [AboutController::class, 'edit'])
        ->name('about.edit');
    Route::put('about/edit', [AboutController::class, 'update'])
        ->name('about.update');
    Route::resource('flyPoint', FlyPointController::class);
    Route::resource('route', RouteController::class);
    Route::resource('routsContent', RoutsContentController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('stories', StoryController::class);
    Route::resource('legal-pages', LegalPageController::class);
    Route::resource('stories.media', StoryMediaController::class);
    Route::resource('training-materials', TrainingMaterialController::class);
    Route::put('faq/reorder', [FaqController::class, 'reorder'])->name('faq.reorder');
    Route::resource('faq', FaqController::class)->except(['show']);
    Route::post('editor/upload', [EditorUploadController::class, 'store'])->name('editor.upload');

    Route::get('home-seo-info/create', [HomeSeoInfoController::class, 'create'])->name('home-seo-info.create');
    Route::post('home-seo-info', [HomeSeoInfoController::class, 'store'])->name('home-seo-info.store');
    Route::get('home-seo-info/{homeSeoInfo}/edit', [HomeSeoInfoController::class, 'edit'])->name('home-seo-info.edit');
    Route::put('home-seo-info/{homeSeoInfo}', [HomeSeoInfoController::class, 'update'])->name('home-seo-info.update');

    // Глобальный переключатель индексации должен быть до resource-роутов,
    // иначе запросы типа PUT seo-pages/global-indexing будут перехватываться
    // update-маршрутом ресурса и попадать в model binding (404).
    Route::put('seo-pages/global-indexing', [SeoPageController::class, 'updateGlobalIndexing'])
        ->name('seo-pages.global-indexing.update');

    // Редактор robots.txt
    Route::get('seo-pages/robots', [SeoPageController::class, 'editRobots'])
        ->name('seo-pages.robots.edit');
    Route::put('seo-pages/robots', [SeoPageController::class, 'updateRobots'])
        ->name('seo-pages.robots.update');

    Route::resource('external-services', ExternalServiceController::class)->except(['show']);

    Route::resource('seo-pages', SeoPageController::class)->except(['show']);

    Route::get('/marshrut/{slug}', [ParaplanController::class, 'routesShow'])->name('routes.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('banner/edit', [BannerController::class, 'edit'])->name('banner.edit');
    Route::put('banner', [BannerController::class, 'update'])->name('banner.update');
});

require __DIR__.'/auth.php';

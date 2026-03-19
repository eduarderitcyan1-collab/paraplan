<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\FlyPointController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\RoutsContentController;
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

Route::get('/kontakty', function () {
    return view('contacts');
})->name('contacts');

Route::get('/galereya', [ParaplanController::class, 'galereya'])->name('gallery');

Route::post('/thanks', [ParaplanController::class, 'submitLead'])->name('lead.submit');

Route::get('/uslugi', [ParaplanController::class, 'uslugi'])->name('service');
Route::get('/marshruty', [ParaplanController::class, 'marshruty'])->name('marshruty');
Route::get('/stati', [ParaplanController::class, 'stati'])->name('stati');
Route::get('/about', [ParaplanController::class, 'about'])->name('about');

Route::get('/stati-page', function () {
    return view('stati-page');
})->name('stati-page');

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
    Route::resource('stories.media', StoryMediaController::class);
    Route::resource('training-materials', TrainingMaterialController::class);

    Route::get('/marshrut/{slug}', [ParaplanController::class, 'routesShow'])->name('routes.show');

    Route::get('/stati/{slug}', [ParaplanController::class, 'statiShow'])->name('stati.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

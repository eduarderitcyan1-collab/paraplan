<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\WhyUsController;
use App\Http\Controllers\Admin\TarifController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SertificateController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\FlyPointController;

use App\Http\Controllers\ParaplanController;
use App\Http\Controllers\DashboardController;

Route::get('/', [ParaplanController::class, 'welcome'])->name('welcome');

Route::get('/kontakty/', function () {
    return view('contacts');
})->name('contacts');

Route::get('/about/', function () {
    return view('about-us');
})->name('about');

Route::get('/galereya/', function () {
    return view('gallery');
})->name('gallery');

Route::get('/uslugi', [ParaplanController::class, 'uslugi'])->name('service');


Route::get('/stati/', function () {
    return view('stati');
})->name('stati');

Route::get('/stati-page/', function () {
    return view('stati-page');
})->name('stati-page');

Route::get('/obuchenie-poletam-na-paraplane/', function () {
    return view('training');
})->name('training');

Route::get('/obuchenie-poletam-na-paraplane/', function () {
    return view('training');
})->name('training');

Route::get('/marshruty/', function () {
    return view('marshruty');
})->name('marshruty');

Route::get('/marshrut-page/', function () {
    return view('marshrut-page');
})->name('marshrut-page');

Route::get('/chegem/', function () {
    return view('chegem');
})->name('chegem');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('whyUs', WhyUsController::class)->parameters([
        'whyUs' => 'whyUs'
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

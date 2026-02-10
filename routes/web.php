<?php

use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('welcome');
Route::get('/kontakty/', [PageController::class, 'contacts'])->name('contacts');
Route::get('/about/', [PageController::class, 'about'])->name('about');
Route::get('/galereya/', [PageController::class, 'gallery'])->name('gallery');
Route::get('/uslugi/', [PageController::class, 'services'])->name('service');
Route::get('/stati/', [PageController::class, 'articles'])->name('stati');
Route::get('/stati/{article:slug}', [PageController::class, 'articleShow'])->name('stati-page');
Route::get('/obuchenie-poletam-na-paraplane/', [PageController::class, 'training'])->name('training');
Route::get('/marshruty/', [PageController::class, 'routes'])->name('marshruty');
Route::get('/marshruty/{route:slug}', [PageController::class, 'routeShow'])->name('marshrut-page');
Route::get('/chegem/', [PageController::class, 'chegem'])->name('chegem');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

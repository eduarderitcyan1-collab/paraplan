<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/kontakty/', function () {
    return view('contacts');
})->name('contacts');

Route::get('/about/', function () {
    return view('about-us');
})->name('about');

Route::get('/galereya/', function () {
    return view('gallery');
})->name('gallery');

Route::get('/uslugi/', function () {
    return view('service');
})->name('service');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

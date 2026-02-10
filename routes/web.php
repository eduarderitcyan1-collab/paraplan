<?php

use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('welcome');
Route::get('/kontakty/', fn () => view('contacts'))->name('contacts');
Route::get('/about/', fn () => view('about-us'))->name('about');
Route::get('/galereya/', fn () => view('gallery'))->name('gallery');
Route::get('/uslugi/', fn () => view('service'))->name('service');
Route::get('/stati/', fn () => view('stati'))->name('stati');
Route::get('/stati-page/', fn () => view('stati-page'))->name('stati-page');
Route::get('/obuchenie-poletam-na-paraplane/', fn () => view('training'))->name('training');
Route::get('/marshruty/', fn () => view('marshruty'))->name('marshruty');
Route::get('/marshrut-page/', fn () => view('marshrut-page'))->name('marshrut-page');
Route::get('/chegem/', fn () => view('chegem'))->name('chegem');

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin,editor'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function (): void {
        Route::resource('pages', PageController::class);
        Route::resource('media', MediaController::class)->parameters(['media' => 'medium']);

        Route::prefix('pages/{page}')->as('pages.')->group(function (): void {
            Route::resource('blocks', BlockController::class)->except(['show']);
            Route::post('blocks/reorder', [BlockController::class, 'reorder'])->name('blocks.reorder');
        });
    });

Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function (): void {
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
    });

require __DIR__.'/auth.php';

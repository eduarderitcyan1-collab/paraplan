<?php

use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\BlockItemController;
use App\Http\Controllers\Admin\GalleryItemController;
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

Route::get('/dashboard', fn () => redirect()->route('admin.blocks.index'))
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
        Route::resource('blocks', BlockController::class);
        Route::post('blocks/reorder', [BlockController::class, 'reorder'])->name('blocks.reorder');

        Route::prefix('blocks/{block}')->as('blocks.')->group(function (): void {
            Route::resource('items', BlockItemController::class)->except(['show']);
            Route::post('items/reorder', [BlockItemController::class, 'reorder'])->name('items.reorder');
        });

        Route::resource('gallery-items', GalleryItemController::class)->parameters(['gallery-items' => 'galleryItem'])->except(['show']);
    });

Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function (): void {
        Route::resource('users', UserController::class)->only(['index', 'edit', 'update']);
    });

require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\FlyPointController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\RouteController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StartPointController;
use App\Http\Controllers\Admin\TariffController;
use App\Http\Controllers\Admin\TeamMemberController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (): void {
    Route::apiResource('services', ServiceController::class);
    Route::apiResource('routes', RouteController::class);
    Route::apiResource('tariffs', TariffController::class);
    Route::apiResource('articles', ArticleController::class);
    Route::apiResource('gallery-images', GalleryImageController::class);
    Route::apiResource('team-members', TeamMemberController::class);
    Route::apiResource('reviews', ReviewController::class);
    Route::apiResource('fly-points', FlyPointController::class);
    Route::apiResource('start-points', StartPointController::class);
    Route::apiResource('certificates', CertificateController::class);
    Route::apiResource('pages', PageController::class);
});

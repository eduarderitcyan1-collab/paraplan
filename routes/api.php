<?php

use App\Http\Controllers\Api\ContentController;
use Illuminate\Support\Facades\Route;

Route::get('/blocks', [ContentController::class, 'index']);
Route::get('/blocks/{code}', [ContentController::class, 'show']);

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Route;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Получаем основной контент маршрутов (или любые данные)
        $routsMain = Route::main()->contents()->first(); // или ->all() для всех

        // Делаем переменную доступной во всех view
        View::share('routsMain', $routsMain);
    }
}

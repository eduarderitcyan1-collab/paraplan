<?php

namespace App\Providers;

use App\Models\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Route::main() может вернуть null, если нет "основного" маршрута
        $routsMain = Route::main()?->contents()->first(); // или ->all() для всех

        // Делаем переменную доступной во всех view
        View::share('routsMain', $routsMain);
    }
}

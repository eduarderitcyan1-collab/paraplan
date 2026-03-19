<?php

namespace App\Providers;

use App\Models\Route;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Mail\Events\MessageSent;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
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
        Event::listen(MessageSending::class, function (MessageSending $event): void {
            Log::channel('mail')->info('Mail transport is sending message', [
                'mailer' => config('mail.default'),
                'subject' => $event->message->getSubject(),
                'to' => array_keys($event->message->getTo() ?? []),
            ]);
        });

        Event::listen(MessageSent::class, function (MessageSent $event): void {
            Log::channel('mail')->info('Mail transport reported sent message', [
                'mailer' => config('mail.default'),
                'message_id' => $event->sent->getMessageId(),
                'subject' => $event->message->getSubject(),
                'to' => array_keys($event->message->getTo() ?? []),
            ]);
        });

        // Получаем основной контент маршрутов (или любые данные)
        // Route::main() может вернуть null, если нет "основного" маршрута
        $routsMain = Route::main()?->contents()->first(); // или ->all() для всех

        // Делаем переменную доступной во всех view
        View::share('routsMain', $routsMain);
    }
}

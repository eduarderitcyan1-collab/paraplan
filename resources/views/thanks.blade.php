@extends('app')
@section('title', 'Спасибо за заявку')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="page">
        <div class="container">
            <div class="glass" style="max-width: 760px; margin: 80px auto; text-align: center;">
                <div style="font-size: 84px; line-height: 1; margin-bottom: 10px;" aria-hidden="true">✓</div>
                <h1 class="subTitle" style="margin-top: 10px;">Спасибо за вашу заявку!</h1>
                <p class="text" style="max-width: 560px; margin: 14px auto 24px;">
                    Мы уже получили ваш запрос и свяжемся с вами в ближайшее время.
                </p>
                <a href="{{ route('welcome') }}" class="button" style="display: inline-flex;">Вернуться на главную</a>
            </div>
        </div>
    </div>
@endsection

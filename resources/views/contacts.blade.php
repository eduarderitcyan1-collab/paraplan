@extends('app')
@section('title', 'Контакты')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        @include('template.socialBlock')
        @include('template.formBlock')
        <div class="container startPointGrid">
            @include('template.startPoint')
            <div class="container startPoint">
                <h2 class="subTitle">
                    Голубицкая – старт с точки<br>
                    📍45.330690, 37.228235
                </h2>
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A770486f054293e92434dbc627fce78aa1d8cb114be51beb56fdddfe750ee20ca&amp;source=constructor"
                    width="100%" height="400" frameborder="0"></iframe>
            </div>
        </div>
        <p class="text text-center">
            Дата старта на точках полёта зависит от направления ветра. <br>
            Чтобы узнать актуальную информацию, пожалуйста, свяжитесь с нами по номеру телефона.
        </p>
    </div>
@endsection

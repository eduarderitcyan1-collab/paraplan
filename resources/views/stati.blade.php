@extends('app')
@section('title', 'Статьи')
@vite(['resources/css/app.css', 'resources/css/stati.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        <div class="container articleWrapper">
            <a href="{{ asset('stati-page') }}" class="articleItem">
                <img src="{{ asset('images\tarif.webp') }}" alt="Article Photo" class="articlePhoto">
                <div class="articleContent glass">
                    <div class="subTitle">
                        Лучшие подарки: экскурсия на параплане вместо банального сертификата
                    </div>
                    <div class="glass">Читать дальше</div>
                </div>
            </a>
            <a href="{{ asset('stati-page') }}" class="articleItem">
                <img src="{{ asset('images\tarif.webp') }}" alt="Article Photo" class="articlePhoto">
                <div class="articleContent glass">
                    <div class="subTitle">
                        Лучшие подарки: экскурсия на параплане вместо банального сертификата
                    </div>
                    <div class="glass">Читать дальше</div>
                </div>
            </a>
            <a href="{{ asset('stati-page') }}" class="articleItem">
                <img src="{{ asset('images\tarif.webp') }}" alt="Article Photo" class="articlePhoto">
                <div class="articleContent glass">
                    <div class="subTitle">
                        Лучшие подарки: экскурсия на параплане вместо банального сертификата
                    </div>
                    <div class="glass">Читать дальше</div>
                </div>
            </a>
        </div>
    </div>
@endsection

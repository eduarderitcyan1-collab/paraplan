@extends('app')
@section('title', 'О нас')
@vite(['resources/css/app.css', 'resources/css/about.css', 'resources/js/app.js', 'resources/js/whyUs-swiper.js', 'resources/js/team-swiper.js', 'resources/js/reviews-swiper.js', 'resources/js/flypoint-swiper.js'])
@section('content')
    <div class="page">
        @include('template.about')
        @include('template.whyUs')
        @include('template.flyPoint')
        <div class="container flyInfo">
            <div class="flyInfoContent glass">
                <div class="flyInfoTitle subTitle">
                    Ограничения на полёт:
                </div>
                <ul class="text">
                    <li>Беременным женщинам</li>
                    <li>Людям с похмельем</li>
                    <li>В алкогольном или наркотическом опьянении</li>
                    <li>Детям до 3х лет</li>
                    <li>Экстрим полеты разрешены только на пустой желудок, с хорошим вестибулярным аппаратом</li>
                </ul>
            </div>
            <div class="flyInfoContent glass">
                <div class="flyInfoTitle subTitle">
                    Что необходимо взять с собой на полёт:
                </div>
                <ul class="text">
                    <li>Удобную одежду</li>
                    <li>Спортивную обувь</li>
                    <li>Солнцезащитные очки</li>
                </ul>
            </div>
        </div>
        @include('template.reviews')
        @include('template.team')
    </div>
@endsection

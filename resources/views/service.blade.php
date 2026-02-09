@extends('app')
@section('title', 'Услуги')
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/tarif-swiper.js', 'resources/js/sertificate-swiper.js', 'resources/js/service-swiper.js', 'resources/js/team-swiper.js', 'resources/js/reviews-swiper.js'])
@section('content')
    <div class="page">
        @include('template.tarif')
        @include('template.sertificate')
        @include('template.service')
        @include('template.gift')
        @include('template.flyPoint')
        @include('template.team')
        @include('template.reviews')
    </div>
@endsection

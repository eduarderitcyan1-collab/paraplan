@extends('app')
@section('title', $road?->title)
@vite(['resources/css/app.css', 'resources/css/road.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        <div class="container road">
            <div class="roadWrapper">
                <div class="roadContent glass">
                    <h2 class="subTitle">{{ $road?->title }}</h2>
                    <div class="text">
                        {!! $road?->desc !!}
                    </div>
                </div>
                @if (isset($road->video) && $road->video)
                    <video class="roadVideo" autoplay muted loop playsinline data-src="{{ asset('storage/' . $road->video) }}"
                        preload="none">
                        <source src="{{ asset('storage/' . $road->video) }}" type="video/webm">
                        Ваш браузер не поддерживает видео.
                    </video>
                @endif
            </div>
            {!! $road->map !!}
        </div>
    </div>
@endsection

@extends('app')
@section('title', 'Маршруты')
@vite(['resources/css/app.css', 'resources/css/marshruty.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        <div class="container route">
            @foreach ($routes as $route)
                @if ($route->contents()->count() > 0)
                    <h2 class="subTitle">{{ $route->title }}</h2>
                    <div class="routeWrapper">
                        @foreach ($route->contents()->orderBy('order')->get() as $routsContent)
                            <a href="{{ route('routes.show', ['slug' => $routsContent->slug]) }}" class="routeItem">
                                <img src="{{ asset('storage/' . $routsContent->photo) }}" alt="Изображение маршруты"
                                    class="routePhoto">
                                <div class="routeContent">
                                    <div class="subTitle routeTitle">{{ $routsContent->title }}</div>
                                    <p class="text shortDesc">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($routsContent->desc), 50) }}
                                    </p>
                                </div>
                                <div class="routeIcon glass">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27"
                                        viewBox="0 0 27 27" fill="none">
                                        <path d="M13.0209 1L25.0417 13.0208L13.0209 25.0416" stroke="white" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M25.0417 13.0208H1.00006" stroke="white" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection

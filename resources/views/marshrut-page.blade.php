@extends('app')
@section('title', $route->title)
@vite(['resources/css/app.css', 'resources/css/marshruty.css', 'resources/js/app.js', 'resources/js/gallery-swiper.js'])
@section('content')
    <div class="page">
        @if (!empty($route->desc))
            <div class="container routePageContent text glass">
                {!! $route->desc !!}
            </div>
        @endif
        @include('template.formBlock')
        @if (!empty($route->characteristics) && count($route->characteristics))
            <div class="container routeInfo">
                <h2 class="subTitle">Описание маршрута</h2>
                <div class="routeInfoWrapper glass">
                    @foreach ($route->characteristics as $info)
                        <div class="routeInfoItem">
                            <div class="routeInfoName subTitle">
                                {{ $info['property'] }}
                            </div>
                            <div class="routeInfoSep"></div>
                            <div class="routeInfoVal text">
                                {{ $info['value'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (!empty($route->advantages) && count($route->advantages))
            <div class="container adv">
                <h2 class="subTitle">Преимущества маршрута</h2>
                <div class="advWrapper">
                    @foreach ($route->advantages as $info)
                        <div class="advItem glass">
                            <div class="subtitle">{{ $info['title'] }}</div>
                            <p class="text">
                                {{ $info['description'] }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
        @if (!empty($route->gallery) && count($route->gallery))
            <div class="container gallery">
                <h2 class="subTitle">Фотогалерея</h2>
                <div class="swiper gallerySwiper">
                    <div class="swiper-wrapper">
                        @foreach ($route->gallery as $image)
                            <div class="swiper-slide">
                                <a href="{{ asset('storage/' . $image->path) }}" class="glightbox"
                                    data-lightbox="route-gallery">
                                    <img src="{{ asset('storage/' . $image->path) }}" alt="Gallery Image"
                                        class="galleryPhoto">
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiperNavigation">
                        <div class="swiper-button-prev glass">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27"
                                fill="none">
                                <path d="M13.979 26L1.9582 13.9792L13.979 1.9584" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M1.95836 13.979L26 13.979" stroke="white" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="swiper-button-next glass">
                            <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27"
                                fill="none">
                                <path d="M13.0209 1L25.0417 13.0208L13.0209 25.0416" stroke="white" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M25.0417 13.0208H1.00006" stroke="white" stroke-width="2" stroke-linecap="round" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

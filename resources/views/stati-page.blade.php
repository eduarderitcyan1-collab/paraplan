@extends('app')
@section('title', $article->title)
@vite(['resources/css/app.css', 'resources/css/stati.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        @if (!empty($article->desc))
            <div class="container routePageContent text glass">
                {!! $article->desc !!}
            </div>
        @endif
        @if (!empty($article->gallery) && count($gallery))
            <div class="container acticlePageGallery">
                @foreach ($gallery as $image)
                    <a href="{{ asset('storage/' . $image->path) }}" class="glightbox" data-lightbox="article-gallery">
                        <img src="{{ asset('storage/' . $image->path) }}" alt="Gallery Image" class="galleryPhoto">
                    </a>
                @endforeach
            </div>
        @endif
    </div>
@endsection

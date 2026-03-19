@extends('app')
@section('title', 'Галерея')
@vite(['resources/css/app.css', 'resources/css/gallery.css', 'resources/js/app.js', 'resources/js/gallery.js'])
@section('content')
    <div class="page">
        <div class="container tabsWrapper">
            <div class="tabs glass">
                <button class="tab-btn active" data-tab="photo">Фотогалерея</button>
                <button class="tab-btn" data-tab="video">Видеогалерея</button>
            </div>

            <div id="photo" class="tab-content active">
                @forelse ($galleryItems->where('type', 'photo') as $item)
                    <a href="{{ asset('storage/' . $item->path) }}" class="glightbox" data-gallery="photo" data-type="image">
                        <img src="{{ asset('storage/' . $item->path) }}" class="galleryItem" alt="Фото галереи">
                    </a>
                @empty
                    <div>Пока нет фото в галерее.</div>
                @endforelse
            </div>

            <div id="video" class="tab-content">
                @forelse ($galleryItems->where('type', 'video') as $item)
                    <a href="{{ asset('storage/' . $item->path) }}" class="glightbox" data-gallery="video" data-type="video"
                        data-width="100vw" data-height="100vh">
                        <video class="galleryItem" muted playsinline preload="metadata">
                            <source src="{{ asset('storage/' . $item->path) }}" type="video/webm">
                            Ваш браузер не поддерживает видео.
                        </video>
                    </a>
                @empty
                    <div>Пока нет видео в галерее.</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

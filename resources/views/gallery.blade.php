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
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
                <a href="{{ asset('images/tarif.webp') }}" class="glightbox" data-gallery="photo">
                    <img src="{{ asset('images/tarif.webp') }}" class="galleryItem">
                </a>
            </div>

            <div id="video" class="tab-content">
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
                <a href="https://rutube.ru/play/embed/35246fd5e14244d7b49a770a1add5c20" class="glightbox"
                    data-gallery="video">
                    <img src="{{ asset('images/about.webp') }}" class="galleryItem">
                </a>
            </div>
        </div>
    </div>
@endsection

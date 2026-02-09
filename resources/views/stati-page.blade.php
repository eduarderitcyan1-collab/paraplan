@extends('app')
@section('title', 'Страница статей')
@vite(['resources/css/app.css', 'resources/css/stati.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        <div class="container articlePageContent glass">
            <h3 class="subTitle">Экскурсия, которая начинается с воздуха</h3>
            <p class="text">
                Полет на параплане — это не просто развлечение для экстремалов. Сегодня тандемные экскурсии с
                опытным инструктором доступны каждому: от подростка до взрослого, который никогда не думал о парашютизме.
                Разница в том, что парапланинг — это не прыжок в пустоту, а мягкое скольжение в потоке воздуха. Вместо
                секундного адреналина, как при прыжке с парашютом, вас ждёт длинная прогулка в небе.
            </p>
            <p class="text">
                Представьте: внизу раскинулись горы, леса или морское побережье, а вы словно птица скользите над этим
                великолепием. Это экскурсия, но не по музею и не по старым улочкам города, а по облакам и ветру.
            </p>
            <h3 class="subTitle">Парашютизм или парапланинг: в чём отличие подарка?</h3>
            <p class="text">
                Прыжок с парашютом — яркий, но слишком быстрый опыт. Он подойдёт любителям острого адреналина. А вот
                парапланинг — это универсальный вариант. Его можно подарить коллеге, другу, супругу или даже родителям.
                Здесь нет свободного падения, а есть плавное, безопасное парение. И потому такой подарок воспринимается не
                как риск, а как эксклюзивная экскурсия в новую реальность.
            </p>
            <h3 class="subTitle">Почему это лучше, чем сертификат</h3>
            <p class="text">
                Классический «сертификат в магазин» редко вызывает эмоции. Чаще всего он превращается в вещь, о которой
                быстро забывают. А вот впечатления от полета на параплане остаются в памяти навсегда. Более того, именно
                такие сюрпризы укрепляют отношения: вы словно дарите не услугу, а целый маленький праздник, атмосферу,
                историю.
            </p>
            <h3 class="subTitle">Подарок, который становится историей</h3>
            <p class="text">
                Каждый полет на параплане уникален. Кто-то впервые видит свой город с высоты птичьего полета, кто-то
                решается на шаг навстречу мечте, а кто-то получает новые фото и видео, которыми гордится больше, чем любыми
                сувенирами.
            </p>
            <p class="text">
                Дарить экскурсию в небо — значит дарить эмоции, которые невозможно положить на полку. И именно это делает
                такой подарок лучше любых стандартных сертификатов.
            </p>
        </div>
        <div class="container acticlePageGallery">
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
    </div>
@endsection

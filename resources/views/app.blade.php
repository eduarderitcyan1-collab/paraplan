<!DOCTYPE html>
@php
    $seoMetaData = \App\Support\SeoMetaResolver::resolve(request());
    $pageSeo = $seoMetaData['page'];
    $defaultTitle = trim($__env->yieldContent('title'));
    $composedDefaultTitle = $defaultTitle !== '' ? $defaultTitle . ' | Параплан Анапа' : 'Параплан Анапа';
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('template.favicon')
    <title>{{ $pageSeo?->meta_title ?: $composedDefaultTitle }}</title>
    @include('components.seo-meta', ['seoMetaData' => $seoMetaData])
    @vite(['resources/css/site-widgets.css', 'resources/js/site-widgets.js'])
</head>

<body>
    @unless (request()->routeIs('welcome'))
        @include('template.menu')
    @endunless
    @yield('content')
    @include('template.footer')
    @include('partials.arrow')
    @include('partials.cookies')
    <div class="modalOverlay" id="modalOverlay"></div>
    <div class="modal" id="modal">
        <div class="modalContent">
            <button class="modalClose" id="modalClose">&times;</button>
            <div class="formWrapper glass">
                <h2 class="subTitle">Запишитесь на полет на параплане сегодня</h2>
                <p class="text">Заполните форму и мы свяжемся с Вами в ближайшее время!</p>
                <form action="{{ route('lead.submit') }}" method="POST" class="contactForm">
                    @csrf
                    <div class="formRow">
                        <input type="text" id="modal_name" name="name" required placeholder="Ваше имя">
                    </div>
                    <div class="formRow">
                        <input type="tel" id="modal_phone" name="phone" required placeholder="+7 (___) ___-__-__">
                    </div>
                    <div class="formRow formCheckbox">
                        <input type="checkbox" id="modal_consent" name="consent" required>
                        <label for="modal_consent">Я даю согласие на обработку персональных данных</label>
                    </div>
                    <div class="formRow">
                        <button type="submit" class="button">Отправить</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>

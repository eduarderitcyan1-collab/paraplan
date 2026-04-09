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
    @include('components.external-services-scripts')
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
    <div class="socialBlock__fixed  glass">
        <a href="tel:+79886233440" class="socialLink">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 43 43" fill="none">
                <path
                    d="M16.1008 3.51028L17.8314 6.61142C19.3933 9.41004 18.7664 13.0813 16.3064 15.5413C16.3064 15.5413 13.3228 18.5253 18.7325 23.9352C24.1405 29.3432 27.1264 26.3613 27.1264 26.3613C29.5864 23.9013 33.2576 23.2744 36.0562 24.8362L39.1573 26.5669C43.3834 28.9253 43.8824 34.8517 40.168 38.5664C37.936 40.7984 35.2016 42.5352 32.1789 42.6496C27.0906 42.8426 18.4493 41.5549 9.78103 32.8866C1.11284 24.2184 -0.174946 15.5771 0.0179605 10.4887C0.132547 7.46609 1.86929 4.73177 4.10132 2.49977C7.81585 -1.21476 13.7423 -0.715671 16.1008 3.51028Z"
                    fill="white" stroke="white" stroke-width="0.00064" />
            </svg>
        </a>
        <a href="tel:+79182138630" class="socialLink">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" viewBox="0 0 43 43" fill="none">
                <path
                    d="M16.1008 3.51028L17.8314 6.61142C19.3933 9.41004 18.7664 13.0813 16.3064 15.5413C16.3064 15.5413 13.3228 18.5253 18.7325 23.9352C24.1405 29.3432 27.1264 26.3613 27.1264 26.3613C29.5864 23.9013 33.2576 23.2744 36.0562 24.8362L39.1573 26.5669C43.3834 28.9253 43.8824 34.8517 40.168 38.5664C37.936 40.7984 35.2016 42.5352 32.1789 42.6496C27.0906 42.8426 18.4493 41.5549 9.78103 32.8866C1.11284 24.2184 -0.174946 15.5771 0.0179605 10.4887C0.132547 7.46609 1.86929 4.73177 4.10132 2.49977C7.81585 -1.21476 13.7423 -0.715671 16.1008 3.51028Z"
                    fill="white" stroke="white" stroke-width="0.00064" />
            </svg>
        </a>
        <a href="https://vk.com/poletvanape" target="_blank" rel="nofollow" class="socialLink">
            <svg xmlns="http://www.w3.org/2000/svg" width="45" height="25" viewBox="0 0 32 20" fill="none">
                <path
                    d="M0.125672 0.186666C-0.168633 2.65025 0.0553411 5.14815 0.783222 7.52007C1.5111 9.892 2.72681 12.0856 4.35234 13.96C6.08246 15.8334 8.19384 17.3144 10.5443 18.3034C12.8949 19.2924 15.43 19.7663 17.979 19.6933C17.979 17.4133 17.979 15.12 17.8857 12.84C19.7739 13.0283 21.5572 13.7975 22.99 15.0416C24.4227 16.2857 25.4344 17.9435 25.8857 19.7867L31.4323 19.88C30.5805 17.175 29.1314 14.6961 27.1923 12.6267C26.1865 11.5552 25.0537 10.6104 23.819 9.81333C25.1308 8.96659 26.3007 7.91814 27.2857 6.70667C28.8425 4.78858 29.9046 2.5177 30.379 0.0933329L25.3123 0C24.8555 1.88318 23.9393 3.62389 22.6457 5.06667C21.4028 6.43558 19.8605 7.49879 18.139 8.17333L17.939 0.173333L13.0457 0.279999V13.5333C10.8861 12.5021 9.04388 10.9085 7.71234 8.92C5.9921 6.34969 5.20609 3.26685 5.48567 0.186666H0.125672Z"
                    fill="white" />
            </svg>
        </a>
        <div href="https://vk.com/poletvanape" target="_blank" rel="nofollow" class="socialLink modalButton">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="31" viewBox="0 0 20 31" fill="none">
                <path
                    d="M9.63428 28.6667V28.6477M2.00049 7.33333C3.0199 4.24221 6.05214 2 9.63428 2C10.5695 2 11.4671 2.15283 12.3012 2.43365M9.63401 22.9523C9.63401 14.3811 17.634 16.2856 17.634 9.61904C17.634 8.82269 17.5057 8.05488 17.2676 7.33333"
                    stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
    </div>
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

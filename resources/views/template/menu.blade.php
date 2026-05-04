<header class="siteHeader">
    <div class="container">
        <div class="menu">
            <div class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <div class="menuList leftMenu">
                <a href="{{ route('service') }}" class="menuLink">Услуги</a>
                <a href="{{ route('training') }}" class="menuLink">Обучение</a>
            </div>

            <a href="/" class="logo">
                <img src="{{ asset('images/logo/logo.svg') }}" alt="Paraplan Logo" class="logoImage">
            </a>

            <div class="menuList rightMenu">
                <a href="{{ route('marshruty') }}" class="menuLink">Маршруты</a>
                <a href="{{ route('about') }}" class="menuLink">О нас</a>
            </div>

            <div class="mobileMenu glass" id="mobileMenu">
                <a href="{{ route('service') }}" class="menuLink">Услуги</a>
                <a href="{{ route('training') }}" class="menuLink">Обучение</a>
                <a href="{{ route('marshruty') }}" class="menuLink">Маршруты</a>
                <a href="{{ route('about') }}" class="menuLink">О нас</a>
                <a href="{{ route('contacts') }}" class="menuLink">Контакты</a>
            </div>
        </div>
        @unless (request()->routeIs('welcome'))
            <div class="pageTitleWrapper glass">
                <div class="pageTitleContent">
                    <nav class="breadcrumbs">
                        <a href="{{ route('welcome') }}" class="breadcrumbItem">Главная</a>
                        <span class="breadcrumbItem"> › </span>
                        <span class="breadcrumbItem current">@yield('title')</span>
                    </nav>

                    <h1 class="pageTitle">
                        @yield('title')
                    </h1>
                </div>
                <a href="#" class="button glass modalButton">Записаться на полет</a>
            </div>
        @endunless
    </div>
</header>

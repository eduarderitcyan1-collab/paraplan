<header class="siteHeader">
    <div class="container">
        <div class="menu">
            <div class="menuList">
                <a href="#" class="menuLink">Услуги</a>
                <a href="#" class="menuLink">Обучение</a>
            </div>
            <a href="/" class="logo">
                <img src="{{ asset('images/logo/logo.svg') }}" alt="Paraplan Logo" class="logoImage">
            </a>
            <div class="menuList">
                <a href="#" class="menuLink">Маршруты</a>
                <a href="{{ route('about') }}" class="menuLink">О нас</a>
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

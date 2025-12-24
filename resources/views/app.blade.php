<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('template.favicon')
    <title>Главная | Параплан Анапа</title>
    {{-- Глобальные ассеты --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Стили конкретной страницы --}}
    @yield('style')
</head>

<body>
    @yield('content')
</body>

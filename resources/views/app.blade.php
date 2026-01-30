<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('template.favicon')
    <title>Главная | Параплан Анапа</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('style')
</head>

<body>
    @yield('content')
    @include('template.footer')
</body>

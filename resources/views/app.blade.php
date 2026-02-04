<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('template.favicon')
    <title>@yield('title') | Параплан Анапа</title>
</head>

<body>
    @unless (request()->routeIs('welcome'))
        @include('template.menu')
    @endunless
    @yield('content')
    @include('template.footer')
</body>

@extends('app')

@section('title', 'Политика конфиденциальности')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="page">
    <div class="container">
        <h1 class="pageTitle">Политика конфиденциальности</h1>

        <div class="glass">
            <div class="text">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
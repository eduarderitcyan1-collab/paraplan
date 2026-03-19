@extends('app')

@section('title', 'Согласие на обработку персональных данных')

@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
<div class="page">
    <div class="container">
        <h1 class="pageTitle">Согласие на обработку персональных данных</h1>

        <div class="glass">
            <div class="text">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
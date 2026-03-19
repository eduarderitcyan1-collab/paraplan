@extends('app')
@section('title', 'Статьи')
@vite(['resources/css/app.css', 'resources/css/stati.css', 'resources/js/app.js'])
@section('content')
    <div class="page">
        <div class="container articleWrapper">
            @foreach ($articles as $article)
                <a href="{{ route('stati.show', ['slug' => $article->slug]) }}" class="articleItem">
                    <img src="{{ asset('storage/' . $article->img) }}" alt="Article Photo" class="articlePhoto">
                    <div class="articleContent glass">
                        <div class="subTitle">
                            {{ $article->title }}
                        </div>
                        <div class="glass">Читать дальше</div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endsection

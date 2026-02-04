    @extends('app')
    @section('title', 'Контакты')
    @vite(['resources/css/app.css'])
    @section('content')
        <div class="page">
            @include('template.socialBlock')
            @include('template.formBlock')
            @include('template.startPoint')
            @include('template.recording')
        </div>
    @endsection

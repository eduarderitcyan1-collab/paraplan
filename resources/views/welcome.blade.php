    @extends('app')
    @section('title', 'Главная')
    @vite(['resources/css/app.css', 'resources/css/welcome.css', 'resources/js/app.js', 'resources/js/whyUs-swiper.js', 'resources/js/tarif-swiper.js', 'resources/js/service-swiper.js', 'resources/js/team-swiper.js', 'resources/js/sertificate-swiper.js', 'resources/js/reviews-swiper.js', 'resources/js/flypoint-swiper.js', 'resources/js/gallery-swiper.js', 'resources/js/stories.js'])
    @section('content')
        <div class="page">
            <div class="container banner">
                @include('template.menu')
                <div class="bannerContent">
                    <h1 class="pageTitle">Счастье не за морем, счастье - над ним</h1>
                    <a href="#nextBlock">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="19" viewBox="0 0 36 19" fill="none">
                            <path d="M34.9411 1L17.9705 17.9706L0.999975 1" stroke="white" stroke-opacity="0.6"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="page">
            <div class="container history" id="nextBlock">
                @if ($stories->isNotEmpty())
                    <div class="stories-container">
                        <button class="nav-btn nav-prev" id="storiesNavPrev" type="button" aria-label="Предыдущие истории">
                            &lt;
                        </button>
                        <button class="nav-btn nav-next" id="storiesNavNext" type="button" aria-label="Следующие истории">
                            &gt;
                        </button>

                        <div class="stories-wrapper" id="storiesWrapper">
                            @foreach ($stories as $story)
                                <div class="story" style="--story-border: {{ $story->border_color ?: '#2ecc71' }};">
                                    @foreach ($story->media as $media)
                                        <div class="story-media" data-type="{{ $media->type }}"
                                            data-src="{{ asset('storage/' . $media->path) }}"></div>
                                    @endforeach

                                    @if ($story->preview)
                                        <img src="{{ asset('storage/' . $story->preview) }}" alt="{{ $story->title }}"
                                            class="avatar">
                                    @else
                                        @php
                                            $firstMedia = $story->media->first();
                                            $firstPhoto = $story->media->firstWhere('type', 'photo');
                                            $avatarPath = $firstPhoto?->path ?? ($firstMedia?->path);
                                        @endphp

                                        @if ($avatarPath)
                                            <img src="{{ asset('storage/' . $avatarPath) }}" alt="{{ $story->title }}"
                                                class="avatar">
                                        @endif
                                    @endif

                                    <p class="historyTitle text">{{ $story->title }}</p>
                                </div>
                            @endforeach
                        </div>

                        <div class="lightbox" id="storiesLightbox">
                            <div class="lightbox-content">
                                <div class="progress-container"></div>
                                <div class="lightbox-media-container"></div>
                                <button class="lightbox-close" type="button" aria-label="Закрыть историю">&times;</button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @include('template.whyUs')
            @include('template.socialBlock')
            @include('template.tarif')
            @include('template.service')
            @include('template.gift')
            @include('template.team')
            @include('template.sertificate')
            @include('template.offer')
            @include('template.formBlock')
            @include('template.reviews')
            @include('template.about')
            @include('template.flyPoint')
            @include('template.gallery')
            @if ($faqs->isNotEmpty())
                <div class="container faq">
                    <h2 class="subTitle">Отвечаем на частые вопросы</h2>
                    <div class="accordion">
                        @foreach ($faqs as $faq)
                            <div class="accordion-item {{ $loop->first ? 'active' : '' }}">
                                <div class="accordion-title">
                                    {{ $faq->title }}
                                </div>
                                <div class="accordion-content" {!! $loop->first ? 'style="display: block;"' : '' !!}>
                                    {!! $faq->desc !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @include('template.startPoint')
            @if ($homeSeoInfo)
                <div class="container seoBlock glass">
                    <h2 class="subTitle">{{ $homeSeoInfo->title }}</h2>
                    <div class="text">
                        {!! $homeSeoInfo->desc !!}
                    </div>
                </div>
            @endif
        </div>
    @endsection

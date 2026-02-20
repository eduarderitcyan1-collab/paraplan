<div class="container flyPoint">
    <h2 class="subTitle">Точки полетов</h2>
    <div class="flyPointWrapper">
        @foreach ($flyPoints as $flyPoint)
            @if ($flyPoint->link)
                <a href="{{ $flyPoint->link }}" class="flyPointContent">
                @else
                    <div class="flyPointContent">
            @endif

            <img src="{{ asset('storage/' . $flyPoint->img) }}" alt="Fly Point" class="flyPointPhoto">
            <div class="flyPointName glass">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36"
                    fill="none">
                    <path
                        d="M34.5833 16.6667H31.1833C30.5833 10.3167 25.5167 5.23333 19.1667 4.65V1.25C19.1667 0.566667 18.6 0 17.9167 0C17.2333 0 16.6667 0.566667 16.6667 1.25V4.65C10.3167 5.25 5.23333 10.3167 4.65 16.6667H1.25C0.566667 16.6667 0 17.2333 0 17.9167C0 18.6 0.566667 19.1667 1.25 19.1667H4.65C5.25 25.5167 10.3167 30.6 16.6667 31.1833V34.5833C16.6667 35.2667 17.2333 35.8333 17.9167 35.8333C18.6 35.8333 19.1667 35.2667 19.1667 34.5833V31.1833C25.5167 30.5833 30.6 25.5167 31.1833 19.1667H34.5833C35.2667 19.1667 35.8333 18.6 35.8333 17.9167C35.8333 17.2333 35.2667 16.6667 34.5833 16.6667ZM17.9167 23.1167C15.05 23.1167 12.7167 20.7833 12.7167 17.9167C12.7167 15.05 15.05 12.7167 17.9167 12.7167C20.7833 12.7167 23.1167 15.05 23.1167 17.9167C23.1167 20.7833 20.7833 23.1167 17.9167 23.1167Z"
                        fill="#4A49C4" />
                </svg>
                {{ $flyPoint->title }}
            </div>
            <div class="text">
                {!! $flyPoint->desc !!}
            </div>

            @if ($flyPoint->link)
                </a>
            @else
    </div>
    @endif
    @endforeach

</div>
<div class="swiperNavigation swiperMobileNavigation">
    <div class="swiper-button-prev glass">
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
            <path d="M13.979 26L1.9582 13.9792L13.979 1.9584" stroke="white" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M1.95836 13.979L26 13.979" stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>
    <div class="swiper-button-next glass">
        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27" fill="none">
            <path d="M13.0209 1L25.0417 13.0208L13.0209 25.0416" stroke="white" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" />
            <path d="M25.0417 13.0208H1.00006" stroke="white" stroke-width="2" stroke-linecap="round" />
        </svg>
    </div>
</div>
<a href="{{ route('chegem') }}" class="flyPointContentOther">
    <div class="flyPointContent">
        <img src="{{ asset('images\flypoint.webp') }}" alt="Fly Point" class="flyPointPhoto">
        <div class="flyPointName glass">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 36 36" fill="none">
                <path
                    d="M34.5833 16.6667H31.1833C30.5833 10.3167 25.5167 5.23333 19.1667 4.65V1.25C19.1667 0.566667 18.6 0 17.9167 0C17.2333 0 16.6667 0.566667 16.6667 1.25V4.65C10.3167 5.25 5.23333 10.3167 4.65 16.6667H1.25C0.566667 16.6667 0 17.2333 0 17.9167C0 18.6 0.566667 19.1667 1.25 19.1667H4.65C5.25 25.5167 10.3167 30.6 16.6667 31.1833V34.5833C16.6667 35.2667 17.2333 35.8333 17.9167 35.8333C18.6 35.8333 19.1667 35.2667 19.1667 34.5833V31.1833C25.5167 30.5833 30.6 25.5167 31.1833 19.1667H34.5833C35.2667 19.1667 35.8333 18.6 35.8333 17.9167C35.8333 17.2333 35.2667 16.6667 34.5833 16.6667ZM17.9167 23.1167C15.05 23.1167 12.7167 20.7833 12.7167 17.9167C12.7167 15.05 15.05 12.7167 17.9167 12.7167C20.7833 12.7167 23.1167 15.05 23.1167 17.9167C23.1167 20.7833 20.7833 23.1167 17.9167 23.1167Z"
                    fill="#4A49C4" />
            </svg>
            Анапа
        </div>
    </div>
    <div class="content">
        <div class="subTitle">Тур в Чегем - полёты и походы</div>
        <p class="text">
            Полет на параплане — это уникальная возможность испытать ощущение свободы и красоты природы
            с высоты птичьего полета прямо над живописным побережьем Анапы. Насладитесь захватывающими
            видами Черного моря, уютных пляжей и зеленых окрестностей с высоты.
        </p>
        <p class="text">
            Полет на параплане — это уникальная возможность испытать ощущение свободы и красоты природы
            с высоты птичьего полета прямо над живописным побережьем Анапы. Насладитесь захватывающими
            видами Черного моря, уютных пляжей и зеленых окрестностей с высоты.
        </p>
    </div>
</a>
</div>

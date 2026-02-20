<div class="container whyUs">
    <h2 class="subTitle">
        Продуманный сервис и безопасность -<br>
        основа каждого полёта
    </h2>
    <div class="whyUsWrapper">
        @foreach ($whyUs as $whyUs)
            <div class="whyUsItem glass">
                <div class="whyUsIcon glass">
                    <img src="{{ asset('storage/' . $whyUs->svg) }}" alt="icon">
                </div>
                <div class="whyUsTitle">
                    {{ $whyUs->title }}
                </div>
                <p class="text">
                    {{ $whyUs->desc }}
                </p>
            </div>
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
                <path d="M13.0209 1L25.0417 13.0208L13.0209 25.0416" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
                <path d="M25.0417 13.0208H1.00006" stroke="white" stroke-width="2" stroke-linecap="round" />
            </svg>
        </div>
    </div>
</div>

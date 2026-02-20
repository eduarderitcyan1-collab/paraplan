<div class="container service">
    <h2 class="subTitle">Дополнительные услуги</h2>
    <div class="swiper serviceSwiper">
        <div class="swiper-wrapper">
            @foreach ($services as $service)
                <div class="swiper-slide">
                    <img src="{{ asset('storage/' . $service->img) }}" alt="Service" class="servicePhoto">
                    <div class="serviceWrapper">
                        <div class="serviceTitle">{{ $service->title }}</div>
                        <p class="text">({{ $service->desc }})</p>
                        <div class="servicePrice">{{ $service->price }} ₽</div>
                    </div>
                    @if (!empty($service->link))
                        <a href="{{ $service->link }}" rel="nofollow" target="_blank"
                            class="serviceLink glass">Смотреть</a>
                    @endif
                </div>
            @endforeach
        </div>
        @if (count($services) >= 5)
            <div class="swiperNavigation">
                <div class="swiper-button-prev glass">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27"
                        fill="none">
                        <path d="M13.979 26L1.9582 13.9792L13.979 1.9584" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M1.95836 13.979L26 13.979" stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <div class="swiper-button-next glass">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" viewBox="0 0 27 27"
                        fill="none">
                        <path d="M13.0209 1L25.0417 13.0208L13.0209 25.0416" stroke="white" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M25.0417 13.0208H1.00006" stroke="white" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>
        @endif
    </div>
    <div class="serviceOther glass">
        <p class="text">Уникальный сувенир</p>
        <div class="subTitle">Только у нас при полете по тарифу <span>Премиум+</span> вы сможете забрать частичку
            параплана*</div>
        <p class="text">* - Получите браслет или брелок на ключи из строп параплана</p>
    </div>
</div>

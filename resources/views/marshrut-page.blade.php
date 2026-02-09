@extends('app')
@section('title', 'Страница маршрута')
@vite(['resources/css/app.css', 'resources/css/marshruty.css', 'resources/js/app.js', 'resources/js/gallery-swiper.js'])
@section('content')
    <div class="page">
        <div class="container routePageContent glass">
            <h3 class="subTitle">Экскурсия, которая начинается с воздуха</h3>
            <p class="text">
                Полет на параплане — это не просто развлечение для экстремалов. Сегодня тандемные экскурсии с
                опытным инструктором доступны каждому: от подростка до взрослого, который никогда не думал о парашютизме.
                Разница в том, что парапланинг — это не прыжок в пустоту, а мягкое скольжение в потоке воздуха. Вместо
                секундного адреналина, как при прыжке с парашютом, вас ждёт длинная прогулка в небе.
            </p>
            <p class="text">
                Представьте: внизу раскинулись горы, леса или морское побережье, а вы словно птица скользите над этим
                великолепием. Это экскурсия, но не по музею и не по старым улочкам города, а по облакам и ветру.
            </p>
            <h3 class="subTitle">Парашютизм или парапланинг: в чём отличие подарка?</h3>
            <p class="text">
                Прыжок с парашютом — яркий, но слишком быстрый опыт. Он подойдёт любителям острого адреналина. А вот
                парапланинг — это универсальный вариант. Его можно подарить коллеге, другу, супругу или даже родителям.
                Здесь нет свободного падения, а есть плавное, безопасное парение. И потому такой подарок воспринимается не
                как риск, а как эксклюзивная экскурсия в новую реальность.
            </p>
            <h3 class="subTitle">Почему это лучше, чем сертификат</h3>
            <p class="text">
                Классический «сертификат в магазин» редко вызывает эмоции. Чаще всего он превращается в вещь, о которой
                быстро забывают. А вот впечатления от полета на параплане остаются в памяти навсегда. Более того, именно
                такие сюрпризы укрепляют отношения: вы словно дарите не услугу, а целый маленький праздник, атмосферу,
                историю.
            </p>
            <h3 class="subTitle">Подарок, который становится историей</h3>
            <p class="text">
                Каждый полет на параплане уникален. Кто-то впервые видит свой город с высоты птичьего полета, кто-то
                решается на шаг навстречу мечте, а кто-то получает новые фото и видео, которыми гордится больше, чем любыми
                сувенирами.
            </p>
            <p class="text">
                Дарить экскурсию в небо — значит дарить эмоции, которые невозможно положить на полку. И именно это делает
                такой подарок лучше любых стандартных сертификатов.
            </p>
        </div>
        @include('template.formBlock')
        <div class="container routeInfo">
            <h2 class="subTitle">Описание маршрута</h2>
            <div class="routeInfoWrapper glass">
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Сложность маршрута
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        Очень легкая
                    </div>
                </div>
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Посещаемость
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        Высокая, популярные места для семейного и спокойного отдыха
                    </div>
                </div>
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Цена входа
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        От 200 до 2300 руб. (подъемники, вход в заповедник, дополнительные траты на кафе, сувениры и
                        транспорт)
                    </div>
                </div>
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Длина
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        Минимальная, основные перемещения — автомобиль и подъемник, пешие прогулки по желанию
                    </div>
                </div>
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Перепад высот
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        Зависит от точки, для канатной дороги до Мусатчери — значительный подъем за счет механического
                        подъёма
                    </div>
                </div>
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Тип тропы
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        Доступные автомобильные маршруты, подъемники, короткие прогулки без необходимости длительных
                        переходов
                    </div>
                </div>
                <div class="routeInfoItem">
                    <div class="routeInfoName subTitle">
                        Время посещения
                    </div>
                    <div class="routeInfoSep"></div>
                    <div class="routeInfoVal text">
                        Май–октябрь для поездок в горы и на озера В межсезонье возможны ограничения (работа канатных дорог
                        зависит от погодных условий)
                    </div>
                </div>
            </div>
        </div>
        <div class="container adv">
            <h2 class="subTitle">Преимущества маршрута</h2>
            <div class="advWrapper">
                <div class="advItem glass">
                    <div class="subtitle">Уникальная природная красота</div>
                    <p class="text">
                        Восхитительные водопады, живописные каньоны и горные пейзажи создают неповторимую
                        атмосферу и позволяют насладиться природой в ее первозданном виде.
                    </p>
                </div>
                <div class="advItem glass">
                    <div class="subtitle">Уникальная природная красота</div>
                    <p class="text">
                        Восхитительные водопады, живописные каньоны и горные пейзажи создают неповторимую
                        атмосферу и позволяют насладиться природой в ее первозданном виде.
                    </p>
                </div>
                <div class="advItem glass">
                    <div class="subtitle">Уникальная природная красота</div>
                    <p class="text">
                        Восхитительные водопады, живописные каньоны и горные пейзажи создают неповторимую
                        атмосферу и позволяют насладиться природой в ее первозданном виде.
                    </p>
                </div>
            </div>
        </div>
        <div class="container gallery">
            <h2 class="subTitle">Фотогалерея</h2>
            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="{{ asset('images\flypoint.webp') }}" alt="Gallery Image" class="galleryPhoto">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images\flypoint.webp') }}" alt="Gallery Image" class="galleryPhoto">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images\flypoint.webp') }}" alt="Gallery Image" class="galleryPhoto">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images\flypoint.webp') }}" alt="Gallery Image" class="galleryPhoto">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images\flypoint.webp') }}" alt="Gallery Image" class="galleryPhoto">
                    </div>
                    <div class="swiper-slide">
                        <img src="{{ asset('images\flypoint.webp') }}" alt="Gallery Image" class="galleryPhoto">
                    </div>
                </div>
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
            </div>
        </div>
    </div>
@endsection

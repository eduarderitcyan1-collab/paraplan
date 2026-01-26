    @extends('app')
    @section('style')
        @vite(['resources/css/welcome.css', 'resources/js/swiper.js'])
    @endsection
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
                <div class="historyWrapper">
                    <div class="historyItem">
                        <div class="historyImage">
                            <img src="{{ asset('images\tarif.webp') }}" alt="History Paraplan Anapa">
                        </div>
                        <div class="historyTitle text">
                            Летай в Кучугурах
                        </div>
                    </div>
                    <div class="historyItem">
                        <div class="historyImage">
                            <img src="{{ asset('images\tarif.webp') }}" alt="History Paraplan Anapa">
                        </div>
                        <div class="historyTitle text">
                            Летай в Кучугурах
                        </div>
                    </div>
                    <div class="historyItem">
                        <div class="historyImage">
                            <img src="{{ asset('images\tarif.webp') }}" alt="History Paraplan Anapa">
                        </div>
                        <div class="historyTitle text">
                            Летай в Кучугурах
                        </div>
                    </div>
                    <div class="historyItem">
                        <div class="historyImage">
                            <img src="{{ asset('images\tarif.webp') }}" alt="History Paraplan Anapa">
                        </div>
                        <div class="historyTitle text">
                            Летай в Кучугурах
                        </div>
                    </div>
                    <div class="historyItem">
                        <div class="historyImage">
                            <img src="{{ asset('images\tarif.webp') }}" alt="History Paraplan Anapa">
                        </div>
                        <div class="historyTitle text">
                            Летай в Кучугурах
                        </div>
                    </div>
                    <div class="historyItem">
                        <div class="historyImage">
                            <img src="{{ asset('images\tarif.webp') }}" alt="History Paraplan Anapa">
                        </div>
                        <div class="historyTitle text">
                            Летай в Кучугурах
                        </div>
                    </div>
                </div>
            </div>
            @include('template.whyUs')
            @include('template.about')
            @include('template.socialBlock')
            @include('template.tarif')
            @include('template.service')
            @include('template.gift')
            @include('template.team')
            @include('template.sertificate')
            @include('template.offer')
            @include('template.formBlock')
            @include('template.flyPoint')
            @include('template.gallery')
            <div class="container faq">
                <h2 class="subTitle">Отвечаем на частые вопросы</h2>
                <div class="accordion">
                    <div class="accordion-item active">
                        <div class="accordion-title">
                            Присутствует ли гарантия на товар?
                        </div>
                        <div class="accordion-content" style="display: block;">
                            Гарантия на товар есть, сроки у каждого индивидуальны, подробности можно уточнить у менеджера.
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            Присутствует ли гарантия на товар?
                        </div>
                        <div class="accordion-content">
                            Гарантия на товар есть, сроки у каждого индивидуальны, подробности можно уточнить у менеджера.
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            Присутствует ли гарантия на товар?
                        </div>
                        <div class="accordion-content">
                            Гарантия на товар есть, сроки у каждого индивидуальны, подробности можно уточнить у менеджера.
                        </div>
                    </div>
                    <div class="accordion-item">
                        <div class="accordion-title">
                            Присутствует ли гарантия на товар?
                        </div>
                        <div class="accordion-content">
                            Гарантия на товар есть, сроки у каждого индивидуальны, подробности можно уточнить у менеджера.
                        </div>
                    </div>
                </div>
            </div>
            <div class="container startPoint">
                <h2 class="subTitle">
                    Анапа – старт с точки<br>
                    📍44.866458, 37.323900
                </h2>
                <p class="text">
                    Дата старта на точках полёта зависит от направления ветра. <br>
                    Чтобы узнать актуальную информацию, пожалуйста, свяжитесь с нами по номеру телефона.
                </p>
                <iframe
                    src="https://yandex.ru/map-widget/v1/?um=constructor%3A70f9a90553cf5b455fcc1d504d20d36634b5733d330f21333fc773c693fdd31f&amp;source=constructor"
                    width="100%" height="400" frameborder="0"></iframe>
            </div>
            <div class="container seoBlock glass">
                <h2 class="subTitle">Полёт на параплане в Анапе</h2>
                <p class="text">Полёт на параплане – это экстремальное приключение, которое позволяет вам в полной мере
                    получить незабываемые ощущения. Во время полёта на параплане вы будете парить в воздухе, ощущая легкость
                    и ветер в волосах, наслаждаясь прекрасными панорамами Анапы и Черного моря. Процесс полёта на параплане
                    начинается с подготовки и предполётного брифинга, где новичкам объясняются основные правила и инструкции
                    по безопасности.</p>
                <p class="text">Полёт с инструктором на параплане – это идеальный вариант для тех, кто мечтает
                    попробовать подобное приключение впервые. Вам не нужно иметь предварительные навыки и опыт – инструктор
                    взаимодействует с вами на протяжении всего полёта, обеспечивая вашу безопасность и комфорт. Он постоянно
                    контролирует положение параплана и регулирует скорость и направление движения, чтобы вы могли
                    насладиться просторами неба и красотой окружающей природы.</p>
                <p class="text">Цена полёта на параплане в Анапе варьируется в зависимости от выбранной программы.
                    Помните, что полёт на параплане – это не только экстремальный вид спорта, но и возможность испытать
                    неповторимые ощущения и насладиться прекрасными видами Анапы с высоты птичьего полета.</p>
            </div>
            <div class="container recording">
                <h2 class="subTitle">
                    <span>Исполните свою мечту</span><br>
                    в один клик
                </h2>
                <a href="#" class="button" id="modalButton">Записаться на полет</a>
            </div>
        </div>
        @include('template.footer')
    @endsection

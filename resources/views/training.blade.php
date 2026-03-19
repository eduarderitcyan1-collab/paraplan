@extends('app')
@section('title', 'Обучение полетам на параплане')
@vite(['resources/css/app.css', 'resources/css/training.css', 'resources/js/app.js'])
@section('content')
    @php
        $materials = $materials ?? collect();
        $getMaterial = fn(string $key) => $materials->get($key);
        $splitParagraphs = function (?string $text, array $fallback) {
            if (blank($text)) {
                return $fallback;
            }

            $paragraphs = preg_split('/\r\n|\r|\n/', trim($text));
            $paragraphs = array_values(array_filter(array_map('trim', $paragraphs), fn($item) => $item !== ''));

            return !empty($paragraphs) ? $paragraphs : $fallback;
        };

        $renderMedia = function ($material, string $fallbackAsset, string $fallbackAlt) {
            if ($material && !empty($material->media_path) && $material->media_type === 'video') {
                return '<video class="trainingPhoto" controls muted><source src="' . asset('storage/' . $material->media_path) . '" type="video/webm">Ваш браузер не поддерживает видео.</video>';
            }

            if ($material && !empty($material->media_path) && $material->media_type === 'image') {
                $alt = e($material->media_alt ?: $fallbackAlt);

                return '<img src="' . asset('storage/' . $material->media_path) . '" alt="' . $alt . '" class="trainingPhoto">';
            }

            return '<img src="' . asset($fallbackAsset) . '" alt="' . e($fallbackAlt) . '" class="trainingPhoto">';
        };

        $oneText = $getMaterial('one_text');
        $oneMedia = $getMaterial('one_media');
        $twoTitle = $getMaterial('two_title');
        $twoCardOne = $getMaterial('two_card_one');
        $twoCardTwo = $getMaterial('two_card_two');
        $twoMedia = $getMaterial('two_media');
        $threeTitle = $getMaterial('three_title');
        $threeIntro = $getMaterial('three_intro');
        $threeIntroMedia = $getMaterial('three_intro_media');
        $threeCardOne = $getMaterial('three_card_one');
        $threeCardTwo = $getMaterial('three_card_two');
        $threeCardThree = $getMaterial('three_card_three');
        $fourTitle = $getMaterial('four_title');
        $fourText = $getMaterial('four_text');
        $fourMedia = $getMaterial('four_media');
    @endphp

    <div class="page">
        <div class="container oneBlock grid">
            <div class="content glass">
                <h2 class="subTitle left">{{ $oneText?->title ?: 'Структура курса' }}</h2>
                @foreach ($splitParagraphs($oneText?->body, [
                    'Обучение полетам на параплане — это увлекательный и безопасный способ познакомиться с парапланеризмом и научиться управлять парапланом под руководством опытных инструкторов. Мы предлагаем базовый курс по обучению, стоимость которого составляет 50 000 рублей. В рамках курса предоставляется всё необходимое оборудование.',
                    'Базовый курс включает до 20 занятий наземной подготовки и практические полеты с инструктором в тандеме. Вы получите уникальную возможность отработать навыки воздушного маневрирования, а также сможете ознакомиться с основами метеорологии и различными полётными техниками.',
                ]) as $paragraph)
                    <p class="text">{{ $paragraph }}</p>
                @endforeach
            </div>
            {!! $renderMedia($oneMedia, 'images/about.webp', 'Обучение полетам на параплане') !!}
        </div>
        <div class="container twoBlock">
            <h2 class="subTitle left">{{ $twoTitle?->title ?: 'Программа обучения' }}</h2>
            <div class="twoBlockWrapper grid">
                <div class="content glass">
                    <div class="subTitle left">{{ $twoCardOne?->title ?: 'Наземная подготовка' }}</div>
                    @foreach ($splitParagraphs($twoCardOne?->body, [
                        'До 20 тщательно структурированных теоретических и практических занятий, которые создают прочную базу для успешного освоения парапланеризма. В ходе наземных уроков вы научитесь основам работы с парапланом на земле — правильно раскладывать и регулировать оборудование, управлять куполом при различных условиях, оценивать погодные факторы и готовиться к безопасному и комфортному полету. Особое внимание уделяется развитию координации, техники управления и пониманию принципов аэродинамики, что позволит вам уверенно контролировать параплан еще до выхода в воздух.',
                    ]) as $paragraph)
                        <p class="text">{{ $paragraph }}</p>
                    @endforeach
                </div>
                <div class="content glass">
                    <div class="subTitle left">{{ $twoCardTwo?->title ?: 'Наземная подготовка' }}</div>
                    @foreach ($splitParagraphs($twoCardTwo?->body, [
                        'До 20 тщательно структурированных теоретических и практических занятий, которые создают прочную базу для успешного освоения парапланеризма. В ходе наземных уроков вы научитесь основам работы с парапланом на земле — правильно раскладывать и регулировать оборудование, управлять куполом при различных условиях, оценивать погодные факторы и готовиться к безопасному и комфортному полету. Особое внимание уделяется развитию координации, техники управления и пониманию принципов аэродинамики, что позволит вам уверенно контролировать параплан еще до выхода в воздух.',
                    ]) as $paragraph)
                        <p class="text">{{ $paragraph }}</p>
                    @endforeach
                </div>
            </div>
            {!! $renderMedia($twoMedia, 'images/about.webp', 'Обучение полетам на параплане') !!}
        </div>
        <div class="container threeBlock">
            <h2 class="subTitle left">{{ $threeTitle?->title ?: 'Программа обучения' }}</h2>
            <div class="threeBlockWrapper grid">
                <div class="content glass">
                    @foreach ($splitParagraphs($threeIntro?->body, [
                        'После успешного завершения базового курса мы предоставляем нашим ученикам исключительную возможность получить полную поддержку в выборе собственного оборудования для парапланеризма. Понимая, что правильный выбор снаряжения играет ключевую роль в дальнейшем развитии, мы предлагаем индивидуальную консультацию, где наши опытные инструкторы помогут вам разобраться в характеристиках и особенностях различных моделей парапланов и снаряжения.',
                    ]) as $paragraph)
                        <p class="text">{{ $paragraph }}</p>
                    @endforeach
                </div>
                {!! $renderMedia($threeIntroMedia, 'images/about.webp', 'Обучение полетам на параплане') !!}
            </div>
            <div class="content glass">
                <div class="subTitle left">{{ $threeCardOne?->title ?: 'Подбор оборудования' }}</div>
                @foreach ($splitParagraphs($threeCardOne?->body, [
                    'Мы учитываем ваши личные предпочтения и уровень подготовки. Это может включать выбор параплана, который будет соответствовать вашим навыкам и стилю полетов, будь то спокойные прогулочные полеты или более спортивные маневры. Наша команда поможет вам понять, как выбрать подходящую модель параплана, запасной парашют, систему управления и другие компоненты, которые оптимально подойдут для ваших условий.',
                ]) as $paragraph)
                    <p class="text">{{ $paragraph }}</p>
                @endforeach
            </div>
            <div class="content glass">
                <div class="subTitle left">{{ $threeCardTwo?->title ?: 'Поиск и покупка' }}</div>
                @foreach ($splitParagraphs($threeCardTwo?->body, [
                    'Мы предлагаем помощь в поиске качественного оборудования от проверенных производителей. Сотрудничая с рядом надежных поставщиков и брендов, мы можем предложить выгодные условия покупки, включая скидки и акции. Если вам нужно, мы также поможем с организацией доставки и настройкой снаряжения перед первым вылетом.',
                ]) as $paragraph)
                    <p class="text">{{ $paragraph }}</p>
                @endforeach
            </div>
            <div class="content glass">
                <div class="subTitle left">{{ $threeCardThree?->title ?: 'Продление обучения' }}</div>
                @foreach ($splitParagraphs($threeCardThree?->body, [
                    'Мы активно поддерживаем связь с нашими выпускниками и предлагаем возможности для дальнейшего обучения, включая семинары, мастер-классы или индивидуальные занятия по более сложным техникам полетов. Это позволит вам не только эффективно использовать свое новое оборудование, но и продолжать развиваться как пилот.',
                ]) as $paragraph)
                    <p class="text">{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
        <div class="container fourBlock">
            <h2 class="subTitle left">{{ $fourTitle?->title ?: 'Преимущества обучения' }}</h2>
            <div class="content glass">
                @foreach ($splitParagraphs($fourText?->body, [
                    'Обучение в нашем клубе «Южный ветер» — это гарантия высокого качества и безопасности под руководством квалифицированных, опытных инструкторов, которые обладают глубокими знаниями в области парапланеризма и многолетней практикой в проведении тренировок. Каждый инструктор не только тщательно обучит вас техническим навыкам управления парапланом, но и уделит особое внимание правильному восприятию воздушной среды, принципам безопасности и психологической подготовке к полетам.',
                    'Став участником нашего клуба, вы получаете не только обучение, но и широкий спектр дополнительных преимуществ. В числе их — регулярные мероприятия по техническому обслуживанию и проверке крыльев и запасных парашютов, которые проводятся под контролем профессионалов. Это обеспечивает надежность и безопасность вашего снаряжения, продлевает срок службы элементов экипировки и помогает избежать непредвиденных ситуаций во время полетов.',
                    'Мы гордимся созданием живого и дружного сообщества пилотов и энтузиастов парапланеризма, где стиль общения основан на взаимной поддержке, обмене опытом и совместном развитии. Наш клуб — это больше, чем просто место для обучения; это семья, в которой вас всегда выслушают, дадут полезный совет или помогут справиться с любыми сложностями. Для членов клуба регулярно организуются встречи, совместные выезды на тренировочные площадки и соревнования, что способствует укреплению командного духа и расширению круга знакомств.',
                ]) as $paragraph)
                    <p class="text">{{ $paragraph }}</p>
                @endforeach
            </div>
            {!! $renderMedia($fourMedia, 'images/about.webp', 'Обучение полетам на параплане') !!}
        </div>
    </div>
@endsection

<?php

return [
    'blocks' => [
        'fly_points' => [
            'title' => 'Точки полетов',
            'required_payload_keys' => ['image'],
            'payload_example' => ['image' => '/uploads/fly-point.jpg'],
        ],
        'reviews' => [
            'title' => 'Отзывы',
            'required_payload_keys' => ['date', 'images'],
            'payload_example' => ['date' => '2026-02-10', 'images' => ['/uploads/reviews/1.jpg']],
        ],
        'service' => [
            'title' => 'Услуги',
            'required_payload_keys' => ['image', 'price'],
            'payload_example' => ['image' => '/uploads/service.jpg', 'price' => '7000', 'button_url' => null],
        ],
        'tarif' => [
            'title' => 'Тарифы',
            'required_payload_keys' => ['image', 'price'],
            'payload_example' => ['image' => '/uploads/tarif.jpg', 'price' => '12000'],
        ],
        'team' => [
            'title' => 'Команда',
            'required_payload_keys' => ['image'],
            'payload_example' => ['image' => '/uploads/team.jpg'],
        ],
        'why_us' => [
            'title' => 'Почему мы',
            'required_payload_keys' => ['icon'],
            'payload_example' => ['icon' => '/uploads/icons/custom.svg'],
        ],
        'articles' => [
            'title' => 'Выкладка статей',
            'required_payload_keys' => ['image'],
            'payload_example' => ['image' => '/uploads/articles/cover.jpg'],
        ],
        'article_page' => [
            'title' => 'Страница статьи',
            'required_payload_keys' => ['gallery'],
            'payload_example' => ['gallery' => ['/uploads/articles/1.jpg']],
        ],
        'route_categories' => [
            'title' => 'Категории маршрутов',
            'required_payload_keys' => ['image'],
            'payload_example' => ['image' => '/uploads/routes/card.jpg'],
        ],
        'route_page' => [
            'title' => 'Страница маршрута',
            'required_payload_keys' => ['features', 'advantages', 'gallery'],
            'payload_example' => [
                'features' => [['label' => 'Высота', 'value' => '1200 м']],
                'advantages' => [['title' => 'Пейзажи', 'description' => 'Красивые виды']],
                'gallery' => ['/uploads/routes/1.jpg'],
            ],
        ],
    ],
];

# API контента Paraplan Анапа

## Публичные endpoints

### `GET /api/blocks`
Возвращает весь контент для фронта: блоки и галерею.

Структура:

```json
{
  "blocks": [
    {
      "name": "Отзывы",
      "code": "reviews",
      "items": [
        {
          "title": "Иван",
          "subtitle": "2026-02-10",
          "description": "Текст отзыва",
          "payload": {
            "images": ["/uploads/reviews/1.jpg", "/uploads/reviews/2.jpg"]
          }
        }
      ]
    }
  ],
  "gallery": {
    "photo": [
      {"url": "/uploads/gallery/photo1.jpg"}
    ],
    "video": [
      {"url": "https://rutube.ru/play/embed/...", "preview_url": "/uploads/gallery/video-preview.jpg"}
    ]
  }
}
```

### `GET /api/blocks/{code}`
Возвращает конкретный блок (`fly_points`, `reviews`, `service`, `tarif`, `team`, `why_us`, `articles`, `article_page`, `route_categories`, `route_page`, и т.д.).

## Как хранить контент сложных сущностей

- **Точки полетов** (`fly_points`): `payload.image`, `title`, `description`.
- **Отзывы** (`reviews`): `title` (имя), `subtitle` (дата), `description` (текст), `payload.images[]`.
- **Услуги** (`service`): `payload.image`, `title`, `description`, `payload.price`, `payload.button_url`.
- **Тарифы** (`tarif`): `payload.image`, `title`, `description`, `payload.price`.
- **Команда** (`team`): `payload.image`, `title` (имя), `subtitle` (должность).
- **Почему мы** (`why_us`): `payload.icon`, `title`, `description`.
- **Статьи** (`articles`, `article_page`): карточка статьи и детальная страница с `payload.gallery[]`.
- **Маршруты** (`route_categories`, `route_page`): категории + маршруты, характеристики `payload.features[]`, преимущества `payload.advantages[]`, галерея `payload.gallery[]`.

## Админка

- `/admin/blocks` — CRUD блоков контента.
- `/admin/blocks/{block}/items` — CRUD элементов блока + drag&drop порядка.
- `/admin/gallery-items` — CRUD фото/видео галереи.
- `/admin/users` — роли пользователей (`admin` only).

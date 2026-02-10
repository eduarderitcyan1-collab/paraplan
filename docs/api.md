# Paraplan Анапа Backend API

## Public frontend endpoints

### `GET /api/pages`
Returns published pages only.

```bash
curl -s http://localhost/api/pages
```

### `GET /api/pages/{slug}`
Returns one published page with ordered blocks and media.

```bash
curl -s http://localhost/api/pages/about
```

Response example:

```json
{
  "title": "О компании",
  "slug": "about",
  "meta_title": "Параплан Анапа",
  "meta_description": "Полеты в Анапе",
  "blocks": [
    {
      "type": "whyUs",
      "content": {"title": "Почему выбирают нас"},
      "media": [
        {"type": "image", "url": "/uploads/banner.jpg", "alt_text": "Баннер"}
      ]
    },
    {
      "type": "service",
      "content": {"items": [{"title": "Тандем"}]},
      "media": []
    }
  ]
}
```

## Supported block types

`text, image, video, gallery, button, about, flyPoint, footer, formBlock, gift, menu, offer, recording, reviews, service, sertificate, startPoint, tarif, team, whyUs`

## Admin endpoints (web)

- `/admin/pages` — CRUD pages
- `/admin/pages/{page}/blocks` — CRUD blocks + reorder (`POST /admin/pages/{page}/blocks/reorder`)
- `/admin/media` — CRUD media
- `/admin/users` — role management (`admin` only)

## Roles

- `admin` — full access, including user role management.
- `editor` — content management (`pages`, `blocks`, `media`).

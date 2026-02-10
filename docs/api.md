# Paraplan Анапа Backend API

## Public frontend endpoints

### `GET /api/pages`
Returns only published pages.

```bash
curl -s http://localhost/api/pages
```

### `GET /api/pages/{slug}`
Returns a published page with blocks and attached media.

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
      "type": "text",
      "content": {"text": "Добро пожаловать!"},
      "media": []
    },
    {
      "type": "image",
      "content": {"caption": "Баннер"},
      "media": [
        {"type": "image", "url": "/uploads/banner.jpg", "alt_text": "Баннер"}
      ]
    }
  ]
}
```

## Admin endpoints (web)

- `/admin/pages` — CRUD pages
- `/admin/pages/{page}/blocks` — CRUD blocks + reorder (`POST /admin/pages/{page}/blocks/reorder`)
- `/admin/media` — CRUD media
- `/admin/users` — role management (`admin` only)

## Roles

- `admin` — full access, including user role management.
- `editor` — content management (`pages`, `blocks`, `media`).

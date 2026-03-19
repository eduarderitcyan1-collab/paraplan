<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoPage extends Model
{
    use HasFactory;

    protected $table = 'seo_page_rules';

    protected $fillable = [
        'url',
        'normalized_url',
        'indexing_enabled',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'og_title',
        'og_description',
        'og_image_path',
        'og_image_alt',
    ];

    protected $casts = [
        'indexing_enabled' => 'boolean',
    ];

    public static function normalizeUrl(?string $value): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '/';
        }

        // Если введён полный URL (с протоколом), используем только путь.
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            $path = parse_url($value, PHP_URL_PATH);

            if (! is_string($path) || $path === '') {
                $path = '/';
            }
        } else {
            $path = parse_url($value, PHP_URL_PATH);

            // Если передали URL без протокола (например, example.com), parse_url может
            // вернуть весь путь. В этом случае подставляем '/', поскольку это главная.
            if (! is_string($path) || $path === '') {
                $path = $value;
            }
        }

        $path = rawurldecode($path);
        $path = preg_replace('~/+~', '/', $path) ?? $path;
        $path = trim($path);

        if ($path === '') {
            return '/';
        }

        if (! str_starts_with($path, '/')) {
            $path = '/' . $path;
        }

        if ($path !== '/') {
            $path = rtrim($path, '/');
        }

        return mb_strtolower($path);
    }
}

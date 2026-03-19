<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class EditorHtmlImageManager
{
    public static function extractStoragePaths(?string $html, array $allowedPrefixes = ['editor/']): array
    {
        if (! is_string($html) || trim($html) === '') {
            return [];
        }

        preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $matches);

        if (empty($matches[1])) {
            return [];
        }

        $paths = [];

        foreach ($matches[1] as $src) {
            $path = parse_url($src, PHP_URL_PATH);

            if (! is_string($path) || $path === '') {
                continue;
            }

            $path = ltrim(rawurldecode($path), '/');

            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, strlen('storage/'));
            }

            if ($path === '') {
                continue;
            }

            foreach ($allowedPrefixes as $prefix) {
                if (str_starts_with($path, $prefix)) {
                    $paths[] = $path;
                    break;
                }
            }
        }

        return array_values(array_unique($paths));
    }

    public static function deleteRemovedImages(
        ?string $oldHtml,
        ?string $newHtml,
        array $allowedPrefixes = ['editor/'],
        string $disk = 'public'
    ): void {
        $oldPaths = self::extractStoragePaths($oldHtml, $allowedPrefixes);
        $newPaths = self::extractStoragePaths($newHtml, $allowedPrefixes);

        $toDelete = array_diff($oldPaths, $newPaths);

        foreach ($toDelete as $path) {
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }

    public static function deleteAllImages(?string $html, array $allowedPrefixes = ['editor/'], string $disk = 'public'): void
    {
        $paths = self::extractStoragePaths($html, $allowedPrefixes);

        foreach ($paths as $path) {
            if (Storage::disk($disk)->exists($path)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }
}

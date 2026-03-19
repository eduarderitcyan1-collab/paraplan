<?php

namespace App\Support;

use App\Models\SeoPage;
use App\Models\SeoSetting;
use Illuminate\Http\Request;

class SeoMetaResolver
{
    public static function resolve(Request $request): array
    {
        $normalizedCurrentUrl = SeoPage::normalizeUrl($request->getRequestUri());

        $seoPage = SeoPage::query()
            ->where('normalized_url', $normalizedCurrentUrl)
            ->first();

        $globalIndexingEnabled = SeoSetting::query()->value('global_indexing_enabled');
        $globalIndexingEnabled = $globalIndexingEnabled === null ? true : (bool) $globalIndexingEnabled;

        $pageIndexingEnabled = $seoPage?->indexing_enabled ?? true;
        $allowIndexing = $globalIndexingEnabled && $pageIndexingEnabled;

        return [
            'page' => $seoPage,
            'global_indexing_enabled' => $globalIndexingEnabled,
            'allow_indexing' => $allowIndexing,
            'robots' => $allowIndexing ? 'index, follow' : 'noindex, nofollow',
        ];
    }
}

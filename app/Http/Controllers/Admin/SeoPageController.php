<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSeoInfo;
use App\Models\SeoPage;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoPageController extends Controller
{
    public function index()
    {
        $items = SeoPage::query()->orderBy('normalized_url')->paginate(20);
        $homeSeoInfo = HomeSeoInfo::query()->first();

        $settings = SeoSetting::query()->firstOrCreate([], [
            'global_indexing_enabled' => true,
        ]);

        return view('admin.seo.index', compact('items', 'settings', 'homeSeoInfo'));
    }

    public function create()
    {
        return view('admin.seo.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['normalized_url'] = SeoPage::normalizeUrl($data['url']);

        if (SeoPage::query()->where('normalized_url', $data['normalized_url'])->exists()) {
            return back()
                ->withErrors(['url' => 'SEO для этого URL уже существует.'])
                ->withInput();
        }

        $data['indexing_enabled'] = $request->boolean('indexing_enabled', true);

        $data['canonical_url'] = $this->autoCanonicalUrl($data['canonical_url'] ?? null, $data['normalized_url']);

        if ($request->hasFile('og_image_file')) {
            $data['og_image_path'] = $request->file('og_image_file')->store('seo/og', 'public');
        }

        unset($data['og_image_file']);

        SeoPage::create($data);

        return redirect()->route('seo-pages.index')->with('success', 'SEO-запись создана.');
    }

    public function edit(SeoPage $seoPage)
    {
        return view('admin.seo.edit', compact('seoPage'));
    }

    public function update(Request $request, SeoPage $seoPage)
    {
        $data = $this->validateData($request);
        $data['normalized_url'] = SeoPage::normalizeUrl($data['url']);

        if (SeoPage::query()
            ->where('normalized_url', $data['normalized_url'])
            ->where('id', '!=', $seoPage->id)
            ->exists()) {
            return back()
                ->withErrors(['url' => 'SEO для этого URL уже существует.'])
                ->withInput();
        }

        $data['indexing_enabled'] = $request->boolean('indexing_enabled', true);

        $data['canonical_url'] = $this->autoCanonicalUrl($data['canonical_url'] ?? null, $data['normalized_url']);

        if ($request->boolean('remove_og_image') && $seoPage->og_image_path) {
            Storage::disk('public')->delete($seoPage->og_image_path);
            $data['og_image_path'] = null;
        }

        if ($request->hasFile('og_image_file')) {
            if ($seoPage->og_image_path) {
                Storage::disk('public')->delete($seoPage->og_image_path);
            }

            $data['og_image_path'] = $request->file('og_image_file')->store('seo/og', 'public');
        }

        $seoPage->update($data);

        return redirect()->route('seo-pages.index')->with('success', 'SEO-запись обновлена.');
    }

    public function destroy(SeoPage $seoPage)
    {
        if ($seoPage->og_image_path) {
            Storage::disk('public')->delete($seoPage->og_image_path);
        }

        $seoPage->delete();

        return redirect()->route('seo-pages.index')->with('success', 'SEO-запись удалена.');
    }

    public function updateGlobalIndexing(Request $request)
    {
        $settings = SeoSetting::query()->firstOrCreate([], [
            'global_indexing_enabled' => true,
        ]);

        $settings->update([
            'global_indexing_enabled' => $request->boolean('global_indexing_enabled'),
        ]);

        return redirect()->route('seo-pages.index')->with('success', 'Глобальная индексация обновлена.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'url' => ['required', 'string', 'max:2048'],
            'indexing_enabled' => ['nullable', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'meta_keywords' => ['nullable', 'string', 'max:2000'],
            'canonical_url' => ['nullable', 'string', 'max:2048'],
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:2000'],
            'og_image_file' => ['nullable', 'file', 'mimetypes:image/webp', 'max:2048'],
            'og_image_alt' => ['nullable', 'string', 'max:255'],
            'remove_og_image' => ['nullable', 'boolean'],
        ], [
            'og_image_file.mimetypes' => 'OG-изображение должно быть только в формате WebP.',
            'og_image_file.max' => 'OG-изображение не должно превышать 2 МБ.',
        ]);
    }

    private function autoCanonicalUrl(?string $canonicalUrl, string $normalizedUrl): ?string
    {
        $canonicalUrl = trim((string) $canonicalUrl);

        if ($canonicalUrl !== '') {
            return $canonicalUrl;
        }

        $appUrl = rtrim(config('app.url'), '/');
        $normalizedUrl = $normalizedUrl === '/' ? '' : $normalizedUrl;

        return $appUrl.$normalizedUrl;
    }
}

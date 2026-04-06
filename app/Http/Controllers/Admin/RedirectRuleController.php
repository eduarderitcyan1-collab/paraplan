<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RedirectRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RedirectRuleController extends Controller
{
    public function index(): View
    {
        $redirectRules = RedirectRule::orderByDesc('id')->get();

        return view('admin.redirect_rules.index', compact('redirectRules'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'from_url' => $this->normalizePathLikeValue((string) $request->input('from_url', '')),
            'to_url' => $this->normalizeTargetValue((string) $request->input('to_url', '')),
        ]);

        $data = $request->validate([
            'from_url' => ['required', 'string', 'max:512', 'unique:redirect_rules,from_url'],
            'to_url' => ['required', 'string', 'max:1024'],
            'status_code' => ['required', Rule::in([301, 302])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($this->isSameDestination($data['from_url'], $data['to_url'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['from_url' => 'URL источника и URL назначения совпадают.']);
        }

        RedirectRule::create($data);

        return redirect()->route('redirect-rules.index')->with('success', 'Редирект добавлен');
    }

    public function edit(RedirectRule $redirectRule): View
    {
        return view('admin.redirect_rules.edit', compact('redirectRule'));
    }

    public function update(Request $request, RedirectRule $redirectRule): RedirectResponse
    {
        $request->merge([
            'from_url' => $this->normalizePathLikeValue((string) $request->input('from_url', '')),
            'to_url' => $this->normalizeTargetValue((string) $request->input('to_url', '')),
        ]);

        $data = $request->validate([
            'from_url' => ['required', 'string', 'max:512', Rule::unique('redirect_rules', 'from_url')->ignore($redirectRule->id)],
            'to_url' => ['required', 'string', 'max:1024'],
            'status_code' => ['required', Rule::in([301, 302])],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($this->isSameDestination($data['from_url'], $data['to_url'])) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['from_url' => 'URL источника и URL назначения совпадают.']);
        }

        $redirectRule->update($data);

        return redirect()->route('redirect-rules.index')->with('success', 'Редирект обновлен');
    }

    public function destroy(RedirectRule $redirectRule): RedirectResponse
    {
        $redirectRule->delete();

        return redirect()->route('redirect-rules.index')->with('success', 'Редирект удален');
    }

    private function normalizePathLikeValue(string $value): string
    {
        $value = trim($value);
        if ($value === '') {
            return '/';
        }

        if ($this->isAbsoluteUrl($value)) {
            $parts = parse_url($value);
            $path = $parts['path'] ?? '/';
            $query = isset($parts['query']) ? '?'.$parts['query'] : '';
            $value = $path.$query;
        }

        if (! str_starts_with($value, '/')) {
            $value = '/'.$value;
        }

        return $this->normalizePathAndQuery($value);
    }

    private function normalizeTargetValue(string $value): string
    {
        $value = trim($value);

        if ($this->isAbsoluteUrl($value)) {
            return $value;
        }

        if (! str_starts_with($value, '/')) {
            $value = '/'.$value;
        }

        return $this->normalizePathAndQuery($value);
    }

    private function normalizePathAndQuery(string $value): string
    {
        $parts = explode('?', $value, 2);
        $path = rtrim($parts[0], '/') ?: '/';

        if (count($parts) === 1 || $parts[1] === '') {
            return $path;
        }

        return $path.'?'.$parts[1];
    }

    private function isAbsoluteUrl(string $value): bool
    {
        $value = strtolower($value);

        return str_starts_with($value, 'http://') || str_starts_with($value, 'https://');
    }

    private function isSameDestination(string $fromUrl, string $toUrl): bool
    {
        if ($this->isAbsoluteUrl($toUrl)) {
            $parts = parse_url($toUrl);
            if (! $parts) {
                return false;
            }

            $targetPath = $parts['path'] ?? '/';
            $targetQuery = isset($parts['query']) ? '?'.$parts['query'] : '';
            $toComparable = $this->normalizePathAndQuery($targetPath.$targetQuery);

            return $fromUrl === $toComparable;
        }

        return $fromUrl === $toUrl;
    }
}

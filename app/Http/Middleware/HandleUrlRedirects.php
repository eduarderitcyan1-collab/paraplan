<?php

namespace App\Http\Middleware;

use App\Models\RedirectRule;
use Closure;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleUrlRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! in_array($request->method(), ['GET', 'HEAD'], true)) {
            return $next($request);
        }

        if ($request->is('admin') || $request->is('admin/*') || $request->is('login') || $request->is('logout')) {
            return $next($request);
        }

        $currentPath = '/'.ltrim($request->path(), '/');
        $currentPath = rtrim($currentPath, '/') ?: '/';
        $currentWithQuery = $request->getQueryString()
            ? $currentPath.'?'.$request->getQueryString()
            : $currentPath;

        try {
            $rule = RedirectRule::query()
                ->where('is_active', true)
                ->whereIn('from_url', [$currentWithQuery, $currentPath])
                ->orderByRaw('CASE WHEN from_url = ? THEN 0 ELSE 1 END', [$currentWithQuery])
                ->first();
        } catch (QueryException $exception) {
            return $next($request);
        }

        if (! $rule) {
            return $next($request);
        }

        $target = $rule->to_url;
        $lowerTarget = strtolower($target);
        if (! str_starts_with($lowerTarget, 'http://') && ! str_starts_with($lowerTarget, 'https://')) {
            $target = '/'.ltrim($target, '/');
        }

        if ($this->isLoopRedirect($request, $currentPath, $currentWithQuery, $target)) {
            return $next($request);
        }

        return new RedirectResponse($target, (int) $rule->status_code);
    }

    private function isLoopRedirect(Request $request, string $currentPath, string $currentWithQuery, string $target): bool
    {
        $parts = parse_url($target);
        if ($parts === false) {
            return true;
        }

        $targetPath = $parts['path'] ?? '/';
        $targetPath = '/'.ltrim($targetPath, '/');
        $targetPath = rtrim($targetPath, '/') ?: '/';
        $targetWithQuery = isset($parts['query']) && $parts['query'] !== ''
            ? $targetPath.'?'.$parts['query']
            : $targetPath;

        if (isset($parts['host'])) {
            $requestHost = $request->getHost();
            if ($parts['host'] !== $requestHost) {
                return false;
            }
        }

        return in_array($targetWithQuery, [$currentWithQuery, $currentPath], true)
            || in_array($targetPath, [$currentWithQuery, $currentPath], true);
    }
}

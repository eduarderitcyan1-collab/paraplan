<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GalleryImage;
use App\Models\Page;
use App\Models\ParaplanRoute;
use App\Models\Review;
use App\Models\Service;
use App\Models\Tariff;
use App\Models\TeamMember;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('welcome', [
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get(),
            'routes' => ParaplanRoute::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get(),
            'reviews' => Review::query()->where('is_active', true)->latest()->limit(10)->get(),
        ]);
    }

    public function contacts(): View
    {
        return view('contacts', ['page' => Page::query()->where('slug', 'contacts')->first()]);
    }

    public function about(): View
    {
        return view('about-us', [
            'page' => Page::query()->where('slug', 'about')->first(),
            'team' => TeamMember::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function gallery(): View
    {
        return view('gallery', ['images' => GalleryImage::query()->where('is_active', true)->orderBy('sort_order')->get()]);
    }

    public function services(): View
    {
        return view('service', [
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'tariffs' => Tariff::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function articles(): View
    {
        return view('stati', ['articles' => Article::query()->where('is_active', true)->latest()->paginate(12)]);
    }

    public function articleShow(Article $article): View
    {
        return view('stati-page', compact('article'));
    }

    public function training(): View
    {
        return view('training');
    }

    public function routes(): View
    {
        return view('marshruty', ['routes' => ParaplanRoute::query()->where('is_active', true)->orderBy('sort_order')->paginate(12)]);
    }

    public function routeShow(ParaplanRoute $route): View
    {
        return view('marshrut-page', compact('route'));
    }

    public function chegem(): View
    {
        return view('chegem');
    }
}

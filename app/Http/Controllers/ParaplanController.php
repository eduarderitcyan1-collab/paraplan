<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WhyUs;
use App\Models\Tarif;
use App\Models\Service;
use App\Models\Team;
use App\Models\Sertificate;
use App\Models\Offer;
use App\Models\Review;
use App\Models\About;
use App\Models\FlyPoint;
use App\Models\RoutsContent;
use App\Models\RoutsContentGallery;
use App\Models\Route;
use App\Models\Article;
use App\Models\ArticleGallery;

class ParaplanController extends Controller
{
    public function welcome()
    {
        $whyUs = WhyUs::ordered()->get();
        $tarifs = Tarif::ordered()->get();
        $services = Service::ordered()->get();
        $team = Team::ordered()->get();
        $sertificates = Sertificate::ordered()->get();
        $offers = Offer::ordered()->get();
        $reviews = Review::ordered()->get();
        $about = About::first();
        $flyPoints = FlyPoint::ordered()->get();
        $routes = Route::ordered()->get();
        return view('welcome', compact('whyUs', 'tarifs', 'services', 'team', 'sertificates', 'offers', 'reviews', 'about', 'flyPoints', 'routes'));
    }

    public function uslugi()
    {
        $tarifs = Tarif::ordered()->get();
        $services = Service::ordered()->get();
        $team = Team::ordered()->get();
        $sertificates = Sertificate::ordered()->get();
        $reviews = Review::ordered()->get();
        $flyPoints = FlyPoint::ordered()->get();
        $routes = Route::ordered()->get();
        return view('service', compact('tarifs', 'services', 'team', 'sertificates', 'reviews', 'flyPoints', 'routes'));
    }

    public function about()
    {
        $whyUs = WhyUs::ordered()->get();
        $flyPoints = FlyPoint::ordered()->get();
        $reviews = Review::ordered()->get();
        $team = Team::ordered()->get();
        $about = About::first();
        return view('about-us', compact('about', 'whyUs', 'flyPoints', 'reviews', 'team'));
    }

    public function marshruty()
    {
        $routes = Route::where('main', false)
            ->ordered()
            ->with(['contents' => fn($q) => $q->ordered()]) // подгружаем сразу отсортированные
            ->get();
        return view('marshruty', compact('routes'));
    }

    public function routesShow($slug)
    {
        $route = RoutsContent::where('slug', $slug)->firstOrFail();
        $gallery = RoutsContentGallery::where('routs_content_id', $route->id)->ordered()->get();
        return view('marshrut-page', compact('route', 'gallery'));
    }

    public function stati()
    {
        $articles = Article::ordered()->get();
        return view('stati', compact('articles'));
    }

    public function statiShow($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        $gallery = ArticleGallery::where('article_id', $article->id)->ordered()->get();
        return view('stati-page', compact('article', 'gallery'));
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\ArticleGallery;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\FlyPoint;
use App\Models\Gallery;
use App\Models\HomeSeoInfo;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Route;
use App\Models\RoutsContent;
use App\Models\RoutsContentGallery;
use App\Models\Sertificate;
use App\Models\Service;
use App\Models\Story;
use App\Models\Tarif;
use App\Models\Team;
use App\Models\TrainingMaterial;
use App\Models\WhyUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Throwable;

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
        $stories = Story::query()
            ->where('is_active', true)
            ->with(['media' => fn ($query) => $query->orderBy('sort')->orderBy('id')])
            ->whereHas('media')
            ->latest()
            ->get();
        $gallery = Gallery::ordered()->photos()->take(10)->get();
        $faqs = Faq::ordered()->get();
        $homeSeoInfo = HomeSeoInfo::query()->first();
        $banner = Banner::first();

        return view('welcome', compact('whyUs', 'tarifs', 'services', 'team', 'sertificates', 'offers', 'reviews', 'about', 'flyPoints', 'routes', 'stories', 'gallery', 'faqs', 'homeSeoInfo', 'banner'));
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
            ->with(['contents' => fn ($q) => $q->ordered()]) // подгружаем сразу отсортированные
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

    public function galereya()
    {
        $galleryItems = Gallery::ordered()->get();

        return view('gallery', compact('galleryItems'));
    }

    public function thanks(Request $request)
    {
        if (! $request->session()->has('lead_submitted')) {
            return redirect()->route('welcome');
        }

        return view('thanks');
    }

    public function submitLead(Request $request)
    {
        $leadRequestId = (string) Str::uuid();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'consent' => ['accepted'],
        ]);

        $recipients = config('mail.lead_recipients', []);

        Log::channel('mail')->info('Lead submission received', [
            'lead_request_id' => $leadRequestId,
            'mailer' => config('mail.default'),
            'recipient_count' => count($recipients),
            'recipients' => $recipients,
            'ip' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
            'name' => $validated['name'] ?? null,
            'phone' => $validated['phone'] ?? null,
        ]);

        if (empty($recipients)) {
            Log::channel('mail')->warning('Lead submission skipped: recipients are not configured', [
                'lead_request_id' => $leadRequestId,
            ]);

            return back()
                ->withInput()
                ->withErrors(['mail' => 'Не настроены получатели заявок. Укажите MAIL_LEAD_RECIPIENTS в .env']);
        }

        try {
            Mail::send('emails.lead', ['lead' => $validated, 'submittedAt' => now()], function ($message) use ($recipients) {
                $message->to($recipients)
                    ->subject('Новая заявка с сайта Paraplan');
            });

            Log::channel('mail')->info('Lead email send call finished without exception', [
                'lead_request_id' => $leadRequestId,
                'mailer' => config('mail.default'),
            ]);
        } catch (Throwable $exception) {
            Log::channel('mail')->error('Lead email send failed', [
                'lead_request_id' => $leadRequestId,
                'mailer' => config('mail.default'),
                'exception_class' => $exception::class,
                'exception_message' => $exception->getMessage(),
                'exception_code' => $exception->getCode(),
            ]);

            report($exception);

            return back()
                ->withInput()
                ->withErrors(['mail' => 'Не удалось отправить заявку. Попробуйте позже.']);
        }

        return redirect()
            ->route('thanks')
            ->with('lead_submitted', true)
            ->with('contact_form_success', 'Заявка отправлена. Мы свяжемся с вами в ближайшее время.');
    }

    public function training()
    {
        $materials = TrainingMaterial::ordered()->get()->keyBy('key');

        return view('training', compact('materials'));
    }

    public function privacyPolicy()
    {
        $page = \App\Models\LegalPage::forKey(\App\Models\LegalPage::KEY_PRIVACY);

        if (! $page) {
            abort(404);
        }

        return view('privacy-policy', compact('page'));
    }

    public function personalData()
    {
        $page = \App\Models\LegalPage::forKey(\App\Models\LegalPage::KEY_CONSENT);

        if (! $page) {
            abort(404);
        }

        return view('personal-data', compact('page'));
    }
}

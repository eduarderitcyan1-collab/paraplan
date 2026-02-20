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
        
        return view('welcome', compact('whyUs', 'tarifs', 'services', 'team', 'sertificates', 'offers', 'reviews', 'about', 'flyPoints'));
    }

    public function uslugi()
    {
        $tarifs = Tarif::ordered()->get();
        return view('service', compact('tarifs'));
    }
}

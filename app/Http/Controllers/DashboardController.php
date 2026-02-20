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

class DashboardController extends Controller
{
    public function dashboard()
    {
        $whyUsCount = WhyUs::count();
        $tarifCount = Tarif::count();
        $serviceCount = Service::count();
        $teamCount = Team::count();
        $sertificateCount = Sertificate::count();
        $offerCount = Offer::count();
        $reviewCount = Review::count();

        return view('dashboard', compact('offerCount', 'whyUsCount', 'tarifCount', 'serviceCount', 'teamCount', 'sertificateCount', 'reviewCount'));
    }
}

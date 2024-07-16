<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function about()
    {
        return view('about.index');
    }

    public function skills()
    {
        return view('dashboard.skills');
    }

    public function resume()
    {
        return view('dashboard.resume');
    }

    public function service()
    {
        return view('dashboard.service');
    }

    public function portfolio()
    {
        return view('dashboard.portfolio');
    }

    public function testimonial()
    {
        return view('dashboard.testimonial');
    }

    public function generalSettings()
    {
        return view('dashboard.general-settings');
    }

    public function contacts()
    {
        return view('dashboard.contacts');
    }
}

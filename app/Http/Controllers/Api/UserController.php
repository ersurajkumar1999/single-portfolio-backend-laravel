<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\UserResume;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\GeneralSettings;
use App\Models\Skill;
use App\Models\User;
use App\Models\UserGeneralSetting;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userId;

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::with([
            'about.items' => function ($query) {
                $query->where('status', true); // Filter active items
            },
            'skills.items' => function ($query) {
                $query->where('status', true); // Filter active items
            },
            'userResume' => function ($query) {
                $query->with([
                    'experienceEntries' => function ($query) {
                        $query->where('status', true); // Filter active entries
                    },
                    'educationEntries' => function ($query) {
                        $query->where('status', true); // Filter active entries
                    },
                ]);
            },
            'service.items' => function ($query) {
                $query->where('status', true); // Filter active items
            },
            'portfolio.items' => function ($query) {
                $query->where('status', true); // Filter active items
            },
            'testimonial.items' => function ($query) {
                $query->where('status', true); // Filter active items
            },
            'generalSettings',
        ])->first();

        return response()->json(['message' => 'User information was get successfully', 'data' => $user], 201);
    }

    /**
     * Display user about information.
     */
    public function about()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User about information retrieved successfully', 'data' => $about], 200);
    }

    /**
     * Display user skills information.
     */
    public function skills()
    {
        $skills = Skill::with('items')->where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User skills information retrieved successfully', 'data' => $skills], 200);
    }

    /**
     * Display user resume information.
     */
    public function resume()
    {
        $resume = UserResume::with([
            'experienceEntries' => function ($query) {
                $query->where('status', true); // Filter active entries
            },
            'educationEntries' => function ($query) {
                $query->where('status', true); // Filter active entries
            },
        ])->where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User resume retrieved successfully', 'data' => $resume], 200);
    }

    /**
     * Display user services information.
     */
    public function service()
    {
        $services = Service::with('items')->where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User services retrieved successfully', 'data' => $services], 200);
    }

    /**
     * Display user portfolio information.
     */
    public function portfolio()
    {
        $portfolio = Portfolio::with('items')->where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User portfolio retrieved successfully', 'data' => $portfolio], 200);
    }

    /**
     * Display user testimonials information.
     */
    public function testimonial()
    {
        $testimonials = Testimonial::with('items')->where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User testimonials retrieved successfully', 'data' => $testimonials], 200);
    }

    /**
     * Display user general settings information.
     */
    public function generalSettings()
    {
        $generalSettings = UserGeneralSetting::where('user_id', $this->userId)->first();
        return response()->json(['message' => 'User general settings retrieved successfully', 'data' => $generalSettings], 200);
    }
}

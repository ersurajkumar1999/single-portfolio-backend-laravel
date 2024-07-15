<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user = User::with([
        //     'about.items',
        //     'skills.items',
        //     'userResume.experienceEntries',
        //     'userResume.educationEntries',
        //     'service.items',
        //     'portfolio.items',
        //     'testimonial.items',
        //     'generalSettings',
        // ])->first();
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

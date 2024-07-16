<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAboutRequest;
use App\Models\About;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    protected $userId;
    protected $aboutId;

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
        $this->aboutId = 1;
    }
    public function index()
    {
        return view('dashboard.index');
    }

    public function about()
    {
        $about  = About::with('items')->where('user_id', $this->userId)->first();
        return view('about.index', compact('about'));
    }
    public function aboutUpdate(UpdateAboutRequest $request, About $about)
    {
        $validated = $request->validated();
        Log::info('Validated data:', $validated);
        try {
            // Check if the image is present in the request
            if ($request->hasFile('image')) {
                // Store the uploaded image in the public disk and the about_images directory
                $imagePath = $request->file('image')->store('about_images', 'public');

                // Add the image path to the validated data array
                $validated['image'] = $imagePath;
            }

            // Update the about entity with validated data
            $data = $about->update($validated);

            // Debugging line to see the result of the update
            Log::info('Update result:', ['result' => $data]);

            if ($data) {
                flash()->success('About section updated successfully.');
            } else {
                flash()->error('Failed to update about section.');
            }
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the about section.');
        }
        return redirect()->back();
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateContactRequest;
use App\Models\About;
use App\Models\Contact;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\UserGeneralSetting;
use App\Models\UserResume;
use App\Models\UserSocialLink;
use Exception;

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
        try {
            $about = About::with(['items' => function ($query) {
                $query->where('status', true); // Only retrieve active items
            }])->where('user_id', $this->userId)->first();
            return $this->successResponse('User About retrieved successfully', $about);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the About', 500, $e->getMessage());
        }
    }

    /**
     * Display user skills information.
     */
    public function skills()
    {
        try {
            $skill = Skill::with(['items' => function ($query) {
                $query->where('status', true); // Only retrieve active items
            }])->where('user_id', $this->userId)->first();
            return $this->successResponse('User skills retrieved successfully', $skill);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the skills', 500, $e->getMessage());
        }
    }

    /**
     * Display user resume information.
     */
    public function resume()
    {
        try {
            $resume = UserResume::with([
                'experienceEntries' => function ($query) {
                    $query->where('status', true); // Filter active entries
                },
                'educationEntries' => function ($query) {
                    $query->where('status', true); // Filter active entries
                },
            ])->where('user_id', $this->userId)->first();
            return $this->successResponse('User resume retrieved successfully', $resume);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the resume', 500, $e->getMessage());
        }
    }

    /**
     * Display user services information.
     */
    public function service()
    {
        try {
            $service = Service::with(['items' => function ($query) {
                $query->where('status', true); // Only retrieve active items
            }])->where('user_id', $this->userId)->first();
            return $this->successResponse('User Service retrieved successfully', $service);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the Service', 500, $e->getMessage());
        }
    }

    /**
     * Display user portfolio information.
     */
    public function portfolio()
    {
        try {
            $portfolio = Portfolio::with(['items' => function ($query) {
                $query->where('status', true); // Only retrieve active items
            }])->where('user_id', $this->userId)->first();
            return $this->successResponse('User Portfolio retrieved successfully', $portfolio);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the Portfolio', 500, $e->getMessage());
        }
    }
    public function project()
    {
        try {
            $project = Project::with(['items' => function ($query) {
                $query->where('status', true); // Only retrieve active items
            }])->where('user_id', $this->userId)->first();

            return $this->successResponse('User project retrieved successfully', $project);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the project', 500, $e->getMessage());
        }
    }

    /**
     * Display user testimonials information.
     */
    public function testimonial()
    {
        try {
            $testimonial = Testimonial::with(['items' => function ($query) {
                $query->where('status', 1); // Only retrieve active items
            }])->where('user_id', $this->userId)->first();

            return $this->successResponse('User testimonials retrieved successfully', $testimonial);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the testimonials', 500, $e->getMessage());
        }
    }

    /**
     * Display user general settings information.
     */
    public function generalSettings()
    {
        try {
            $generalSettings = UserGeneralSetting::where('user_id', $this->userId)->first();
            return $this->successResponse('User general settings retrieved successfully', $generalSettings);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the general settings', 500, $e->getMessage());
        }
    }
    public function getGeneralSettings()
    {
        $data = [];
        try {

            $user = User::find($this->userId)->first();
            $generalSettings = UserGeneralSetting::where('user_id', $this->userId)->first();
            $social_links = UserSocialLink::select('id', 'platform', 'icon', 'link')->where('user_id', $this->userId)->get();
            $full_address = $generalSettings->address . ", " . $generalSettings->city . ", " . $generalSettings->state . ", " . $generalSettings->country;
            $data['name'] = $user->name;
            $data['image'] = $user->image;
            $data['header_title'] = $generalSettings->header_title;
            $data['header_description'] = $generalSettings->header_description;
            $data['banner_image'] = $generalSettings->banner_image;
            $data['contact_title'] = $generalSettings->contact_title;
            $data['contact_description'] = $generalSettings->contact_description;
            $data['social_links'] = $social_links;
            $data['full_address'] = $full_address;
            $data['email1'] = $generalSettings->email1;
            $data['email2'] = $generalSettings->email2;
            $data['number1'] = $generalSettings->number1;
            $data['number2'] = $generalSettings->number2;
            $data['theme_color'] = $generalSettings->theme_color;
            $data['nav_items'] = json_decode($generalSettings->nav_items, true);
            $data['copyright_description'] = $generalSettings->copyright_description;

            // $data['generalSettings'] = $generalSettings;

            return $this->successResponse('User general settings retrieved successfully', $data);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the general settings', 500, $e->getMessage());
        }
    }

    public function contactCreate(CreateContactRequest $request)
    {
        $validated = $request->validated();
        try {
            $validated['user_id'] = $this->userId;

            $contact = Contact::create($validated);
            return $this->successResponse('Contact Data store successfully', $contact);
        } catch (Exception $e) {
            return $this->errorResponse('An error occurred while retrieving the Contact', 500, $e->getMessage());
        }
    }

    private function successResponse($message, $data = [], $status = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    private function errorResponse($message, $status = 500, $error = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'error' => $error,
        ], $status);
    }
}

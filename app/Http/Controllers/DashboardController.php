<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Http\Requests\CreateAboutItemRequest;
use App\Http\Requests\CreatePortfolioItemRequest;
use App\Http\Requests\CreateProjectItemRequest;
use App\Http\Requests\CreateServiceItemRequest;
use App\Http\Requests\CreateSkillItemRequest;
use App\Http\Requests\CreateTestimonialItemRequest;
use App\Http\Requests\StoreEducationEntryRequest;
use App\Http\Requests\StoreExperienceEntryRequest;
use App\Http\Requests\StoreUserSocialLinkRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateResumeRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Http\Requests\UpdateTestimonialRequest;
use App\Http\Requests\UpdateUserGeneralSettingsRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\About;
use App\Models\AboutItem;
use App\Models\Contact;
use App\Models\EducationEntry;
use App\Models\ExperienceEntry;
use App\Models\Portfolio;
use App\Models\PortfolioItem;
use App\Models\Project;
use App\Models\ProjectItem;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Skill;
use App\Models\SkillItem;
use App\Models\Testimonial;
use App\Models\TestimonialItem;
use App\Models\User;
use App\Models\UserGeneralSetting;
use App\Models\UserResume;
use App\Models\UserSocialLink;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    protected $userId;
    protected $aboutId;
    protected $skillId;
    protected $serviceId;
    protected $projectId;
    protected $testimonialId;
    protected $portfolioId;
    protected $resumeId;

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
        $this->aboutId = 1;
        $this->skillId = 1;
        $this->serviceId = 1;
        $this->projectId = 1;
        $this->testimonialId = 1;
        $this->portfolioId = 1;
        $this->resumeId = 1;
    }
    public function index()
    {
        $aboutItemCount = AboutItem::where('about_id', $this->aboutId)->count();
        $skillItemCount = SkillItem::where('skill_id', $this->skillId)->count();
        $serviceItemCount = ServiceItem::where('service_id', $this->serviceId)->count();
        $projectItemCount = ProjectItem::where('project_id', $this->projectId)->count();
        $testimonialItemCount = TestimonialItem::where('testimonial_id', $this->testimonialId)->count();
        $portfolioItemCount = PortfolioItem::where('portfolio_id', $this->portfolioId)->count();
        $contactItemCount = Contact::where('user_id', $this->userId)->count();
        $educationItemCount = EducationEntry::where('user_id', $this->userId)->count();
        $experienceItemCount = ExperienceEntry::where('user_id', $this->userId)->count();

        return view('dashboard.index', compact(
            'aboutItemCount',
            'skillItemCount',
            'serviceItemCount',
            'projectItemCount',
            'testimonialItemCount',
            'portfolioItemCount',
            'contactItemCount',
            'educationItemCount',
            'experienceItemCount'
        ));
    }

    public function about()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('about.index', compact('about'));
    }
    public function aboutUpdate(UpdateAboutRequest $request)
    {
        $validated = $request->validated();
        try {
            $about = About::where('user_id', $this->userId)->firstOrFail();

            if ($request->hasFile('image')) {
                // Generate a unique file name
                $image = $request->file('image');
                $fileName = 'about-image-' . $this->aboutId . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'about-images');
                $validated['image'] = $imagePath;
            }

            $about->update($validated);
            flash()->success('About section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the about section.');
        }
        return redirect()->back();
    }

    public function aboutItemCreate(CreateAboutItemRequest $request)
    {
        $validated = $request->validated();
        $itemId = $request->id;
        try {
            $validated['about_id'] = $this->aboutId;
            if ($itemId) {
                // Update existing item
                $aboutItem = AboutItem::findOrFail($itemId);
                $aboutItem->update($validated);
                flash()->success('About item updated successfully.');
            } else {
                // Create new item
                AboutItem::create($validated);
                flash()->success('About item created successfully.');
            }

            return redirect()->route('about.index');
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the about item.');
            Log::error('Error saving about item:', ['message' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred while saving the about item.');
        }
    }
    public function aboutItemDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = AboutItem::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Item deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving about item:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the item.');
        }
        return redirect()->back();
    }

    public function skills()
    {
        $skill = Skill::with('items')->where('user_id', $this->userId)->first();
        return view('skills.index', compact('skill'));
    }
    public function skillUpdate(UpdateSkillRequest $request)
    {
        $validated = $request->validated();
        try {
            $about = Skill::where('user_id', $this->userId)->firstOrFail();
            $about->update($validated);
            flash()->success('Skill section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Skill section.');
        }
        return redirect()->back();
    }
    public function skillItemCreate(CreateSkillItemRequest $request)
    {
        $validated = $request->validated();
        $itemId = $request->id;
        try {
            $validated['skill_id'] = $this->skillId;
            if ($itemId) {
                // Update existing item
                $aboutItem = SkillItem::findOrFail($itemId);
                $aboutItem->update($validated);
                flash()->success('Skill item updated successfully.');
            } else {
                // Create new item
                SkillItem::create($validated);
                flash()->success('Skill item created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the about item.');
            Log::error('Error saving about item:', ['message' => $e->getMessage()]);
        }
        return redirect()->route('skills.index');
    }
    public function skillItemDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = SkillItem::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Skill deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving about item:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the item.');
        }
        return redirect()->back();
    }

    public function resume()
    {
        $resume = UserResume::where('user_id', $this->userId)->first();
        $educations = EducationEntry::where('user_id', $this->userId)->orderBy('id', 'desc')->get();
        $experiences = ExperienceEntry::where('user_id', $this->userId)->orderBy('id', 'desc')->get();
        return view('resume.index', compact(['resume', 'educations', 'experiences']));
    }

    public function resumeUpdate(UpdateResumeRequest $request)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('resume')) {
                // Generate a unique file name
                $image = $request->file('resume');
                $fileName = 'resume-' . $this->userId . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'resumes');
                $validated['resume'] = $imagePath;
            }
            $resume = UserResume::where('user_id', $this->userId)->firstOrFail();
            $resume->update($validated);
            flash()->success('Resume section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Resume section.');
        }
        return redirect()->back();
    }
    public function removeResumePdf()
    {
        try {
            $validated['resume'] = null;
            $resume = UserResume::where('user_id', $this->userId)->firstOrFail();
            $resume->update($validated);
            flash()->success('Resume remove successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Resume section.');
        }
        return redirect()->back();
    }

    public function experienceCreate(StoreExperienceEntryRequest $request)
    {
        $validated = $request->validated();
        $experienceId = $request->id;
        try {
            $validated['user_id'] = $this->userId;
            if ($experienceId) {
                $experience = ExperienceEntry::findOrFail($experienceId);
                $experience->update($validated);
                flash()->success('Experience updated successfully.');
            } else {
                ExperienceEntry::create($validated);
                flash()->success('Experience created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Experience.');
            Log::error('Error saving Experience:', ['message' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    public function experienceDelete(Request $request)
    {
        try {
            $experience = ExperienceEntry::findOrFail($request->delete_experience_id);
            $experience->delete();
            flash()->success('Experience deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Experience:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the Experience.');
        }
        return redirect()->back();
    }
    public function educationCreate(StoreEducationEntryRequest $request)
    {
        $validated = $request->validated();
        $educationId = $request->id;
        try {
            $validated['user_id'] = $this->userId;
            if ($educationId) {
                $education = EducationEntry::findOrFail($educationId);
                $education->update($validated);
                flash()->success('Education updated successfully.');
            } else {
                EducationEntry::create($validated);
                flash()->success('Education created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Education.');
            Log::error('Error saving Education:', ['message' => $e->getMessage()]);
        }
        return redirect()->back();
    }

    public function educationDelete(Request $request)
    {
        $educationId = $request->delete_education_id;
        try {
            $education = EducationEntry::findOrFail($educationId);
            $education->delete();
            flash()->success('Education deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Education:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the Education.');
        }
        return redirect()->back();
    }
    public function service()
    {
        $service = Service::with('items')->where('user_id', $this->userId)->first();
        return view('service.index', compact('service'));
    }
    public function serviceUpdate(UpdateServiceRequest $request)
    {
        $validated = $request->validated();
        try {
            $service = Service::where('user_id', $this->userId)->firstOrFail();
            $service->update($validated);
            flash()->success('Service section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Service section.');
        }
        return redirect()->back();
    }
    public function serviceItemCreate(CreateServiceItemRequest $request)
    {
        $validated = $request->validated();
        $itemId = $request->id;
        try {
            $validated['service_id'] = $this->serviceId;
            if ($itemId) {
                // Update existing item
                $aboutItem = ServiceItem::findOrFail($itemId);
                $aboutItem->update($validated);
                flash()->success('Service item updated successfully.');
            } else {
                // Create new item
                ServiceItem::create($validated);
                flash()->success('Service item created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Service item.');
            Log::error('Error saving Service item:', ['message' => $e->getMessage()]);
        }
        return redirect()->route('service.index');
    }
    public function serviceItemDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = ServiceItem::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Service deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Service item:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the item.');
        }
        return redirect()->back();
    }

    public function portfolio()
    {
        $portfolio = Portfolio::with('items')->where('user_id', $this->userId)->first();
        return view('portfolio.index', compact('portfolio'));
    }

    public function portfolioUpdate(UpdatePortfolioRequest $request)
    {
        $validated = $request->validated();
        try {
            $portfolio = Portfolio::where('user_id', $this->userId)->firstOrFail();
            $portfolio->update($validated);
            flash()->success('Portfolio section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Portfolio section.');
        }
        return redirect()->back();
    }

    public function portfolioItemCreate(CreatePortfolioItemRequest $request)
    {
        $validated = $request->validated();
        $itemId = $request->id;
        try {

            $validated['image'] = asset('assets/images/default.png');

            if ($request->hasFile('image')) {
                // Generate a unique file name
                $image = $request->file('image');
                $fileName = 'portfolio-image-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'portfolio');
                $validated['image'] = $imagePath;
            }

            $validated['portfolio_id'] = $this->portfolioId;
            if ($itemId) {
                // Update existing item
                $portfolio = PortfolioItem::findOrFail($itemId);
                if (!$request->hasFile('image')) {
                    $validated['image'] = $portfolio->image;
                }
                $portfolio->update($validated);
                flash()->success('Portfolio item updated successfully.');
            } else {
                // Create new item
                PortfolioItem::create($validated);
                flash()->success('Portfolio item created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Portfolio item.');
            Log::error('Error saving Portfolio item:', ['message' => $e->getMessage()]);
        }
        return redirect()->route('portfolio.index');
    }
    public function portfolioItemDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = PortfolioItem::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Portfolio deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Portfolio item:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the item.');
        }
        return redirect()->back();
    }
    public function project()
    {
        $project = Project::with('items')->where('user_id', $this->userId)->first();
        return view('project.index', compact('project'));
    }
    public function projectUpdate(UpdateProjectRequest $request)
    {
        $validated = $request->validated();
        try {
            $project = Project::where('user_id', $this->userId)->firstOrFail();
            $project->update($validated);
            flash()->success('Project section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Project section.');
        }
        return redirect()->back();
    }
    public function projectItemCreate(CreateProjectItemRequest $request)
    {
        // Check if the image is required and not present in the request
        if (!$request->hasFile('image') && !$request->id) {
            flash()->error('Please select an image.');
            return redirect()->back()->withInput();
        }

        $validated = $request->validated();
        // dd($validated, $request->all());
        $itemId = $request->id;

        try {
            $validated['project_id'] = $this->projectId;

            if ($request->hasFile('image')) {
                // Generate a unique file name
                $image = $request->file('image');
                $fileName = 'project-image-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'project');
                $validated['image'] = $imagePath;
            }

            if ($itemId) {
                // Update existing item
                $aboutItem = ProjectItem::findOrFail($itemId);
                $aboutItem->update($validated);
                flash()->success('Projec item updated successfully.');
            } else {
                // Create new item
                ProjectItem::create($validated);
                flash()->success('Projec item created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Projec item.');
            Log::error('Error saving Projec item:', ['message' => $e->getMessage()]);
        }
        return redirect()->route('project.index');
    }
    public function projectItemDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = ProjectItem::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Project deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Project item:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the item.');
        }
        return redirect()->back();
    }

    public function testimonial()
    {
        $testimonial = Testimonial::with('items')->where('user_id', $this->userId)->first();
        return view('testimonial.index', compact('testimonial'));
    }
    public function testimonialUpdate(UpdateTestimonialRequest $request)
    {
        $validated = $request->validated();
        try {
            $testimonial = Testimonial::where('user_id', $this->userId)->firstOrFail();
            $testimonial->update($validated);
            flash()->success('Testimonial section updated successfully.');
        } catch (Exception $e) {
            Log::error('Update error:', ['message' => $e->getMessage()]);
            toastr()->error('An error occurred while updating the Testimonial section.');
        }
        return redirect()->back();
    }
    public function testimonialItemCreate(CreateTestimonialItemRequest $request)
    {
        $validated = $request->validated();
        $itemId = $request->id;
        try {
            $validated['testimonial_id'] = $this->testimonialId;

            $validated['image'] = asset('assets/images/default.png');

            if ($request->hasFile('image')) {
                // Generate a unique file name
                $image = $request->file('image');
                $fileName = 'testimonial-image-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'testimonial');
                $validated['image'] = $imagePath;
            }

            if ($itemId) {
                // Update existing item
                $testimonialItem = TestimonialItem::findOrFail($itemId);
                $testimonialItem->update($validated);
                flash()->success('Testimonial item updated successfully.');
            } else {
                // Create new item
                TestimonialItem::create($validated);
                flash()->success('Testimonial item created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Testimonial item1111111.');
            Log::error('Error saving Testimonial item:', ['message' => $e->getMessage()]);
        }
        return redirect()->route('testimonial.index');
    }
    public function testimonialItemDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = TestimonialItem::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Testimonial deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Testimonial item:', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the item.');
        }
        return redirect()->back();
    }

    public function socialLink()
    {
        $items = UserSocialLink::where('user_id', $this->userId)->orderBY('id', 'desc')->get();
        return view('social-links.index', compact('items'));
    }
    public function socialLinkCreate(StoreUserSocialLinkRequest $request)
    {
        $validated = $request->validated();
        $itemId = $request->id;
        try {
            $validated['user_id'] = $this->userId;
            if ($itemId) {
                // Update existing item
                $testimonialItem = UserSocialLink::findOrFail($itemId);
                $testimonialItem->update($validated);
                flash()->success('Social Link updated successfully.');
            } else {
                // Create new item
                UserSocialLink::create($validated);
                flash()->success('Social Link created successfully.');
            }
        } catch (Exception $e) {
            flash()->error('An error occurred while saving the Social Link.');
            Log::error('Error saving Social Link:', ['message' => $e->getMessage()]);
        }
        return redirect()->back();
    }
    public function socialLinkDelete(Request $request)
    {
        try {
            // Find the item by ID
            $item = UserSocialLink::findOrFail($request->delete_item_id);
            // Delete the item
            $item->delete();
            flash()->success('Social Link deleted successfully.');
        } catch (Exception $e) {
            Log::error('Error saving Social Link :', ['message' => $e->getMessage()]);
            flash()->error('An error occurred while deleting the Social Link.');
        }
        return redirect()->back();
    }

    public function generalSettings()
    {
        // Access the employment types array from the model
        $employmentTypes = UserGeneralSetting::$employmentTypes;
        $setting = UserGeneralSetting::where('user_id', $this->userId)->first();
        return view('general-setting.index', compact(['setting', 'employmentTypes']));
    }
    public function generalSettingsUpdate(UpdateUserGeneralSettingsRequest $request)
    {
        $validated = $request->validated();
        try {
            // Validate the request data
            $validated = $request->validated();

            if ($request->hasFile('banner_image')) {
                // Generate a unique file name
                $image = $request->file('banner_image');
                $fileName = 'banner-image-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'banners');
                $validated['banner_image'] = $imagePath;
            }

            // Retrieve the setting record by id
            $setting = UserGeneralSetting::where('user_id', $this->userId)->first();

            // Update the setting record with validated data
            $setting->update($validated);

            flash()->success('Settings updated successfully.');
        } catch (\Exception $e) {
            // Flash error message
            flash()->errro('An error occurred while updating the settings: ' . $e->getMessage());
        }

        // Redirect back to the settings page
        return redirect()->route('general-setting.index');
    }

    public function contacts()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        $contacts = Contact::where('user_id', $this->userId)->get();
        return view('contacts.index', compact('about', 'contacts'));
    }
    public function profile()
    {
        $user = User::where('id', $this->userId)->first();
        return view('profile.index', compact('user'));
    }
    public function profileUpdate(UpdateUserRequest $request)
    {
        $validated = $request->validated();
        try {
            if ($request->hasFile('image')) {
                // Generate a unique file name
                $image = $request->file('image');
                $fileName = 'user-image-' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = ImageUploadHelper::uploadImage($image, $fileName, 'users');
                $validated['image'] = $imagePath;
            }

            $user = User::where('id', $this->userId)->first();
            $user->update($validated);

            flash()->success('User updated successfully.');
        } catch (Exception $e) {
            // Flash error message
            flash()->errro('An error occurred while updating the User: ' . $e->getMessage());
        }
        // Redirect back to the settings page
        return redirect()->route('profile.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Helpers\ImageUploadHelper;
use App\Http\Requests\CreateAboutItemRequest;
use App\Http\Requests\CreateProjectItemRequest;
use App\Http\Requests\CreateServiceItemRequest;
use App\Http\Requests\CreateSkillItemRequest;
use App\Http\Requests\UpdateAboutRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Requests\UpdateSkillRequest;
use App\Models\About;
use App\Models\AboutItem;
use App\Models\Portfolio;
use App\Models\Project;
use App\Models\ProjectItem;
use App\Models\Service;
use App\Models\ServiceItem;
use App\Models\Skill;
use App\Models\SkillItem;
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

    // Constructor
    public function __construct()
    {
        // Initialize any property
        $this->userId = 1;
        $this->aboutId = 1;
        $this->skillId = 1;
        $this->serviceId = 1;
        $this->projectId = 1;
    }
    public function index()
    {
        return view('dashboard.index');
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
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('resume.index', compact('about'));
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
    public function portfolioItemCreate(CreateServiceItemRequest $request)
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
    public function portfolioItemDelete(Request $request)
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
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('testimonial.index', compact('about'));
    }

    public function generalSettings()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('general-setting.index', compact('about'));
    }

    public function contacts()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('contacts.index', compact('about'));
    }
    public function profile()
    {
        $about = About::with('items')->where('user_id', $this->userId)->first();
        return view('profile.index', compact('about'));
    }
}

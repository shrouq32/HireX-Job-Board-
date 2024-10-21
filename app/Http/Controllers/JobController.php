<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use App\Models\JobType;
use App\Models\JobStatus;
use App\Models\Employer;
use App\Models\User;
use App\Models\Comment;
use App\Http\Controllers\JobCategory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class JobController extends Controller
{
    public function index(Request $request)
    {

        $userId = auth()->id();


        if (!$userId || !User::find($userId)) {
            abort(404);
        }


        $search = $request->input('search');


        $jobs = Job::with('jobType')
            ->withCount('applications')
            ->whereHas('status', function ($query) {
                $query->where('name', 'accepted');
            })
            ->when($search, function ($query, $search) {
                $query->where('title', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('jobType', function ($query) use ($search) {
                        $query->where('name', 'LIKE', '%' . $search . '%');
                    });
            })
            ->paginate(4);

        $categories = Category::all();

        return view('jobs.alljobs', compact('jobs', 'categories'));
    }

    // public function show($id)
    // {
    //     $job = Job::with('employer', 'jobType', 'status', 'comments.user')->findOrFail($id);

    //     return view('jobs.jobdetails', compact('job'));
    // }



    public function create()
    {
        $types = JobType::all();
        $statuses = JobStatus::all();
        $categories = Category::all();

        return view('jobs.createjob', compact('categories', 'types', 'statuses'));
    }

    public function store(StoreJobRequest $request)
    {
        $user = Auth::user();

        // Check if user is an employer
        if ($user->role != 2) {
            return redirect()->route('home')->with('error', 'Access Denied. Only employers can post jobs.');
        }

        // Get employer ID
        $emp_id = Employer::where('user_id', $user->id)->value('id');
        if (!$emp_id) {
            return redirect()->route('home')->with('error', 'Employer profile not found. Please complete your employer profile.');
        }

        // Validate and upload the logo
        $imagePath = null;
        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('job_logos', 'public'); // Save image in 'job_logos' directory
        }

     
        $validatedData = $request->validated();


        $job = new Job();
        $job->title = $validatedData['title'];
        $job->description = $validatedData['description'];
        $job->requirements = $validatedData['requirements'];
        $job->location = $validatedData['location'];
        $job->category_id = $validatedData['category_id'];
        $job->job_status = 1;
        $job->job_type = $validatedData['job_type'];
        $job->responsibilities = $validatedData['responsibilities'];
        $job->salary = $validatedData['salary'];
        $job->benefits = $validatedData['benefits'];
        $job->deadline = $validatedData['deadline'];
        $job->emp_id = $emp_id;

      
        if ($imagePath) {
            $job->logo = $imagePath;
        }

    
        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }


    public function show($id)
    {
        $job = Job::with('employer', 'jobType', 'status', 'comments.user')->findOrFail($id);

        return view('jobs.jobdetails', compact('job'));
    }




    public function edit($id)
    {
        // Fetch the job to edit
        $job = Job::findOrFail($id);

        // Ensure the user is an employer
        if (Auth::user()->role != 2) {
            return redirect()->route('home')->with('error', 'Access Denied. Only employers can edit jobs.');
        }
        $categories = Category::all();
        $statuses = JobStatus::all();
        $jobTypes = JobType::all();

        // Return the view with job data
        return view('jobs.edit', compact('job', 'categories', 'statuses', 'jobTypes'));
    }

    public function update(UpdateJobRequest $request, $id)
    {
        $user = auth()->user();
        $job = Job::findOrFail($id);
        if ($user->role != 2) {
            return redirect()->route('home')->with('error', 'Access Denied. Only employers can view their job postings.');
        }
        $employer = Employer::where('user_id', $user->id)->first();
        $job->update($request->validated());
        $jobs = Job::with('employer', 'jobType', 'status')
            ->where('emp_id', $employer->id)
            ->whereHas('status', function ($query) {
                $query->where('name', 'accepted');
            })
            ->get();

        return view('jobs.myjobs', compact('jobs'));
    }
    public function search(Request $request)

    {
        $jobs = Job::with('jobType')
            ->withCount('applications')
            ->whereHas('status', function ($query) {
                $query->where('name', 'accepted');
            });

        // Apply filters if they exist
        if ($request->filled('keyword')) {
            $jobs->where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('description', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('category')) {
            $jobs->where('category_id', $request->category);
        }

        if ($request->filled('location')) {
            $jobs->where('location', $request->location);
        }

        // Fetch filtered jobs
        $jobs = $jobs->with('jobType', 'status', 'category')->paginate(10);

        // Get categories and locations for the search form
        $categories = Category::all();
        $locations = Job::select('location')->distinct()->get();

        return view('jobs.search', compact('jobs', 'categories', 'locations'));
    }


    public function destroy($id)
    {
        // Fetch the job to delete
        $job = Job::findOrFail($id);

        // Ensure the user is an employer
        if (Auth::user()->role != 2) {
            return redirect()->route('home')->with('error', 'Access Denied. Only employers can delete jobs.');
        }

        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }
    public function showAnalytics($id)
    {
        $job = Job::with('applications')->findOrFail($id);
        $applicationCount = $job->applications->count();

        return view('employers.job.analytics', compact('job', 'applicationCount'));
    }


     public function showEmployerJobs()
     {
        $user = auth()->user();


        if ($user->role != 2) {
            return redirect()->route('home')->with('error', 'Access Denied. Only employers can view their job postings.');
        }
        $employer = Employer::where('user_id', $user->id)->first();

        if (!$employer) {
            return redirect()->route('home')->with('error', 'Employer profile not found. Please complete your employer profile.');
        }


        $jobs = Job::with('employer', 'jobType', 'status')
            ->where('emp_id', $employer->id)
            ->whereHas('status', function ($query) {
                $query->where('name', 'accepted');
            })
            ->get();

        return view('jobs.myjobs', compact('jobs'));
    }

    public function showByCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);


        $jobs = Job::where('category_id', $categoryId)
            ->where('job_status', 3)
            ->get();

        return view('jobs.jobbycategory', compact('jobs', 'category'));
    }
}

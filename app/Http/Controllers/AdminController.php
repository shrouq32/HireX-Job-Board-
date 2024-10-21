<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function index()
    {

        $employersCount = Employer::count();
        $candidatesCount = Candidate::count();
        $jobsCount = Job::count();
        $categoriesCount = Category::count();

        // Get distinct dates and counts for employers, candidates, and jobs
        $employerDates = Employer::selectRaw('DATE(created_at) as date')->distinct()->pluck('date')->toArray();
        $candidateDates = Candidate::selectRaw('DATE(created_at) as date')->distinct()->pluck('date')->toArray();
        $jobDates = Job::selectRaw('DATE(created_at) as date')->distinct()->pluck('date')->toArray();
    
        // Sort the date arrays
        sort($employerDates);
        sort($candidateDates);
        sort($jobDates);
    
        // Initialize empty data arrays with all dates set to 0
        $employersData = array_fill_keys($employerDates, 0);
        $candidatesData = array_fill_keys($candidateDates, 0);
        $jobsData = array_fill_keys($jobDates, 0);
    
        // Fetch actual data and merge it with initialized arrays
        $employersDataFromDB = Employer::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')->toArray();
    
        $candidatesDataFromDB = Candidate::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')->toArray();
    
        $jobsDataFromDB = Job::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')->toArray();
    
        // Merge the actual data with the initialized arrays
        $employersData = array_replace($employersData, $employersDataFromDB);
        $candidatesData = array_replace($candidatesData, $candidatesDataFromDB);
        $jobsData = array_replace($jobsData, $jobsDataFromDB);
    
        // Ensure data is sorted by date
        ksort($employersData);
        ksort($candidatesData);
        ksort($jobsData);
    
        return view('dashboard.index', [
            'employerDates' => $employerDates,  // Employer-specific dates
            'candidateDates' => $candidateDates,  // Candidate-specific dates
            'jobDates' => $jobDates,  // Job-specific dates
            'employersData' => array_values($employersData),  // Employer data as indexed array for chart
            'candidatesData' => array_values($candidatesData),  // Candidate data as indexed array for chart
            'jobsData' => array_values($jobsData),  // Job data as indexed array for chart
            'employersCount' => $employersCount,
            'candidatesCount' => $candidatesCount,
            'jobsCount' => $jobsCount,
            'categoriesCount' => $categoriesCount,
        ]);
    }
    

    public function employers(Request $request)
    {
        $search = $request->input('search');
    
        $query = Employer::query();
    
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }
    
        $employers = $query->paginate(10);
    
        return view('dashboard.employer', compact('employers'));
    }

    public function candidates(Request $request)
    {
        $search = $request->input('search');
    
        $query = Candidate::query();
    
        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%");
            });
        }
    
        $candidates = $query->paginate(10);
    
        return view('dashboard.candidate', compact('candidates'));
    }
    public function categories(Request $request)
    {
        $search = $request->input('search');
        
        $categories = Category::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('dashboard.category', compact('categories'));
    }
    public function jobs(Request $request)
    {
        $search = $request->input('search');

        $jobs = Job::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->with('employer.user', 'category', 'jobType', 'status')
            ->paginate(10);

        return view('dashboard.jobs', compact('jobs'));
    }


    public function editEmployer($id)
    {
        $employer = Employer::findOrFail($id);
        return view('dashboard.employer.edit', compact('employer'));
    }

    // Edit Candidate
    public function editCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('dashboard.candidate.edit', compact('candidate'));
    }

    // Edit Category
    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        return view('dashboard.category.edit', compact('category'));
    }

    // Edit Job
public function viewJob($id)
{
    // Fetch job, comments, and applications
    $comments = Comment::where('job_id', $id)->get();
    $applications = Application::where('job_id', $id)->with('candidate.user', 'status')->get();
    $job = Job::findOrFail($id);

    // Group applications by date
    $dates = $applications->groupBy(function ($application) {
        return Carbon::parse($application->created_at)->format('Y-m-d');  // Group by date (Y-m-d format)
    });

    // Prepare data for the chart: array of dates and application counts
    $applicationDates = $dates->keys()->toArray();  // Dates for x-axis
    $applicationCounts = $dates->map(function ($group) {
        return count($group);  // Count of applications on each date
    })->values()->toArray();  // Data for y-axis

    // Sort dates and counts in ascending order
    array_multisort($applicationDates, SORT_ASC, $applicationCounts);

    // Pass data to the view
    return view('dashboard.jobs.view', [
        'comments' => $comments,
        'job' => $job,
        'applications' => $applications,
        'applicationDates' => $applicationDates,
        'applicationCounts' => $applicationCounts,
    ]);
}



    public function deleteEmployer($id)
    {
        $employer = Employer::findOrFail($id);
        $employer->delete();
        return redirect()->route('employer');
    }

    // Delete Candidate
    public function deleteCandidate($id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->delete();
        return redirect()->route('candidate');
    }

    // Delete Category
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category');
    }

    // Delete Job
    public function deleteJob($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();
        return redirect()->route('jobs');
    }

    public function deleteComment($job_id, $id)
    {
        $comment = Comment::where('job_id', $job_id)->where('id', $id)->firstOrFail();
        $comment->delete();
        return redirect()->route('job.view', $job_id);
    }

    public function acceptJob($id)
    {
        $job = Job::findOrFail($id);
        $job->job_status = 3;
        $job->save();

        return redirect()->route('jobs');
    }

    public function storeCategory(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category');
    }

    public function categoryCreate()
    {
        return view('dashboard.category.add');
    }

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return redirect()->route('category');
    }
}
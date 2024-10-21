<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;



use App\Models\Employer;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
 

    public function index()
{
    $jobs = Job::with('jobType')
    ->withCount('applications')
    ->whereHas('status', function ($query) {
        $query->where('name', 'accepted');
    })
    ->paginate(3);

    $categories = Category::withCount('jobs')->get();
    $locations = Job::select('location')->distinct()->get();
    $feedback = Feedback::all();

    return view('home', compact('jobs', 'categories', 'locations', 'feedback'));
        

    

  
}public function aboutUs(){
    return view('about.AboutUs');
}
}

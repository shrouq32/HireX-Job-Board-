<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;  
use App\Models\Application;
use App\Models\User;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    public function index()
    {
        // Code to show all employers
        // $employers = Employer::all();
        // return view('employers.index', compact('employers'));
    }

    public function create()
    {
        return view('employers.create');
    }

    public function store(StoreEmployerRequest $request)
    {
        $user = Auth::user();
        
        $employer = new Employer();
        $employer->user_id = $user->id;
        $employer->company_name = $request->input('company_name');
        $employer->company_description = $request->input('company_description');
        $employer->company_website = $request->input('company_website');
        $employer->phone = $request->input('phone');
        $employer->save(); 

        // Update user's role to employer
        User::where('id', $user->id)->update(['role' => 2]);

        return redirect()->route('jobs.index')->with('success', 'Employer created and role set successfully.');
    }

    public function show(Employer $employer)
    {
        // return view('employers.show', compact('employer'));
    }

    public function edit( $id)
    {
        $employer = Employer::findOrfail($id); 
        return view('dashboard.employer.edit', compact('employer'));
    }

    public function update(UpdateEmployerRequest $request, Employer $employer)
    {
        // $employer->update($request->validated());

        // return redirect()->route('employers.index')->with('success', 'Employer updated successfully.');
    }

    public function myJobs()
    {
        $user = Auth::user(); // Get the currently authenticated user
        
        if ($user && $user->role == 2) {  // Ensure the user is an employer
            $employer = Employer::where('user_id', $user->id)->first(); // Find employer by user_id
            
            if ($employer) {
                // Fetch jobs only for the logged-in employer
                $jobs = Job::where('emp_id', $employer->id)->get();
                return view('jobs.myjobs', compact('jobs'));
            } else {
                return redirect()->route('home')->with('error', 'Employer data not found.');
            }
        } else {
            return redirect()->route('home')->with('error', 'Access Denied');
        }
    }
    
    public function showProfile()
    {
        $user = Auth::user();

        if ($user && $user->role == 2) {
            $employer = Employer::where('user_id', $user->id)->first();

            return view('empprofile', compact('employer', 'user'));
        } else {
            return redirect()->route('home')->with('error', 'You do not have permission to view this page.');
        }
    }

    public function editProfile(UpdateEmployerRequest $request, $id)
    {
        $employer = Employer::findOrFail($id);
        $employer->company_name = $request->input('company_name');
        $employer->company_description = $request->input('company_description');
        $employer->company_website = $request->input('company_website');
        $employer->phone = $request->input('phone');
        $employer->save(); 

        return redirect()->route('empprofile.showProfile')->with('success', 'Profile updated successfully');
    }
    
}

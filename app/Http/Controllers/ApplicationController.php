<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use App\Models\Candidate;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\IOFactory;
use App\Notifications\jobApp;
use App\Notifications\ApplicationStatusUpdatedNotification;



class ApplicationController extends Controller
{
  
    public function viewResume($id)
{
    $application = Application::findOrFail($id);
    $resumePath = $application->resume; 

   
    if (!Storage::disk('public')->exists($resumePath)) {
        return redirect()->back()->with('error', 'Resume file not found.');
    }

    return view('applications.view_resume', ['resumePath' => $resumePath]);

    }

    public function applyWithLinkedIn(Request $request, $jobId)
    {
        $user = Auth::user();
    
        Application::create([
            'job_id' => $jobId,
            'user_id' => $user->id,
            'linkedin_profile' => $user->linkedin_id,
            // other fields like resume, cover letter, etc.
        ]);
    
        return redirect()->route('jobs.index')->with('success', 'Your application has been submitted.');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $jobs = Job::findOrFail($request->query('job'));
        return view('applications.apply', compact('jobs'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048',
            'job_id' => 'required|exists:jobs,id',
        ]);


        $user = Auth::user();

        $candidate = Candidate::firstWhere('user_id', $user->id);



        if (!$candidate) {

            return redirect()->back()->with('error', 'Candidate not found.');
        }


        $resumePath = $request->file('resume')->store('resumes', 'public');


        $application = new Application();
        $application->candidate_id = $candidate->id;
        $application->job_id = $request->job_id;
        $application->status_id = 1;  
        $application->resume = $resumePath;
        $application->save();


        return redirect()->route('jobs.index')->with('success', 'Application submitted successfully.');
    }






    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


  
public function update(Request $request, $id)
{
    $application = Application::findOrFail($id);
    
   $application->status_id = $request->input('status');
    
    $application->save();
    $notification = Notifications::create ([
        "user_id" => $application->candidate_id,
        "job_id"=> $application->job_id,
        "status_id" => 3,       
    ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Application status updated successfully.');

    
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $application = Application::findOrFail($id);


            if (Auth::id() !== $application->candidate->user_id) {
                return redirect()->route('jobs.index')->with('error', 'You are not authorized to cancel this application.');
            }


            $application->delete();


            return redirect()->route('jobs.index')->with('success', 'Application cancelled successfully.');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }
    public function reject(Request $request, $id)
    {
        try {
            // Find the application by ID
            $application = Application::findOrFail($id);
    
            // Ensure that the authenticated user is the employer associated with the job
            if (Auth::id() !== $application->job->employer->user_id) {
                return redirect()->route('jobs.index')->with('error', 'You are not authorized to reject this application.');
            }
    
            // Update the application status to '3' (Rejected)
            $application->status_id =  $request->input("status");
            $application->save();
            $notification = Notifications::create ([
                "user_id" => $application->candidate_id,
                "job_id"=> $application->job_id,
                "status_id" => 2,       
            ]);
            // Redirect with success message
            return redirect()->route('jobs.show')->with('success', 'Application rejected successfully.');
        } catch (\Exception $e) {
            // Handle any errors during the process
            return redirect()->back()->with('error', 'An error occurred while processing your request.');
        }
    }
    


    
}


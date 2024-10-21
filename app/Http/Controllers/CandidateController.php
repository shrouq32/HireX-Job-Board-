<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Requests\UpdateCandidateRequest;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Smalot\PdfParser\Parser;
use App\Models\Application;



class CandidateController extends Controller
{
    /**
     * Display a listing of candidates.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $candidates = Candidate::all();
        return view('home', compact('candidates'));
    }

    /**
     * Show the form for creating a new candidate profile.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('candidates.create');
    }

    /**
     * Store a newly created candidate in storage.
     *
     * @param  \App\Http\Requests\StoreCandidateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCandidateRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $candidate = new Candidate();

        if($request->resume){
            $resumePath = $request->file('resume')->store('resumes', 'public');
            }else{
                $resumePath = null;
            }

        $candidate->user_id = Auth::id(); 
        $candidate->skills = $validatedData['skills']; 
      
        $candidate->resume = $resumePath;
        $candidate->education = $validatedData['education'];
        $candidate->experience = $validatedData['experience'];

        $candidate->save();
        User::where('id', $candidate->user_id)->update(['role' => 3]);

        return redirect()->route('jobs.index')
            ->with('success', 'Candidate profile created successfully.');
    }

    /**
     * Display the specified candidate.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\View\View
     */
    public function show(Candidate $candidate): View
    {
        return view('candidates.show', compact('candidate'));
    }






    /**
     * Show the form for editing the specified candidate.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\View\View
     */
    public function edit( $id): View
    {
        $candidate = Candidate::findOrfail($id);
        return view('dashboard.candidate.edit', compact('candidate'));
    }

    /**
     * Update the specified candidate in storage.
     *
     * @param  \App\Http\Requests\UpdateCandidateRequest  $request
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate): RedirectResponse
    {
        $validatedData = $request->validated();

        $candidate->skills = $validatedData['skills']; 
        $candidate->resume = $validatedData['resume'];
        $candidate->save();

        return redirect()->route('candidates.index')
            ->with('success', 'Candidate profile updated successfully.');
    }

    /**
     * Remove the specified candidate from storage.
     *
     * @param  \App\Models\Candidate  $candidate
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Candidate $candidate): RedirectResponse
    {
        $candidate->delete();

        return redirect()->route('candidates.index')
            ->with('success', 'Candidate profile deleted successfully.');
    }

    public function editProfile(UpdateCandidateRequest $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->skills = $request->input('skills');
        $candidate->education = $request->input('education');
        $candidate->experience = $request->input('experience');

        if ($request->hasFile('resume')) {
            if ($candidate->resume) {
                $resumePath = $request->file('resume')->store('resumes', 'public');
                }
            $candidate->resume = $resumePath;
        }

        // Save the updated candidate profile
        $candidate->save();

        // Redirect with success message
        return redirect()->route('profile.candidate', $candidate->id)->with('success', 'Profile updated successfully');
    }

}
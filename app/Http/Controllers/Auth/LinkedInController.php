<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Application;
use App\Models\Candidate;

use Illuminate\Http\Request;

class LinkedInController extends Controller
{
    // Redirect to LinkedIn for authentication
    public function redirectToLinkedIn(Request $request)
    {
        // Store job_id in session to use later after callback
        session(['job_id' => $request->job_id]);

        return Socialite::driver('linkedin')
        ->setScopes(['r_liteprofile', 'r_emailaddress'])
            ->redirect(); // Redirect to LinkedIn for authentication
    }

    // Handle LinkedIn's callback
    public function handleLinkedInCallback()
    {
        try {
            // Get LinkedIn user information after authentication
            $linkedinUser = Socialite::driver('linkedin')->user();
dd(  $linkedinUser );
            // Retrieve the job_id from session
            $job_id = session('job_id');

            // Check if the candidate already exists based on LinkedIn email
            $candidate = Candidate::where('email', $linkedinUser->email)->first();

            if (!$candidate) {
                // If not, create a new candidate
                $candidate = Candidate::create([
                    'name' => $linkedinUser->name,
                    'email' => $linkedinUser->email,
                    'linkedin_id' => $linkedinUser->id,
                    'avatar' => $linkedinUser->avatar,
                    'password' => bcrypt('default-password'), // Generate a secure password
                ]);
            }

            // Log the candidate in
            Auth::login($candidate);

            // Create the application entry
            Application::create([
                'candidate_id' => $candidate->id,
                'job_id' => $job_id,
                'status' => 1, // Or set an appropriate status
                'linkedin_id' => $linkedinUser->id,
                'resume' => null // No resume since it's via LinkedIn
            ]);

            return redirect()->route('home')->with('success', 'You have successfully applied for the job using LinkedIn.');
        } catch (Exception $e) {
            return redirect()->route('login')->with('error', 'Unable to apply using LinkedIn. Please try again.');
        }
    }
}
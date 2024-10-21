<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserProfileController extends Controller
{
    /**
     * Show the candidate profile for users with role 3.
     *
     * @param int $userId
     * @return \Illuminate\View\View
     */
    public function showCandidateProfile($userId)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role == 3) {
                $user = User::with('candidate')->findOrFail($user->id);

                return view('candidates.CandidateProfile', compact('user'));
            } else {
                return redirect()->route('home')->with('error', 'You are not authorized to view this profile.');
            }
        } else {
            return redirect()->route('login')->with('error', 'Please log in to view your profile.');
        }
    }

    /**
     * Show all candidate profiles (for users with role 3).
     *
     * @return \Illuminate\View\View
     */
    public function showAllCandidates()
    {   
            $user = Auth::user();

            if ($user->role == 3) {
                $user = User::with('candidate')->findOrFail($user->id);

                return view('candidates.CandidateProfile', compact('user'));
            } else {
                return redirect()->route('home')->with('error', 'You are not authorized to view this profile.');
            }
    }
}

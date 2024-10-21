<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    // Show the feedback form
    public function create()
    {
        return view('feedback.create');
    }

    // Store feedback
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'feedback' => 'required|string',
        ]);

        Feedback::create([
            'name' => $request->name,
         
            'feedback' => $request->feedback,
        ]);

        return redirect()->route('home')->with('success', 'Thank you for your feedback!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Future implementation or remove if not used.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Future implementation or remove if not used.
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Job $job)
{
    // Validate the input
    $request->validate([
        'comment' => 'required|string|max:1000',
    ]);

    try {
        // Create a new Comment instance
        $comment = new Comment([
            'user_id' => auth()->id(),
            'comment' => $request->input('comment'),
        ]);

        // Save the comment to the job
        $job->comments()->save($comment);

        // Redirect back to the job page with a success message
        return redirect()->route('jobs.show', $job->id)->with('success', 'Comment added successfully.');
    } catch (\Exception $e) {
        // If there is an error, redirect back with an error message
        return redirect()->route('jobs.show', $job->id)->with('error', 'Failed to add comment. Please try again.');
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $job = Job::with('comments.user')->findOrFail($id);
        return view('jobs.jobdetails', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Future implementation or remove if not used.
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Future implementation or remove if not used.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Future implementation or remove if not used.
    }
}

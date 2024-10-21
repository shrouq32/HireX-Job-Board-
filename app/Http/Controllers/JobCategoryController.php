<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\User;

class JobCategoryController extends Controller
{
    public function index()
    {
          // Assuming you want to check for a user with a specific ID
    $userId = auth()->id(); // Get the authenticated user ID

    // Check if the user ID exists
    if (!$userId || !User::find($userId)) {
        abort(404); // Redirect to 404 if user ID is not found
    }

        $categories = Category::all(); // Retrieve all job categories
        return view('categories.index', compact('categories')); // Return a view with the categories
    }
}



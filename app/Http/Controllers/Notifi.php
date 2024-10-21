<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notifications; 
use Illuminate\Http\Request;

class Notifi extends Controller
{
    public function index()
    {
        $user = Auth::user();

        
        $notifications = Notifications::where('user_id', $user->candidate->id)->
                                      orderBy("created_at", "desc")
                                      ->with('job') 
                                      ->get();
        
        return view('notifications', compact('notifications'));
    }
}
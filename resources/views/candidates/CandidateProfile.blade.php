@extends('layouts.app')

@section('content')
<style>
    /* Profile Card Styling */
    .profile-card {
        background-color: #ffffff; 
        border-radius: 12px; 
        padding: 20px;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1); 
        text-align: center; 
        margin-top: 30px; 
        max-width: 350px; 
        margin-left: auto;
        margin-right: auto;
    }

    /* Profile Image */
    .profile-card img {
        width: 120px;
        height: 120px;
        border-radius: 50%; 
        object-fit: cover;
        margin-bottom: 20px; 
        border: 3px solid #007bff;
    }

    /* Profile Name */
    .profile-card h3 {
        font-size: 1.6rem;
        font-weight: 700;
        color: #333;
        margin: 10px 0; 
    }

    /* Job Title */
    .profile-card p {
        color: #555;
        font-size: 1.1rem;
        margin-bottom: 20px; 
    }

    /* Stats Section */
    .profile-card .stats {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px; 
        padding: 0 10px;
    }

    .profile-card .stats div {
        text-align: center;
        flex: 1;
    }

    .profile-card .stats h5 {
        margin: 0;
        font-size: 1.2rem;
        color: #333;
        font-weight: 600;
    }

    .profile-card .stats p {
        margin: 0;
        color: #666;
        font-size: 1rem;
    }

    /* Button Style */
    .profile-card .btn {
        background-color: #007bff;
        color: white;
        padding: 12px 25px;
        border-radius: 25px; 
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 1px;
        text-align: center;
        display: inline-block;
        margin-top: 15px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .profile-card .btn:hover {
        background-color: #0056b3;
        color: white; 
    }

    /* Connect and Message Buttons */
    .profile-card .btn-connect,
    .profile-card .btn-message {
        display: inline-block;
        font-size: 1rem;
        font-weight: 500;
        color: #007bff;
        background: none;
        border: none;
        cursor: pointer;
        margin-top: 10px;
        transition: color 0.3s ease;
    }

    .profile-card .btn-connect {
        margin-right: 15px;
    }

    .profile-card .btn-connect:hover,
    .profile-card .btn-message:hover {
        color: #fff; 
        text-decoration: none;
    }

    /* Link Styling */
    .profile-card a {
        color: #007bff;
        text-decoration: none;
        font-weight: 600;
    }

    .profile-card a:hover {
        text-decoration: underline;
    }

    /* Profile Details Card */
    .profile-details-card {
        background-color: #f9f9f9; 
        border-radius: 12px; 
        padding: 20px;
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.1);
    }

    .profile-details-card h3 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px; 
    }

    .profile-details-card p {
        color: #666;
        font-size: 1rem;
        line-height: 1.6;
    }

    .profile-details-card h5 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-top: 20px; 
        margin-bottom: 10px; 
    }

    .profile-details-card i {
        color: #007bff; 
        margin-right: 10px; 
    }
</style>

<div class="container mt-2">
    <div class="row">
        <!-- Sidebar: Profile Picture and Basic Info -->
        <div class="col-md-4">
            <div class="card profile-card text-center shadow border-0 rounded-lg">
                <div class="profile-img-wrapper mx-auto mb-3">
                    <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('images/account2.jpeg') }}"
                         alt="{{ $user->name }}"
                         class="rounded-circle img-fluid">
                </div>
                <h3 class="font-weight-bold mb-0">{{ $user->name }}</h3>
                <a href="{{route('edit.candidate', $user->candidate->id)}}" class="btn btn-outline-primary btn-sm mt-3 btn-connect">Edit Profile</a>
                <!-- You can add a message button if needed -->
            </div>
        </div>

        <!-- Main Content: Profile Details -->
        <div class="col-md-8">
            <div class="card profile-details-card p-4 shadow border-0 rounded-lg">
                <div class="profile-header">
                    <h3>My Profile</h3>
                </div>

                <!-- Skills Section -->
                <div class="mb-4">
                    <h5><i class="fas fa-cogs"></i> Skills</h5>
                    <pre>{{$user->candidate->skills}}</pre>
                    </div>

                <!-- Experience Section -->
                <div class="mb-4">
                    <h5><i class="fas fa-briefcase"></i> Experience</h5>
                    <p class="pl-4">{{ $user->candidate->experience ?? 'No experience provided' }}</p>
                </div>

                <!-- Education Section -->
                <div class="mb-4">
                    <h5><i class="fas fa-graduation-cap"></i> Education</h5>
                    <p class="pl-4">{{ $user->candidate->education ?? 'No education details provided' }}</p>
                </div>

                <!-- Contact Info Section -->
                <div class="mb-4">
                    <h5><i class="fas fa-envelope"></i> Contact Info</h5>
                    <p class="pl-4">{{ $user->email ?? 'No contact information provided' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="unit-5 overlay primary-bg" style="background-image: url('external/images/hero_2.jpg'); padding: 100px 0; background-size: cover; color: #fff;">
    <div class="container text-center">
        <h1 class="mb-3" style="font-size: 2.5rem;">Profile</h1>
    </div>
</div>

<!-- Profile Section -->
<div class="container py-5">
    <div class="row">
        <!-- Profile Update Form -->
        <div class="col-md-8">
            <div class="card shadow-sm light-bg">
                <div class="card-header primary-bg text-white">
                    Update Your Profile
                </div>
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="address" class="form-label dark-text">Address</label>
                            <input type="text" class="form-control" name="address" value="{{ old('address', 'User Address') }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label dark-text">Phone Number</label>
                            <input type="text" class="form-control" name="phone" value="{{ old('phone', 'User Phone') }}">
                        </div>
                        <div class="mb-3">
                            <label for="experience" class="form-label dark-text">Experience</label>
                            <input type="text" class="form-control" name="experience" value="{{ old('experience', 'User Experience') }}">
                        </div>
                        <div class="mb-3">
                            <label for="bio" class="form-label dark-text">Bio</label>
                            <textarea name="bio" class="form-control" rows="4">{{ old('bio', 'User Bio') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" style="background-color: #5289b5; border-color: #5289b5;">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar: Avatar and Info -->
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm light-bg">
                <div class="card-header primary-bg text-white">
                    Avatar
                </div>
                <div class="card-body text-center">
                    <img src="{{asset('images/board.jpg')}}" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;" alt="User Avatar">
                    <input type="file" class="form-control mb-3" name="avatar">
                    <button class="btn btn-secondary w-100" style="background-color: #1f3541; border-color: #1f3541;">Update Avatar</button>
                </div>
            </div>
            <div class="card shadow-sm light-bg">
                <div class="card-header primary-bg text-white">
                    Your Info
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item light-bg dark-text">Name: <strong>User Name</strong></li>
                        <li class="list-group-item light-bg dark-text">Email: <strong>user@example.com</strong></li>
                        <li class="list-group-item light-bg dark-text">Phone Number: <strong>User Phone</strong></li>
                        <li class="list-group-item light-bg dark-text">Address: <strong>User Address</strong></li>
                        <li class="list-group-item light-bg dark-text">Experience: <strong>User Experience</strong></li>
                        <li class="list-group-item light-bg dark-text">Bio: <strong>User Bio</strong></li>
                        <li class="list-group-item light-bg dark-text">Member Since: <strong>Member Date</strong></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

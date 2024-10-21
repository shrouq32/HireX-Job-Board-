@extends('layouts.app')

@section('content')
<div class="site-section py-5">
    <div class="container" style="max-width: 800px; margin: 0 auto;">

        <!-- Display success and error messages -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <!-- Job Details Card -->
        <div class="card mb-4 shadow-sm border-light">
            <div class="card-body">
                <h2 class="card-title text-primary">{{ $job->title }}</h2>
                
                <div class="d-block d-md-flex align-items-center  mb-4" style="justify-content:space-between">
                    <div class="company-logo text-center text-md-left pl-3">
                        <img src="{{ $job->logo ? asset('storage/' . $job->logo) : asset('images/placeholder.jpeg') }}"
                            alt="Company Logo" class="img-fluid rounded-circle"
                            style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                    <div class="p-4 flex-grow-1 " style="width:50px!important;">

                        <h4 class="text-dark">{{ $job->employer->company_name }}</h4>
                        <p class="text-muted">{{ $job->employer->company_description }}</p>
                        <p><span class="fas fa-phone mr-1"></span> {{ $job->employer->phone }}</p>
                        <div class="d-block d-lg-flex text-muted">
                            <div class="mr-3"><span class="fas fa-briefcase mr-1"></span> {{ $job->jobType->name }}</div>
                            <div class="mr-3"><span class="fas fa-map-marker-alt mr-1"></span> {{ $job->location }}</div>
                            <div><span class="fas fa-dollar-sign mr-1"></span> ${{ $job->salary }}</div>
                        </div>
                    </div>
                </div>
                
                <h4 class="mt-4">Description:</h4>
                <p>{{ $job->description }}</p>
                
                <h4>Category:</h4>
                <p>{{ $job->category ? $job->category->name : 'No Category' }}</p>

                <h4>Requirements:</h4>
                <ul>
                    @foreach(explode("\n", $job->requirements) as $requirement)
                    <li>{{ $requirement }}</li>
                    @endforeach
                </ul>
                
                <h4>Responsibilities:</h4>
                <ul>
                    @foreach(explode("\n", $job->responsibilities) as $responsibility)
                    <li>{{ $responsibility }}</li>
                    @endforeach
                </ul>
                
                <h4>Benefits:</h4>
                <p>{{ $job->benefits }}</p>
                
                <h4>Application Deadline:</h4>
                <p>{{ $job->deadline }}</p>

                <h4>Comments:</h4>
                @forelse($job->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $comment->user->name }}</h5>
                        <p class="card-text">{{ $comment->comment }}</p>
                        <p class="card-text"><small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
                @empty
                <p>No comments yet. Be the first to comment!</p>
                @endforelse

                @auth
                <form action="{{ route('comments.store', $job->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="comment">Add a comment:</label>
                        <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3" required>{{ old('comment') }}</textarea>
                        @error('comment')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
                @else
                <p><a href="{{ route('login') }}">Log in</a> to post a comment.</p>
                @endauth
            </div>
        </div>

    </div>
</div>
@endsection
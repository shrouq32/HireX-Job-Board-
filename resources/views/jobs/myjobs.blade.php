@extends('layouts.app')

@section('content')

<div class="site-section">
    <div class="container">
        <div class="myjob-listings">
            @foreach($jobs as $job)
                <div class="myjob-item"> 
                    <div class="mycard-body">
                        <h2 class="mycard-title h4">
                            <a href="{{ route('jobs.show', $job->id) }}" class="text-dark">{{ $job->title }}</a>
                        </h2>
                        <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                        <p class="card-text"><strong>Posted:</strong> {{ $job->created_at->diffForHumans() }}</p>
                        <p class="card-text"><strong>Last Date to Apply:</strong> {{ $job->deadline }}</p>
                      
                        <p class="card-text"><strong>Employment Type:</strong> {{ $job->jobType->name }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">View Job</a>
                        <a href="{{ route('jobs.edit', $job->id) }}" class="btn  btn-primary">Edit Job</a>
                        <form action="{{ route('jobs.destroy', $job->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this job?')">Delete</button>
                        </form>
                        <a href="{{ route('job.analytics', $job->id) }}" class="btn btn-primary mt-2">Applications</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>



@endsection

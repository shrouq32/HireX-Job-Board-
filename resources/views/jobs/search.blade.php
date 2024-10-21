@extends('layouts.app')

@section('content')
<div class="site-section py-5">
    <div class="container">
       
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

       
        @if(isset($jobs) && $jobs->isNotEmpty())
            <h2 class="mb-5 h3 text-primary">Filtered Jobs:</h2>
            <div class="row">
                @foreach($jobs as $job)
                    <div class="col-md-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h2 class="card-title h4">
                                    <a href="{{ route('jobs.show', $job->id) }}" class="text-dark">{{ $job->title }}</a>
                                </h2>
                                <p class="card-text"><strong>Location:</strong> {{ $job->location }}</p>
                                <p class="card-text"><strong>Posted:</strong> {{ $job->created_at->diffForHumans() }}</p>
                                <p class="card-text"><strong>Category:</strong> {{ $job->category ? $job->category->name : 'No Category' }}</p>
                                <p class="card-text">{{ Str::limit($job->description, 150, '...') }}</p>
                                <div class="d-block d-md-flex align-items-center mb-4">
                                    <div class="company-logo text-center text-md-left pr-3">
                                        <img src="{{ $job->company_logo ? asset('storage/' . $job->company_logo) : 'https://via.placeholder.com/100' }}"
                                             alt="Company Logo" class="img-fluid rounded-circle"
                                             style="width: 80px; height: 80px; object-fit: cover;">
                                    </div>
                                    <div class="p-4">
                                        <p><span class="fas fa-dollar-sign mr-1"></span> ${{ $job->salary }}</p>
                                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="alert alert-info">No jobs found.</p>
        @endif
    </div>
</div>
@endsection

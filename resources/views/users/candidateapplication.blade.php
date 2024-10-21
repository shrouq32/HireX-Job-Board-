@extends('layouts.app')

@section('content')
<div class="site-section py-5">
    <div class="container" style="max-width: 950px; margin: 0 auto;">

        <!-- Display error and success messages -->
        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <form action="{{ route('jobs.index') }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control search-input"
                            placeholder="Search for jobs..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recent Jobs -->
        <div class="row">
            <div class="col-md-12 mb-5">
                <h2 class="mb-5 h3 text-primary text-center">Recent Jobs</h2>
                <div class="rounded border jobs-wrap">
                    @forelse($jobs as $job)
                    @php
                    $isDeadlinePassed = \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($job->deadline));
                    $applied = false;
                    $application = null;

                    if (auth()->check() && auth()->user()->candidate) {
                    $applied = \App\Models\Application::where('candidate_id', auth()->user()->candidate->id)
                    ->where('job_id', $job->id)
                    ->exists();

                    if ($applied) {
                    $application = \App\Models\Application::where('candidate_id', auth()->user()->candidate->id)
                    ->where('job_id', $job->id)
                    ->first();
                    }
                    }
                    @endphp

                    <div class="job-item d-block d-md-flex align-items-center border-bottom p-4 mb-4"
                        onclick="window.location.href='{{ route('jobs.show', $job->id) }}'"
                        style="cursor: pointer; border-radius: 10px; transition: background-color 0.3s ease;">

                        <div class="company-logo text-center text-md-left pl-3">
                            <img src="{{ $job->company_logo ? asset('storage/' . $job->company_logo) : 'https://via.placeholder.com/50' }}"
                                alt="Company Logo" class="img-fluid rounded-circle"
                                style="width: 70px; height: 70px; object-fit: cover; box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1);">
                        </div>

                        <!-- Job Details -->
                        <div class="job-details h-100 p-3 flex-grow-1">
                            <h3 class="text-dark">{{ $job->title }}</h3>
                            <div class="d-block d-lg-flex mt-2 text-muted">
                                <div class="mr-3"><i class="fas fa-briefcase mr-1"></i> {{ $job->jobType->name }}</div>
                                <div class="mr-3" style="display: {{ $job->location ? 'block' : 'none' }};">
                                    <i class="fas fa-map-marker-alt mr-1"></i> {{ $job->location ?? 'Location not
                                    available' }}
                                </div>
                                <div class="mr-3"><i class="fas fa-dollar-sign mr-1"></i> ${{ $job->salary }}</div>
                                <div><strong>Total Applications:</strong> {{ $job->applications_count }}</div>
                            </div>
                        </div>

                        <!-- Job Status -->
                        <div class="job-category p-3 text-end">
                            @auth
                            @if(auth()->user()->role == 2)
                            <span class="badge bg-primary">{{ $job->status->name }}</span>
                            @endif
                            @endauth
                        </div>

                        <!-- Apply Button -->
                        @auth
                        @if(auth()->user()->role == 3)
                        <div class="job-apply p-3">
                            @if($isDeadlinePassed)
                            <button class="btn btn-secondary" disabled>Apply Now</button>
                            @else
                            @if($applied)
                            <form action="{{ route('applications.destroy', $application->id) }}" method="POST"
                                style="display: inline;"
                                onsubmit="return confirm('Are you sure you want to cancel your application?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Cancel Application</button>
                            </form>
                            @else
                            <a href="{{ route('applications.create', ['job' => $job->id]) }}"
                                class="btn btn-primary">Apply Now</a>
                            @endif
                            @endif
                        </div>
                        @endif
                        @endauth

                    </div>
                    @empty
                    <p class="text-center">No jobs found matching your search criteria.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center mt-5 pagination">
            {{ $jobs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

@endsection
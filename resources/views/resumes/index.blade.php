@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Resumes</h1>

    <!-- Search Form -->
    <form action="{{ route('resumes.index') }}" method="GET" class="mb-4">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="skills">Skills</label>
                <input type="text" name="skills" id="skills" class="form-control" placeholder="e.g., PHP, Laravel">
            </div>
            <div class="col-md-4 mb-3">
                <label for="experience">Experience</label>
                <input type="text" name="experience" id="experience" class="form-control" placeholder="e.g., 3 years">
            </div>
            <div class="col-md-4 mb-3">
                <label for="education">Education</label>
                <input type="text" name="education" id="education" class="form-control"
                    placeholder="e.g., Bachelor's Degree">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    @if ($candidates->isEmpty())
    <p>No resumes found matching your criteria.</p>
    @else
    <div class="row">
        @foreach ($candidates as $candidate)
        <div class="col-md-4 mb-4">
            <a href="{{ route('resumes.show', $candidate->id) }}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Candidate Name: {{ $candidate->user->name }}</h5>
                        <p class="card-text"><strong>Skills:</strong> {{ $candidate->skills }}</p>
                        <p class="card-text"><strong>Experience:</strong> {{ $candidate->experience }}</p>
                        <p class="card-text"><strong>Education:</strong> {{ $candidate->education }}</p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

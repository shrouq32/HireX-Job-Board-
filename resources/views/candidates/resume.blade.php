@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resume for Candidate: {{ $candidate->user->name }}</h1>

    @if($candidate)
        <p><strong>Skills:</strong> {{ $candidate->skills }}</p>
        <p><strong>Experience:</strong> {{ $candidate->experience }}</p>
        <p><strong>Education:</strong> {{ $candidate->education }}</p>

        <!-- Assuming the candidate is a downloadable file -->
        @if ($candidate->resume)
            <h3>Resume Document</h3>
            <iframe src="{{ asset('storage/' . $candidate->resume) }}" width="100%" height="600px"></iframe>
        @else
            <p>No resume document available.</p>
        @endif
    @else
        <p>No resume available for this candidate.</p>
    @endif
</div>
@endsection

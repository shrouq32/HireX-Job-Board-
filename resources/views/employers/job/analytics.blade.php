@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container analytics-container">
    <h1 class="analytics-heading">Analytics for Job: {{ $job->title }}</h1>
    <p class="analytics-application-count"><strong>Total Applications:</strong> {{ $applicationCount }}</p>

    <h3 class="analytics-subheading">Applications:</h3>
    <ul class="analytics-application-list">
    @foreach($job->applications as $application)
        <li class="analytics-application-item">
            <div class="analytics-item-info">
                <strong>Candidate:</strong> {{ $application->candidate->user->name ?? 'Unknown' }} -
                <strong>Applied On:</strong> {{ $application->created_at->format('d M Y') }}
                <br>
                <strong>Status:</strong> {{ $application->status_id == 1 ? 'Pending' : ($application->status_id == 2 ? 'Rejected' : 'Accepted') }}
            </div>
            <div class="analytics-item-buttons">
                <a href="{{ route('applications.resume', $application->id) }}" class="btn analytics-btn-resume">View Resume</a>
                
                @if($application->status_id == 1)
                <!-- Accept Button -->
                <button type="button" class="btn analytics-btn-accept" onclick="confirmAccept('{{ $application->id }}')">Accept</button>
                
                <!-- Reject Button -->
                <button type="button" class="btn analytics-btn-reject" onclick="confirmReject('{{ $application->id }}')">Reject</button>
                @endif
            </div>
        </li>
    @endforeach
    </ul>
</div>

<script>
    function confirmAccept(applicationId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to accept this application.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, accept it!',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(`#accept-form-${applicationId}`).submit();
            }
        });
    }

    function confirmReject(applicationId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to reject this application.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, reject it!',
            cancelButtonText: 'No, cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(`#reject-form-${applicationId}`).submit();
            }
        });
    }
</script>

<!-- Accept Form -->
@foreach($job->applications as $application)
    @if($application->status_id == 1)
    <form id="accept-form-{{ $application->id }}" action="{{ route('applications.update', $application->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="3">
    </form>
    @endif
@endforeach

<!-- Reject Form -->
@foreach($job->applications as $application)
    @if($application->status_id == 1)
    <form id="reject-form-{{ $application->id }}" action="{{ route('applications.reject', $application->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="2">
    </form>
    @endif
@endforeach

@endsection

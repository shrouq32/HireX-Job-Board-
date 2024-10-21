
@extends('layouts.app')

@section('title', 'Jobs in Category')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5">Jobs in {{ $category->name }}</h1>
        <div class="row g-4">
            @forelse($jobs as $job)
            <div class="col-lg-4 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $job->title }}</h5>
                        <p class="card-text">{{ $job->description }}</p>
                        <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center">No jobs available in this category.</p>
            </div>
            @endforelse
        </div>
      
    </div>
</div>
@endsection

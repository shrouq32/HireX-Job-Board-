@extends('layouts.app')

@section('content')
<div class="site-section py-5">

    <div class="container">
        <h2 class="mb-4">Apply for {{ $jobs->title }}</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('applications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="job_id" value="{{ $jobs->id }}">
            <div class="form-group">
                <label for="resume">Upload Resume</label>
                <input type="file" name="resume" id="resume" class="form-control">
                @error('resume')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>


    </div>
</div>
@endsection
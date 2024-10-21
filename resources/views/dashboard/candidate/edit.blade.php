@extends('layouts.app')
@section('title', 'Update Candidate Profile')
@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <div class="card">
                <div class="card-header" style="background-color: #5289b5; color: white;">Become a Candidate</div>
<div class="card-body">
    <form action="{{route('candidateUpdate', $candidate->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('patch')


        <div class="mb-3 form-group">
            <label class="form-label" for="skills">Skills</label>
            <br>
            <textarea name="skills" id="skills" cols="107" rows="5">{{$candidate->skills}}</textarea>
            @error('skills')
                <small class="text-danger">{{ $message }}</small>
                @enderror
        </div>
        <div class="form-group">
            <label for="edu"> Education</label>
            <input  class="form-control" type="text" name="education" id="edu" value="{{$candidate->education}}">
        </div>

        <div class="form-group">
            <label for="exp"> Experience</label>
            <input class="form-control" type="text" name="experience" id="exp" value="{{$candidate->experience}}">
        </div>
            <div class="form-group">
                <label for="resume">Upload Resume</label>
                <input  class="form-control" type="file" name="resume" id="resume" class="form-control">
                @error('resume')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        </div>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection
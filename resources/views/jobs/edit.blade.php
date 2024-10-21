@extends('layouts.app')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="py-4"></div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- This will generate a PUT request -->
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #5289b5;">
                            <h3>Edit Job: {{ $job->title }}</h3>
                        </div>

                        <div class="card-body">
                            <!-- Title Field -->
                            <div class="form-group">
                                <label for="title" class="text-primary">Title:</label>
                                <input type="text" name="title" id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    value="{{ old('title', $job->title) }}">
                                @error('title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="form-group">
                                <label for="description" class="text-primary">Description:</label>
                                <textarea name="description" id="description"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $job->description) }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Requirements Field -->
                            <div class="form-group">
                                <label for="requirements" class="text-primary">Requirements:</label>
                                <textarea name="requirements" id="requirements"
                                    class="form-control @error('requirements') is-invalid @enderror">{{ old('requirements', $job->requirements) }}</textarea>
                                @error('requirements')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Location Field -->
                            <div class="form-group">
                                <label for="location" class="text-primary">Location:</label>
                                <input type="text" name="location" id="location"
                                    class="form-control @error('location') is-invalid @enderror"
                                    value="{{ old('location', $job->location) }}">
                                @error('location')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Category Field -->
                            <div class="form-group">
                                <label for="category_id" class="text-primary">Job Category:</label>
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (old('category_id', $job->category_id) ==
                                        $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            

                            <!-- Job Type Field -->
                            <div class="form-group">
                                <label for="job_type" class="text-primary">Job Type:</label>
                                <select name="job_type" id="job_type"
                                    class="form-control @error('job_type') is-invalid @enderror">
                                    <option value="">Select Job Type</option>
                                    @foreach ($jobTypes as $type)
                                    <option value="{{ $type->id }}" {{ (old('job_type', $job->job_type) == $type->id) ?
                                        'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('job_type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Responsibilities Field -->
                            <div class="form-group">
                                <label for="responsibilities" class="text-primary">Responsibilities:</label>
                                <textarea name="responsibilities" id="responsibilities"
                                    class="form-control @error('responsibilities') is-invalid @enderror">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                                @error('responsibilities')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Salary Field -->
                            <div class="form-group">
                                <label for="salary" class="text-primary">Salary:</label>
                                <input type="number" name="salary" id="salary"
                                    class="form-control @error('salary') is-invalid @enderror"
                                    value="{{ old('salary', $job->salary) }}">
                                @error('salary')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Benefits Field -->
                            <div class="form-group">
                                <label for="benefits" class="text-primary">Benefits:</label>
                                <textarea name="benefits" id="benefits"
                                    class="form-control @error('benefits') is-invalid @enderror">{{ old('benefits', $job->benefits) }}</textarea>
                                @error('benefits')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Deadline Field -->
                            <div class="form-group">
                                <label for="deadline" class="text-primary">Deadline:</label>
                                <input type="date" name="deadline" id="deadline"
                                    class="form-control @error('deadline') is-invalid @enderror"
                                    value="{{ old('deadline', $job->deadline) }}">
                                @error('deadline')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Logo Field (if applicable) -->
                            <div class="form-group">
                                <label for="logo" class="text-primary">Logo (URL):</label>
                                <input type="text" name="logo" id="logo"
                                    class="form-control @error('logo') is-invalid @enderror"
                                    value="{{ old('logo', $job->logo) }}">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Update Button -->
                            <div class="form-group mt-3">
                                <button class="btn btn-dark" type="submit"
                                    style="background-color: #5289b5; border-color: #5289b5;">Update Job</button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="py-4"></div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Form action points to 'jobs.store' route -->
                <form action="{{ route('jobs.store') }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header text-white" style="background-color: #5289b5;">
                            <h3>Create a New Job</h3>
                        </div>

                        <div class="card-body">
                           

                            <!-- Job Title -->
                            <div class="form-group">
                                <label for="title" class="text-primary">Title:</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Job Description -->
                            <div class="form-group mt-3">
                                <label for="description" class="text-primary">Description:</label>
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" style="height: 120px">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="col-form-label" style="color: var(--dark);">Company`s Logo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}" autofocus>
                                </div>
                                @error('logo')
                                <span class="invalid" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Job Requirements -->
                            <div class="form-group mt-3">
                                <label for="requirements" class="text-primary">Requirements:</label>
                                <textarea name="requirements" id="requirements" class="form-control @error('requirements') is-invalid @enderror" style="height: 120px">{{ old('requirements') }}</textarea>
                                @error('requirements')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Job Location -->
                            <div class="form-group mt-3">
                                <label for="location" class="text-primary">Location:</label>
                                <input type="text" name="location" id="location" class="form-control @error('location') is-invalid @enderror" value="{{ old('location') }}">
                                @error('location')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Dynamic Job Category Dropdown -->
                            <div class="form-group mt-3">
                                <label for="category_id" class="text-primary">Category:</label>
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                           
                            <!-- Job Type -->
                            <div class="form-group mt-3">
                                <label for="job_type" class="text-primary">Job Type:</label>
                                <select name="job_type" id="job_type" class="form-control @error('job_type') is-invalid @enderror">
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ old('job_type') == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('job_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Job Responsibilities -->
                            <div class="form-group mt-3">
                                <label for="responsibilities" class="text-primary">Responsibilities:</label>
                                <textarea name="responsibilities" id="responsibilities" class="form-control @error('responsibilities') is-invalid @enderror" style="height: 120px">{{ old('responsibilities') }}</textarea>
                                @error('responsibilities')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Salary -->
                            <div class="form-group mt-3">
                                <label for="salary" class="text-primary">Salary:</label>
                                <input type="number" name="salary" id="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary') }}" step="0.01">
                                @error('salary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Job Benefits -->
                            <div class="form-group mt-3">
                                <label for="benefits" class="text-primary">Benefits:</label>
                                <textarea name="benefits" id="benefits" class="form-control @error('benefits') is-invalid @enderror" style="height: 120px">{{ old('benefits') }}</textarea>
                                @error('benefits')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Application Deadline -->
                            <div class="form-group mt-3">
    <label for="deadline" class="text-primary">Application Deadline:</label>
    <input type="date" name="deadline" id="deadline" class="form-control @error('deadline') is-invalid @enderror" value="{{ old('deadline') }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
    @error('deadline')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                            <!-- Post Job Button -->
                            <div class="form-group mt-3">
                                <button class="btn btn-dark" type="submit" style="background-color: #5289b5; border-color: #5289b5;">Post Job</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

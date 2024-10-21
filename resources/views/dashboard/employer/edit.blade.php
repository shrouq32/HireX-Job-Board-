@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="background-color: #5289b5; color: white;">Edit Your Profile</div>

                <div class="card-body" >


                <form action="{{ route('employerUpdate', $employer->id) }}" method="post">
                        @csrf
                        @method('patch')

                        <div class="form-group mb-3">
                            <label for="company_name">Company Name</label>
                            <input type="text" class="form-control " id="company_name" name="company_name" value="{{ $employer->company_name }}" >
                            @error('company_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="company_description">Company Description</label>
                            <textarea class="form-control" id="company_description" name="company_description">{{ $employer->company_description }}</textarea>
                            @error('company_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="company_website">Company Website</label>
                            <input type="url" class="form-control " id="company_website" name="company_website" value="{{ $employer->company_website }}">
                          
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control " id="phone" name="phone" value="{{ $employer->phone }}" >
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn" style="background-color: #5289b5; color: white; ">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
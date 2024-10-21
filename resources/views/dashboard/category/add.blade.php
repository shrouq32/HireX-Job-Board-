@extends('dashboard.layouts.app')
@section('content')
<div class="site-section" style="margin-top: 30px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form method="POST" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header " style="margin-bottom: 30px;">
                            <h3 class="text-color text-center ">Add New Category</h3>
                        </div>

                        <div class="card-body">

                            <div class="form-group mt-3">
                                <label for="name" class="text-primary">Define the name of the category please:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <div class="text-danger mt-1">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>

                            <button type="submit" class="btn bg-color">Save </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
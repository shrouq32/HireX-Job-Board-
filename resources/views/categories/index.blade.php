@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mt-4 mb-5">Job Categories</h1>
    <div class="row">
        @foreach($categories as $category)
            <div class="col-md-4 mb-4"  >
                <div class="category-card"  >
                    <a
                     href="{{ route('jobs.jobbycategory', ['categoryId' => $category->id]) }}">
                  
                    <div class="category-icon">
                        <!-- You can use FontAwesome or any icon library for icons -->
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="category-details">
                        <h3>{{ $category->name }}</h3>
                        
                    </div>
                </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection

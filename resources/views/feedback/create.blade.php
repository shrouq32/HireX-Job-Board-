@extends('layouts.app')

@section('content')
    <section class="text-center mt-5">
        <div class="container">
            <h2 class="mb-4">We Value Your Feedback</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <!-- Ensure the action URL points to a named route for feedback submission -->
                    <form action="{{ route('feedback.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <!-- Display the logged-in user's name in the input field -->
                            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="feedback">Feedback</label>
                            <textarea class="form-control @error('feedback') is-invalid @enderror" id="feedback" name="feedback" rows="5" required>{{ old('feedback') }}</textarea>
                            @error('feedback')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

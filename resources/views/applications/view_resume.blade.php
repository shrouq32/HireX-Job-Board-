
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>View Resume</h1>
    <iframe src="{{ asset('storage/' . $resumePath) }}" style="width: 100%; height: 800px;" frameborder="0"></iframe>
   </div>
@endsection


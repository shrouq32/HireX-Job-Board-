@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Enhance Your Recruitment with Our Premium Packages</h2>
    <div class="row">
        <!-- Package 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 500px; width: 400px;">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Basic Employer Package</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title pricing-card-title">$49.99 <small class="text-muted">/ month</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Post up to 5 jobs per month</li>
                            <li>Use Resume Filter</li>
                            <li>Basic support</li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-outline-primary btn-block mt-auto">Choose Plan</a>
                </div>
            </div>
        </div>

        <!-- Package 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 500px; width: 400px;">
                <div class="card-header text-center bg-success text-white">
                    <h4>Standard Employer Package</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title pricing-card-title">$99.99 <small class="text-muted">/ month</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Post up to 15 jobs per month</li>
                            <li>Use Enhanced Resume Filter</li>
                            <li>Priority support</li>
                        </ul>
                    </div>
                    <a href="#" class="btn bg-success btn-block mt-auto">Choose Plan</a>
                </div>
            </div>
        </div>

        <!-- Package 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 500px; width: 400px;">
                <div class="card-header text-center bg-danger text-white">
                    <h4>Premium Employer Package</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title pricing-card-title">$199.99 <small class="text-muted">/ month</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Post unlimited jobs</li>
                            <li>Use Enhanced Resume Filter</li>
                            <li>priority for the your jobs to be more viewed</li>
                            <li>Dedicated 24/7 support</li>
                        </ul>
                    </div>
                    <a href="#" class="btn bg-danger btn-block mt-auto">Choose Plan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

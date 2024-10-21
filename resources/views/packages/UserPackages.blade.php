@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Promote your career using Premium Packages</h2>
    <div class="row">
        <!-- Package 1 -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 500px;  width: 400px">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Basic Package</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title pricing-card-title">$19.99 <small class="text-muted">/ month</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Access to all listed jobs</li>
                            <li>Apply to 10 jobs per month</li>
                            <li>Basic support</li>
                        </ul>
                    </div>
                    <a href="#" class="btn btn-outline-primary btn-block mt-auto">Choose Plan</a>
                </div>
            </div>
        </div>

        <!-- Package 2 -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 500px; width: 400px ">
                <div class="card-header text-center bg-success text-white">
                    <h4>Standard Package</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title pricing-card-title">$39.99 <small class="text-muted">/ month</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                        <li>Access to all listed jobs</li>
                        <li>Apply to 30 jobs per month</li>
                        <li>Priority support</li>
                        </ul>
                    </div>
                    <a href="#" class="btn bg-success btn-block mt-auto">Choose Plan</a>
                </div>
            </div>
        </div>

        <!-- Package 3 -->
        <div class="col-md-4">
            <div class="card shadow-sm" style="height: 500px; width: 400px">
                <div class="card-header text-center bg-danger text-white">
                    <h4>Premium Package</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-between text-center">
                    <div>
                        <h3 class="card-title pricing-card-title">$59.99 <small class="text-muted">/ month</small></h3>
                        <ul class="list-unstyled mt-3 mb-4">
                        <li>Access to all listed jobs</li>
                        <li>Unlimited apply to jobs per mont</li>
                        <li>Dedicated support 24/7</li>
                        </ul>
                    </div>
                    <a href="#" class="btn bg-danger btn-block mt-auto">Choose Plan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

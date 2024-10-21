@extends('dashboard.layouts.app')

@section('content')

<div class="analytics-sparkle-area" style="margin-top: 45px;">
    <div class="container-fluid">
        <!-- Cards Section -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4 justify-content-center"> 
            <!-- Employers Card -->
            <a href="{{ route('employer') }}" class="card-link" style="text-decoration:none;">
                <div class="card text-bg-primary mb-3" style="max-width: 100%; height:15rem; font-size:large;">
                    <div class="card-header"><i class="fa-solid fa-users"></i></div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 22px;">Employers</h5>
                        <p class="card-text">Total Employers: <b>{{ $employersCount }}</b></p>
                        <span style="font-size:12px;">Click For More Info</span>
                    </div>
                </div>
            </a>

            <!-- Candidates Card -->
            <a href="{{ route('candidate') }}" class="card-link" style="text-decoration:none;">
                <div class="card text-bg-warning mb-3" style="max-width: 100%; height:15rem; font-size:large;">
                    <div class="card-header"><i class="fa-solid fa-user"></i></div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 22px;">Candidates</h5>
                        <p class="card-text">Total Candidates: <b>{{ $candidatesCount }}</b></p>
                        <span style="font-size:12px;">Click For More Info</span>
                    </div>
                </div>
            </a>

            <!-- Categories Card -->
            <a href="{{ route('category') }}" class="card-link" style="text-decoration:none;">
                <div class="card text-bg-success mb-3" style="max-width: 100%; height:15rem; font-size:large;">
                    <div class="card-header"><i class="fa-solid fa-list"></i></div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 22px;">Categories</h5>
                        <p class="card-text">Total Categories: <b>{{ $categoriesCount }}</b></p>
                        <span style="font-size:12px;">Click For More Info</span>
                    </div>  
                </div>
            </a>

            <!-- Jobs Card -->
            <a href="{{ route('jobs') }}" class="card-link" style="text-decoration:none;">
                <div class="card text-bg-danger mb-3" style="max-width: 100%; height:15rem; font-size:large;">
                    <div class="card-header"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 22px;">Jobs</h5>
                        <p class="card-text">Total Jobs: <b>{{ $jobsCount }}</b></p>
                        <span style="font-size:12px;">Click For More Info</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="container">
            <h2  class="mt-5 text-center">Charts </h2>
        <!-- Charts Section -->
        <div class="row g-4 mt-5"> <!-- g-4 adds a small gap between charts -->
            <!-- Employers Chart -->
            <div class="col-md-6 my-3 bg-dark">
                <h3 class="text-white">Employers </h3>
                <canvas id="employersChart"></canvas>
            </div>

            <!-- Candidates Chart -->
            <div class="col-md-6 my-3 bg-success">
                <h3 class="text-white">Candidates </h3>
                <canvas id="candidatesChart"></canvas>
            </div>
        </div>

        <!-- Jobs Chart (Centered) -->
        <div class="row justify-content-center mt-4"> <!-- Centering the third chart -->
            <div class="col-md-6 my-3 bg-danger">
                <h3 class="text-white">Jobs </h3>
                <canvas id="jobsChart"></canvas>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script id="chartData" type="application/json">
    {
        "employers": {
            "dates": @json($employerDates),
            "counts": @json($employersData)
        },
        "candidates": {
            "dates": @json($candidateDates),
            "counts": @json($candidatesData)
        },
        "jobs": {
            "dates": @json($jobDates),
            "counts": @json($jobsData)
        }
    }
</script>
<script>
    // Parse chart data from script tag
    const chartData = JSON.parse(document.getElementById('chartData').textContent);

    // Common chart options with white text
    const commonOptions = {
        responsive: true,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Dates',
                    color: '#ffffff'  // White text for x-axis
                },
                ticks: {
                    color: '#ffffff'  // White text for ticks
                }
            },
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Count',
                    color: '#ffffff'  // White text for y-axis
                },
                ticks: {
                    color: '#ffffff'  // White text for ticks
                }
            }
        },
        plugins: {
            legend: {
                labels: {
                    color: '#ffffff'  // White text for legend
                }
            }
        }
    };

    // Employers Chart
    const employersCtx = document.getElementById('employersChart').getContext('2d');
    const employersChart = new Chart(employersCtx, {
        type: 'line',
        data: {
            labels: chartData.employers.dates,  // Dates for x-axis (specific to employers)
            datasets: [{
                label: 'Employers',
                data: chartData.employers.counts,  // Number of employers per date
                backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Chart fill color
                borderColor: 'rgba(75, 192, 192, 1)',  // Chart line color
                borderWidth: 1
            }]
        },
        options: commonOptions
    });

    // Candidates Chart
    const candidatesCtx = document.getElementById('candidatesChart').getContext('2d');
    const candidatesChart = new Chart(candidatesCtx, {
        type: 'line',
        data: {
            labels: chartData.candidates.dates,  // Dates for x-axis (specific to candidates)
            datasets: [{
                label: 'Candidates',
                data: chartData.candidates.counts,  // Number of candidates per date
                backgroundColor: 'rgba(54, 162, 235, 0.2)',  // Chart fill color
                borderColor: 'rgba(54, 162, 235, 1)',  // Chart line color
                borderWidth: 1
            }]
        },
        options: commonOptions
    });

    // Jobs Chart
    const jobsCtx = document.getElementById('jobsChart').getContext('2d');
    const jobsChart = new Chart(jobsCtx, {
        type: 'line',
        data: {
            labels: chartData.jobs.dates,  // Dates for x-axis (specific to jobs)
            datasets: [{
                label: 'Jobs',
                data: chartData.jobs.counts,  // Number of jobs per date
                backgroundColor: 'rgba(255, 206, 86, 0.2)',  // Chart fill color
                borderColor: 'rgba(255, 206, 86, 1)',  // Chart line color
                borderWidth: 1
            }]
        },
        options: commonOptions
    });
</script>
@endsection
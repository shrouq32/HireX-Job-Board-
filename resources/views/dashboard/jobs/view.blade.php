@extends('dashboard.layouts.app')
@section('content')
<div class="container mt-5" style="margin-top: 50px;">

    <div class="card mb-3">
        <div class="card-header">
            <h2 class="mb-0">{{$job->title}}</h2>
        </div>
        <div class="card-body">
            <p class="card-text">{{$job->description}}</p>

            <h5 class="mt-4">Comments:</h5>
            <ul class="list-group">
                @foreach($comments as $comment)
                @php
                $user = $comment->user;
                @endphp
                <li class="list-group-item" style="margin-bottom: 10px;">
                    {{$comment->comment}}
                    <span class="badge badge-secondary float-right">by {{$user->name}}</span>
                    <button class="badge btn bg-delete " data-toggle="modal" data-target="#commentDelete-{{$comment->id}}" type="button"><i class="material-icons">Delete</i></button>

                    <!-- Delete modal -->
                    <div class="modal fade" id="commentDelete-{{$comment->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center" id="staticBackdropLabel-{{$comment->id}}">Name: {{$user->name}} </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <h4> Do you want to Delete This Comment ?</h4>
                                </div>
                                <form action="{{route('comment.delete', ['job_id' => $job->id, 'id' => $comment->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <hr>

    <h3>Applications</h3>
    @if($applications && $applications-> isNotEmpty())
    <div class="card-body mt-3">
        <div class="table-responsive">
            <table id="usersTable" class="table table-striped  table-dark" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>

                        <th>Candidate Name</th>
                        <th>status</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $app)
                    @php
                    $can = $app->candidate;
                    $candidate = $can->user;
                    $status = $app->status;
                    @endphp
                    <tr>
                        <td>{{$app->id}}</td>
                        <td>{{$candidate->name}}</td>
                        <td>{{$status->name}}</td>

                    </tr>
                    @endforeach
            </table>
        </div>
    </div>
    @else
    <div class="container ">
        <span class="text-danger">* No Applications Found</span>
    </div>

    @endif

    @if($applications && $applications-> isNotEmpty())

    <h3 class="mt-5">Applications Over Time</h3>
    <div class="row justify-content-center mt-4 ">
        <div class="col-md-10 bg-dark">
            <canvas id="applicationsChart" width="400" height="200"></canvas>
        </div>
    </div>
    @endif


</div>





@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script id="chartData" type="application/json">
    {
        "dates": @json($applicationDates),
        "counts": @json($applicationCounts)
    }
</script>
<script>
    var chartData = JSON.parse(document.getElementById('chartData').textContent);

    var ctx = document.getElementById('applicationsChart').getContext('2d');
    var applicationsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.dates,  // Dates for x-axis
            datasets: [{
                label: 'Applications',
                data: chartData.counts,  // Number of applications per date
                backgroundColor: 'rgba(75, 192, 192, 0.2)',  // Chart fill color
                borderColor: 'rgba(75, 192, 192, 1)',  // Chart line color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: {
                        color: 'white'  // Legend text color
                    }
                },
                tooltip: {
                    callbacks: {
                        title: function(tooltipItems) {
                            return tooltipItems[0].label;
                        },
                        label: function(tooltipItem) {
                            return tooltipItem.dataset.label + ': ' + tooltipItem.formattedValue;
                        }
                    },
                    titleColor: 'white',  // Tooltip title color
                    bodyColor: 'white',   // Tooltip body color
                    footerColor: 'white'  // Tooltip footer color
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: 'white'  // X-axis text color
                    },
                    title: {
                        color: 'white'  // X-axis title color
                    }
                },
                y: {
                    ticks: {
                        color: 'white'  // Y-axis text color
                    },
                    title: {
                        color: 'white'  // Y-axis title color
                    }
                }
            }
        }
    });
</script>
@endsection
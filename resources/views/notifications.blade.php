<!-- resources/views/notifications/index.blade.php -->
@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mt-5 text-center">Your Notifications</h2>

    @if($notifications->isEmpty())
        <p class="mt-5 text-center " style="font-size: large; font-weight:bold;">* No notifications found.</p>
    @else
    <div class="row justify-content-center mt-5">
        @foreach($notifications as $notification)
        <div class="col-sm-8 mb-3">
            <div class="card">
                <div  @if($notification->status_id == 3) class="card-body notifi-accept" @else class="card-body notifi-reject"
                    @endif>
                @if($notification->status_id == 3)
                    <h5 class="card-title "><strong>{{ $notification->job->title }}</strong></h5>
                    @else
                    <h5 class="card-title "><strong>{{ $notification->job->title }}</strong></h5>

                    @endif
                    @if($notification->status_id == 3)
                    <p class="card-text">
                        Congratulations! We are pleased to inform you that your application for the {{$notification->job->title}} position at {{$notification->job->employer->company_name}} has been accepted.
                    </p>
                    @else
                    <p class="card-text">
                        Thank you for your interest in the {{$notification->job->title}} position at {{$notification->job->employer->company_name}}. We regret to inform you that your application has been rejected at this time. However, we encourage you to apply for future opportunities.
                    </p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>

@endsection

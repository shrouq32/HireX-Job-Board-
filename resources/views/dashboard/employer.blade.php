@extends('dashboard.layouts.app')
@section('content')

<!-- Search Bar -->
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12" style="margin-top: 65px;">
            <div class="card bg-white">
                <div class="card-body mt-3">
                    <!-- Search Input -->
                    <form action="{{ route('employer') }}" method="GET" class="mb-4">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" style="width: 300px;" placeholder="Search by Employer Name " value="{{ request('search') }}">
                            <button class="btn bg-color" type="submit">Search</button>
                        </div>
                    </form>

                    <!-- Users DataTable-->
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-striped bg-light" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Employer Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employers as $employer)
                                    @php
                                    $user_data = $employer->user;
                                    @endphp
                                    <tr>
                                        <td>{{ $employer->id }}</td>
                                        <td>{{ $user_data->name }}</td>
                                        <td>{{ $user_data->email }}</td>
                                        <td style="width: 18%">
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#candidateDelete-{{$employer->id}}" type="button">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <!-- Delete modal -->
                                            <div class="modal fade" id="candidateDelete-{{$employer->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel-" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title text-center" id="staticBackdropLabel-{{$employer->id}}">Name: {{ $user_data->name }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center">
                                                            <h4>Do you want to move Employer to Trash?</h4>
                                                        </div>
                                                        <form action="{{ route('employer.delete', $employer->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $employers->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

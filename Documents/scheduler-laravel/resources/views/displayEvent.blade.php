@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead">
                <tr class="warning">
                    <th> Id </th>
                    <th> Name </th>
                    <th> Start Date + Time </th>
                    <th> End Date + Time </th>
                    <th> Update/Edit </th>
                    <th> Share </th>
                    <th> Delete </th>
                </tr>
            </thead>
            @foreach($appointments as $app)
            <tbody>
                <tr>
                    <td>{{ $app->id }}</td>
                    <td>{{ $app->title }}</td>
                    <td>{{ $app->start_date }}</td>
                    <td>{{ $app->end_date }}</td>

                    <!-- UPDATE EVENT -->
                    <th>
                    <a href="{{ action('AppointmentController@edit', $app['id']) }}" class="btn btn-success">
                        <i class="glyphicon glyphicon-edit"></i>Edit</a>
                    </th>

                    <!-- SHARE EVENT -->
                    <th>
                    <button class="btn btn-success" data-toggle="modal" data-target="#shareModal">
                        <i class="glyphicon glyphicon-edit"></i>Share
                    </button>

                    <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Share this event</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{ action('AppointmentController@shareEvent', $app['id']) }}">
                            <div class="modal-body">

                                    @csrf
                                    <input type="hidden" name="_method" value="POST"/>
                                    <input type="text" class="form-control" name="user_email" placeholder="Enter User's email" />

                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="submit" class="btn btn-primary" value="Share Event" />
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                    </th>

                    <!-- DELETE EVENT -->
                    <th>
                        <form method="POST" action="{{ action('AppointmentController@destroy', $app['id']) }}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE"/>
                            <button type="submit" class="btn btn-danger">
                                <i class="glyphicon glyphicon-edit"></i>
                                Delete
                            </button>
                        </form>
                    </th>

                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>



@endsection

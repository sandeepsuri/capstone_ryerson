@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <form action="{{ action('AppointmentController@update', $id) }}" method="POST">
            @csrf
            <div class="container">
                <div class="jumbotron">
                @if(count($errors) >0)
                    <br><br>
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }} </li>
                                @endforeach
                        </ul>
                    </div>
                @endif

                @if(\Session::has('success'))
                    <br><br>
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                    <br><br>
                @endif

                    <h1> Update your Event </h1>
                    <hr>
                    <input type="hidden" name="_method" value="UPDATE"/>

                    <div class="form-group">
                        <label>Title of Event</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter New Title" value="{{ $appointments->title }}">
                    </div>

                    <div class="form-group">
                        <label>Start Date and Time</label>
                        <input type="datetime-local" class="form-control" name="start_date" placeholder="Enter New Start Date" value="{{ $appointments->start_date }}">
                    </div>

                    <div class="form-group">
                        <label>End Date and Time</label>
                        <input type="datetime-local" class="form-control" name="end_date" placeholder="Enter New End Date" value="{{ $appointments->end_date }}">
                    </div>
                    {{ method_field('PUT') }}
                    <button type="submit" name="submit" class="btn btn-success">Update Data</button>
                </div>

            </div>

        </form>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-hiding" style="background: #2e6da4; color: white;">
                            <center> Create New Event </center>
                </div>

                <div class="panel-body">
                    <h1> Task: Add Data </h1>
                    <form method="POST" action="{{ action('AppointmentController@store') }}">
                        @csrf
                        <label for="">Enter Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title of Event" /> <br> <br>

                        <label for="">Enter Colour</label>
                            <input type="color" class="form-control" name="colour" placeholder="Enter Colour for the Tile" /> <br> <br>

                        <label for="">Start Date for Event</label>
                            <input type="datetime-local" class="form-control" name="start_date" placeholder="Starting Date" /> <br> <br>

                        <label for="">End Date for Event</label>
                            <input type="datetime-local" class="form-control" name="end_date" placeholder="Ending Date" /> <br> <br>

                        <input type="submit" name="submit" class="btn btn-primary" value="Add Event" />
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>



@endsection

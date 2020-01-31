@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">

                <div class="card-header">Login Successful!</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <center> Welcome back {{ Auth::user()->name }}!
                        <br><br>
                        <a href="/addEvents" class="btn btn-success">Add Event</a>
                        <a href="/displayEvent" class="btn btn-primary">Update Event</a>
                        <a href="/deleteEvent" class="btn btn-danger">Delete Event</a>

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
                        @endif

                        </center>
                    </div>

                </div>
        </div>
    </div>
    <br> <br>

    <div class="jumbotron">
        <!-- <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2"> -->
                <!-- Calendar Setup -->
                <div class="panel panel-default">
                        <div class="panel-hiding" style="background: #2e6da4; color: white;">
                           <h2><center> Appointment Handler </center></h2>
                        </div>
                        <br>

                        <div class="panel-body">
                        {!! $calendar->calendar() !!}
                        {!! $calendar->script() !!}
                        </div>
                </div>
            <!-- </div>
        </div> -->
    </div>

</div>



@endsection

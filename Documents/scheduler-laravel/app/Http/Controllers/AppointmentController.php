<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Auth;
use DB;

class AppointmentController extends Controller
{
    /**
     * This function goes through authentication first
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display Main Calendar
     */
    public function index()
    {
        $userEmail = Auth::user()->email;
        $appointments = Appointment::where('user_email', $userEmail)->get();
        $app_array = [];

        foreach($appointments as $row) {
            $endDate = $row->end_date."24:00:00";
            $app_array[] = \Calendar::event(
                $row->title,
                false,
                new \DateTime($row->start_date),
                new \DateTime($row->end_date),
                $row->id,
                [
                    'colour' => $row->colour,
                ]
            );
        }
        $calendar = \Calendar::addEvents($app_array);
        return view('calendarPage', compact('appointments', 'calendar'));
    }


    public function addEventPage()
    {
        return view('addEvents');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'colour' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $appointments = new Appointment;

        $appointments->title = $request->input('title');
        $appointments->colour = $request->input('colour');
        $appointments->start_date = $request->input('start_date');
        $appointments->end_date = $request->input('end_date');

        $userId = auth()->user();
        $user_email = auth()->user();
        $appointments['user_id'] = $userId->id;
        $appointments['user_email'] = $user_email->email;

        $appointments->save();

        return redirect('calendarPage')->with('success', 'Event Successfully Added');
    }

    /**
     * Display the Events for the User.
     */
    public function show(Appointment $appointment)
    {
        $user_id = Auth::user()->id;
        $appointments = Appointment::where('user_id', $user_id)->get();

        return view('displayEvent')->with('appointments', $appointments);
    }


    public function edit($id)
    {
        $appointments = Appointment::find($id);
        return view('updateForm', compact('appointments', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'start_date'=>'required',
            'end_date'=>'required',
        ]);

        $appointments = Appointment::find($id);

        $appointments->title = $request->input('title');
        $appointments->start_date = $request->input('start_date');
        $appointments->end_date = $request->input('end_date');

        $appointments->save();
        return redirect('calendarPage')->with('success', 'Event Successfully Updated!');

    }

    /**
     * Share the event with another user
     */
    public function shareEvent(Request $request, $id)
    {
        $appointments = Appointment::find($id);
        $this->validate($request, [
            'user_email'=>'required',
        ]);

        $user = $request->input('user_email');
        $user_check = DB::table('users')->where('email', '=', $user);

        if(is_null($user_check)) {
            return redirect('calendarForm')->with('error', 'Email not Found!');
        }
        else {
            $title = DB::table('appointments')->select('title')->where($appointments);
            $colour = DB::table('appointments')->select('colour')->where($appointments);
            $startDate = DB::table('appointments')->select('start_date')->where($appointments);
            $endDate = DB::table('appointments')->select('end_date')->where($appointments);

            $appointments->user_email = $request->input('user_email');

            $appointments->save();

            return redirect('calendarPage')->with('success', 'Event has been shared!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointments = Appointment::find($id);
        $appointments->delete();

        return redirect('calendarPage')->with('success', 'Event Has Been Deleted');
    }
}

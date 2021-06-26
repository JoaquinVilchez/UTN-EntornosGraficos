<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function list()
    {
        $meetings = Meeting::orderBy('subject_id')->paginate(25);
        return view('meetings.list')->with('meetings', $meetings);
    }

    public function create()
    {
        $subjects = Subject::all();
        return view('meetings.create')->with('subjects', $subjects);
    }

    public function store(Request $request)
    {
        Meeting::create([
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'day' => $request->day,
            'hour' => $request->hour,
            'type' => $request->type,
            'classroom' => $request->classroom
        ]);

        return redirect()->route('meetings.list')->with('success_message', 'Consulta creada con éxito');
    }

    public function edit($id)
    {
        $meeting = Meeting::find($id);
        return view('meetings.edit')->with('meeting', $meeting);
    }

    public function update(Request $rquest, $id)
    {
    }

    public function destroy(Request $request)
    {
    }
}

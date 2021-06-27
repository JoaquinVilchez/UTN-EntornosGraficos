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
        $request->validate([
            'subject' => 'required',
            'teacher' => 'required',
            'day' => 'required',
            'hour' => 'required',
            'type' => 'required',
            'class' => 'nullable',
            'meeting_url' => 'nullable',
        ]);

        Meeting::create([
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'day' => $request->day,
            'hour' => $request->hour,
            'type' => $request->type,
            'classroom' => $request->classroom,
            'meeting_url' => $request->meeting_url,
        ]);

        return redirect()->route('meetings.list')->with('success_message', 'Consulta creada con éxito');
    }

    public function edit($id)
    {
        $meeting = Meeting::find($id);
        $subjects = Subject::all();
        return view('meetings.edit')->with([
            'meeting' => $meeting,
            'subjects' => $subjects
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'subject' => 'required',
            'teacher' => 'required',
            'day' => 'required',
            'hour' => 'required',
            'type' => 'required',
            'class' => 'nullable',
            'meeting_url' => 'nullable'
        ]);

        if ($request->type == 'virtual') {
            $classroom = null;
            $meeting_url = $request->meeting_url;
        } else if ($request->type == 'face-to-face') {
            $classroom = $request->classroom;
            $meeting_url = null;
        }

        $meeting = Meeting::find($id);
        $meeting->update([
            'subject_id' => $request->subject,
            'teacher_id' => $request->teacher,
            'day' => $request->day,
            'hour' => $request->hour,
            'type' => $request->type,
            'classroom' => $classroom,
            'meeting_url' => $meeting_url,
        ]);

        return redirect()->route('meetings.list')->with('success_message', 'Consulta editada con éxito');
    }

    public function destroy(Request $request)
    {
        $meeting = Meeting::find($request->meetingid);
        $meeting->delete();

        return redirect()->route('meetings.list')->with('success_message', 'Consulta eliminada con éxito');
    }
}

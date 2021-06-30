<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\MeetingsExport;
use App\Imports\MeetingsImport;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

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

    public function export()
    {
        return Excel::download(new MeetingsExport, 'consultas.xlsx');
    }

    public function import(Request $request)
    {
        request()->validate([
            'file' => 'required'
        ]);

        $meetings = Meeting::all();
        foreach ($meetings as $meeting) {
            $meeting->delete();
        }

        $file = $request->file('file');
        $items = Excel::toCollection(new MeetingsImport, $file);
        foreach ($items[0] as $item) {

            $legajo_profesor = User::where('university_id', $item['legajo_profesor'])->first();
            $materia = Subject::where('name', 'like', '%' . $item['materia'] . '%')->first();
            $pieces = explode('-', $item['dia_y_hora']);
            $day = normaliza(trim($pieces[0]));
            $hour = strtolower(trim($pieces[1]));
            $weekdays = [
                'lunes' => 1,
                'martes' => 2,
                'miercoles' => 3,
                'jueves' => 4,
                'viernes' => 5,
                'sabado' => 6,
                'domingo' => 0
            ];

            if ($item['tipo'] == 'Virtual') {
                $type = 'virtual';
            } elseif ($item['tipo'] == 'Presencial') {
                $type = 'face-to-face';
            }

            Meeting::create([
                'teacher_id' => $legajo_profesor->id,
                'subject_id' => $materia->id,
                'day' => $weekdays[$day],
                'hour' => $hour,
                'type' => $type,
                'classroom' => $item['salon_opc'],
                'meeting_url' => $item['link_opc']
            ]);
        }

        return redirect()->route('meetings.list')->with('success_message', 'Importado con éxito');
    }

    public function my_meetings(){
        
        if(Auth::check()){
            $user = Auth::user();

            if($user->type == 'teacher'){
                
                $next_meetings = $user->meetings;
                return view('meetings.my_meetings')->with('user', $user)->with('next_meetings', $next_meetings);
            }

            else{
                return view('home')->with('error_message', 'Usted no posee permisos para acceder a esta página');
            }

        }
    }

    public function meeting_details($meeting_id, $datetime)
    {
        try{

        $meeting = Meeting::findOrFail($meeting_id);
        $datetime = new Carbon($datetime);
        $inscriptions = $meeting->inscriptions->where('datetime', $datetime->format('Y-m-d h:i:s'));
        
        return view('meetings.view_meeting_details')->with('meeting', $meeting)->with('inscriptions', $inscriptions)->with('datetime',$datetime);
        
    
        }catch(Throwable $th)
        {
            return view('meetings.list')->with('error_message', 'Error. No se puede acceder a la consulta solicitada.');                        
        }



    }


   
}

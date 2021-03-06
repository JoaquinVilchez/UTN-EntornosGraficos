<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\MeetingsExport;
use App\Imports\MeetingsImport;
use App\Mail\CanceledMeetingNotification;
use App\Models\CanceledMeetings;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Mail;
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


    public function create_for_teacher()
    {
        $user = Auth::user();
        $subjects = $user->subjects;
        return view('meetings.create_for_teacher')->with('subjects', $subjects);
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

    public function my_meetings()
    {

        if (Auth::check()) {
            $user = Auth::user();

            if ($user->type == 'teacher') {

                $next_meetings = $user->meetings;
                return view('meetings.my_meetings')->with('user', $user)->with('next_meetings', $next_meetings);
            } else {
                return view('home')->with('error_message', 'Usted no posee permisos para acceder a esta página');
            }
        }
    }

    public function meeting_details($meeting_id, $datetime)
    {
        try {

            $meeting = Meeting::findOrFail($meeting_id);
            $datetime = new Carbon($datetime);
            $inscriptions = $meeting->inscriptions->where('datetime', $datetime->format('Y-m-d H:i:s'));

            return view('meetings.view_meeting_details')->with('meeting', $meeting)->with('inscriptions', $inscriptions)->with('datetime', $datetime);
        } catch (Throwable $th) {
            return view('meetings.list')->with('error_message', 'Error. No se puede acceder a la consulta solicitada.');
        }
    }

    public function cancel(Request $request)
    {

        try {



            $user = Auth::user();
            $meeting = Meeting::find($request->meetingid);

            $reason = $request->reason;
            $alternative_date = $request->alternative_date;
            $alternative_hour = $request->alternative_hour;

            $alternative_datetime = new Carbon("{$alternative_date} {$alternative_hour}");

            //valido que exista una fecha valida para la meeting mencionada
            $datetime = new Carbon($request->datetime);
            $day = $datetime->dayOfWeek;
            $hour = $datetime->format('H:i');

            $meeting_day = $meeting->day;
            $meeting_hour = $meeting->hour;

            $now = new Carbon();

            if (($meeting_day == $day) && ($meeting_hour == $hour)) {

                if ($alternative_datetime > $now) {
                    CanceledMeetings::create([
                        'datetime' => $datetime,
                        'alternative_datetime' => $alternative_datetime,
                        'reason' => $reason,
                        'meeting_id' => $meeting->id
                    ]);


                    if (count($meeting->inscriptions) > 0) {

                        //Envio de mail a los alumnos inscriptos
                        $inscriptions = $meeting->inscriptions->where('datetime', $request->datetime);

                        foreach ($inscriptions as $inscription) {

                            $student = $inscription->student;


                            $data = [
                                'student_name' => $student->getFullName(),
                                'teacher_name' => $meeting->teacher->getFullName(),
                                'reason' => $reason,
                                'alternative_datetime' => $alternative_datetime->format('Y-m-d H:i')
                            ];

                            Mail::to($student->email)->send(new CanceledMeetingNotification($data));
                        }
                    }




                    return redirect()->route('meetings.my_meetings')->with('success_message', "Se canceló la consulta del {$datetime} y se registró la consulta alternativa con su motivo de cancelación de manera satisfactoria.");
                } else {
                    return redirect()->route('meetings.my_meetings')->with('error_message', "La fecha y hora alternativa no puede ser anterior al momento actual.");
                }
            } else {
                return redirect()->route('meetings.my_meetings')->with('error_message', 'Fecha y hora no válidas.');
            }
        } catch (Exception $e) {
            return redirect()->route('meetings.my_meetings')->with('error_message', 'Hubo un error y no se pudo cancelar la consulta.');
        }
    }


    public function history()
    {

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->type == 'teacher') {
                $meetings = $user->meetings;
                return view('meetings.view_history')->with('meetings', $meetings);
            } else return redirect()->route('home')->with('error_message', 'Usted no posee accesos para acceder a esta página');
        } else return redirect()->route('home')->with('error_message', 'Usted no posee accesos para acceder a esta página');
    }
}

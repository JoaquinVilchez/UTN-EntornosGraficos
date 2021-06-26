<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Meeting;
use App\Models\Subject;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Throwable;

class InscriptionController extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $subjects = $user->subjects;


        return view('inscriptions_user.create')->with('subjects', $subjects);
    }

    public function selectTeacher(Request $request) 
    {
       $subject = Subject::find($request->subjectId);
       $teachers = $subject->teachers(); 

       return $teachers;
    }

    public function selectMeeting(Request $request) 
    {
       $subject = Subject::find($request->subjectId);
       $teacher = User::find($request->teacherId);
    
       $meetings = Meeting::where('teacher_id', $request->teacherId)->where('subject_id', $request->subjectId)->get();

       return $meetings;
    }

    public function select_subject()
    {
        $user = Auth::user();
        $subjects = $user->subjects;

        return view('inscriptions_user.select_subject')->with('subjects', $subjects);
    }

    public function select_teacher_for_subject(Request $request)
    {

        $subject = Subject::find($request->subject_id);
        $teachers = $subject->teachers(); 
        return view('inscriptions_user.select_teacher_for_subject')->with('teachers', $teachers)->with('subject', $subject);
    }

    public function view_meetings(Request $request)
    {
        try
        {
            $subject = Subject::find($request->subject_id);
            $teacher = User::find($request->teacher_id);
            $teachers_of_subject = $subject->teachers();
            if(count($teachers_of_subject->whereIn('id', $teacher->id)) != 1){
                
                return redirect()->route('inscriptions.select_subject')->with('error_message', 'Hubo un problema al seleccionar el docente y materia');
                
            }
            else
            {
                /*Buscar consultas para el docente*/
                $meetings = Meeting::all()->where('teacher_id', $teacher->id)->where('subject_id', $subject->id);
                return redirect()->route('inscriptions.view_meetings')->with($meetings);
            }

        }
        catch(Throwable $th){
                return redirect()->route('inscriptions.select_subject')->with('error_message', 'Hubo un problema al seleccionar el docente y materia');

        }

    }

    public function cancel(Request $request)
    {

        try {
            $user = Auth::user();
            $inscription = Inscription::find($request->inscriptionid);

            $datetime = new DateTime($inscription->meeting->datetime);
            $tomorrow = new DateTime('+1 day');



            if ($datetime < $tomorrow) {

                return redirect()->route('inscriptions_user.list')->with('error_message', 'Sólo se puede cancelar la inscripción para consultas con anticipación de 24hs.');
            }


            $inscription->update([
                'state' => 'canceled',

            ]);


            return redirect()->route('inscriptions_user.list')->with('success_message', 'Se ha cancelado la inscripción satisfactoriamente.');
        } catch (\Throwable $th) {
            return redirect()->route('inscriptions_user.list')->with('error_message', 'Hubo un error al intentar cancelar la inscripción.');
        }
    }

    public function list(Request $request)
    {
        $orderbyDate = 'ASC';

        if ($request->orderbyDate != null) {
            $orderbyDate = $request->orderbyDate;
        }


        $user = Auth::user();
        

        if($user != null){

            $today = new DateTime();

            $inscriptions = Inscription::select('inscriptions.*')
                ->join('meetings', 'meetings.id', '=', 'inscriptions.meeting_id')
                ->orderby('meetings.datetime', $orderbyDate)
                ->where('student_id', $user->id)
                ->where('meetings.datetime', '>=', $today)
                ->get()
                ->unique();

            return  view('inscriptions_user.list')->with('inscriptions', $inscriptions)->with('user', $user);
        }
        else return redirect()->route('login');
    }
}

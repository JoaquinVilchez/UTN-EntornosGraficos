<?php

namespace App\Http\Controllers;

use App\Models\CanceledMeetings;
use App\Models\Inscription;
use App\Models\Meeting;
use App\Models\Subject;
use App\Models\User;
use DateTime;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Cast\Array_;
use Throwable;

class InscriptionController extends Controller
{

    public function create()
    {

        if(Auth::check())
        {
            $user = Auth::user();
            $subjects = $user->subjects;
            return view('inscriptions_user.create')->with('subjects', $subjects);  
        }

        else{
            return redirect()->route('login')->with('error_message', 'Para poder inscribirte a una materia debes loguearte previamente.');  
        }


    }

    public function selectTeacher(Request $request) 
    {
       $subject = Subject::find($request->subjectId);
       $teachers = $subject->teachers(); 

       return $teachers;
    }

    public function selectMeeting(Request $request) 
    {

       $dates = new Collection();
       $output = '';
       $meetings = Meeting::where('teacher_id', $request->teacherId)->where('subject_id', $request->subjectId)->get(); 
       foreach($meetings as $meeting) {  
           
                $dayName = getDayName($meeting->day);   
                $date = Carbon::now()->next($dayName)->setTimeFromTimeString($meeting->hour);

                //for next 3 weeks 
                for($i=1; $i<=4; $i++){

                    $canceledMeetings = CanceledMeetings::all()->where('meeting_id', $meeting->id)->where('datetime', $date->format('Y-m-d H:i:s'));

                    if(! $canceledMeetings->first()) //not canceled meeting
                    {
                        $dates->push($date->copy());          
                    }   
        
                    $date->addWeek(1);
                }  

            }
        

        $sorted_dates = collect($dates)->sortBy(function ($date, $key) {
           return $date;
       });

       
        foreach($sorted_dates as $date)
        {
            $output .= '<div class="custom-control custom-radio">
            <input type="radio" id="'.$date.'" value="'.$date.'" name="datetime"  class="custom-control-input">
            <label class="custom-control-label" for="'.$date.'">'.$date->format('Y-m-d H:i').'</label>
            </div>';
        }


        if($output == ''){
            $output .= '<div class="custom-control">No hay consultas existentes para el docente seleccionado.</div>';
        }

        echo $output;   
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $subjects = Subject::all()->where('user_id', $user->id);

        try{

            $subject = Subject::findOrFail($request->subjects);
            $teacher = User::findOrFail($request->teachers);
            $datetime = $request->datetime;
            $student = Auth::user();

            $day = Carbon::parse($datetime)->dayOfWeek;
            $hour = Carbon::parse($datetime)->format('H:i');

            $meeting = Meeting::where('subject_id', $subject->id)->where('teacher_id', $teacher->id)->where('day', $day)->where('hour', $hour);
            
            if($meeting->first()){

                $exists_inscriptions = Inscription::all()->where('meeting_id', $meeting->first()->id)->where('datetime', $datetime);
                if($exists_inscriptions->first()){

                    return redirect()->route('inscriptions_user.list')->with('error_message', 'Usted ya se encuentra inscripto a la consulta seleccionada');
                }

                else{

                
                    Inscription::create([
                        'datetime' => $datetime,
                        'status' => 'active',
                        'student_id' => $student->id,
                        'meeting_id' => $meeting->first()->id
                    ]);

                    return redirect()->route('inscriptions_user.list')->with('success_message', 'Se ha inscripto a la consulta de manera satisfactoria.');
                }

            }
            else{
                return redirect()->route('inscriptions_user.list')->with('error_message', 'No se ha podido encontrar la consulta seleccionada.');
            }



        }catch(Exception $th){

            return redirect()->route('inscriptions_user.list')->with('error_message', 'Ha habido un error y no se ha podido incribirse a la consulta.');                
        }

    }



    public function cancel(Request $request)
    {

        try {
            $user = Auth::user();
            $inscription = Inscription::find($request->inscriptionid);

            $datetime = new DateTime($inscription->datetime);
            $tomorrow = new DateTime('+1 day');



            if ($datetime < $tomorrow) {

                return redirect()->route('inscriptions_user.list')->with('error_message', 'Sólo se puede cancelar la inscripción para consultas con anticipación de 24hs.');
            }


            $inscription->update([
                'status' => 'canceled',

            ]);


            return redirect()->route('inscriptions_user.list')->with('success_message', 'Se ha cancelado la inscripción satisfactoriamente.');
        } catch (\Throwable $th) {
            return redirect()->route('inscriptions_user.list')->with('error_message', 'Hubo un error al intentar cancelar la inscripción.');
        }
    }

    public function list(Request $request)
    {
        $orderDescending = false;

        if ($request->orderbyDate != null) {

            if($request->orderbyDate == 'DESC'){
                $orderDescending = true;

            }

            
        
        }


        $user = Auth::user();
        

        if(Auth::check()){

            $today = new Carbon();

            $next_inscriptions = Inscription::all()
                ->where('datetime', '>=', $today)
                ->sortBy('datetime', 0, $orderDescending)
                ->unique();

            $previous_inscriptions = Inscription::all()
                ->where('datetime', '<', $today)
                ->sortBy('datetime', 0, $orderDescending)
                ->unique();

            return  view('inscriptions_user.list')->with('next_inscriptions', $next_inscriptions)->with('previous_inscriptions', $previous_inscriptions)->with('user', $user);
        }
        else return redirect()->route('login');
    }

    public function test($subject_id, $teacher_id)
    {     
                  

    }
    
}
            


<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Meeting;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class InscriptionController extends Controller
{


    public function cancel(Request $request)
    {

        try{
            $user = User::find(1); //TODO: Aqui se debe recuperar el usuario logueado en sesion
            $inscription = Inscription::find($request->inscriptionid);

            dd($request->inscriptionid);

            $datetime = new DateTime($inscription->meeting->datetime);
            $tomorrow = new DateTime('+1 day');



            if($datetime < $tomorrow){

                return redirect()->route('inscriptions_user.list', $user->id)->with('error_message', 'Sólo se puede cancelar la inscripción para consultas con anticipación de 24hs.');
            }


            $inscription->update([
                'state' => 'canceled',

            ]);


            return redirect()->route('inscriptions_user.list', $user->id)->with('success_message', 'Se ha cancelado la inscripción satisfactoriamente.');
        
        }
        catch (\Throwable $th)
        {
            return redirect()->route('inscriptions_user.list', $user->id)->with('error_message', 'Hubo un error al intentar cancelar la inscripción.');
        }
        
    }

    public function list($user_id)
    {

        

        $user = User::find($user_id);
        $inscriptions = Inscription::select('inscriptions.*')
        ->join('meetings', 'meetings.id', '=', 'inscriptions.meeting_id')
        ->where('student_id', $user_id)
        ->where('inscriptions.state', 'enrolled')
        ->get()
        ->unique();

        return view('inscriptions_user.list')->with('inscriptions', $inscriptions)->with('user', $user);
    }

}

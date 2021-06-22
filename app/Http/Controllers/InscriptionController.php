<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Meeting;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class InscriptionController extends Controller
{

    public function index($user_id)
    { 
        $user = User::find($user_id);
        $inscriptions = Inscription::all()->where('student_id', $user_id)->unique();
        return view('inscriptions_user.list')->with('inscriptions', $inscriptions)->with('user', $user);
    }


    public function cancel(Request $request)
    {

        try{

            $inscription = Inscription::find($request->inscriptionid);
            $datetime = new DateTime($inscription->meeting->datetime);
            $tomorrow = new DateTime('+1 day');
            
            if($datetime < $tomorrow){

                return redirect()->route('inscription.index', $inscription->student->id)->with('error_message', 'Sólo se puede cancelar la inscripción para consultas con anticipación de 24hs.');
            }


            $inscription->update([
                'state' => 'canceled',

            ]);


            return redirect()->route('inscription.index', $inscription->student->id)->with('success_message', 'Se ha cancelado la inscripción satisfactoriamente.');
        
        }
        catch (\Throwable $th)
        {
            return redirect()->route('inscription.index', $inscription->student->id)->with('error_message', 'Hubo un error al intentar cancelar la inscripción.');
        }

        




        
    }

}

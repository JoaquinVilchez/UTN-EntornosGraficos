<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Meeting;
use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class InscriptionController extends Controller
{


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
                ->where('inscriptions.state', 'enrolled')
                ->where('meetings.datetime', '>=', $today)
                ->get()
                ->unique();

            return  view('inscriptions_user.list')->with('inscriptions', $inscriptions)->with('user', $user);
        }
        else return redirect()->route('login');
    }
}

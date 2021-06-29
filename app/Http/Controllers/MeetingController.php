<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function list()
    {

    }


    public function my_meetings_list($user_id){
        if(Auth::check()){
            $user = Auth::user();

            if($user->type == 'teacher'){

                $meetings = $user->meetings;                

                return view('meetings.my_meetings_list');

            }

            else{
                return view('home')->with('error_message', 'Usted no posee permisos para ver esta página');
            }

        }

        else{
            return redirect()->route('login');
        }
    }

    public function create()
    {
        return view('meetings.create');
    }

    public function store()
    {
        //

    }
}

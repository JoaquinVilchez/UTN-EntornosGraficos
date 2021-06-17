<?php

namespace App\Http\Controllers;

use App\Models\Inscription;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Http\Request;

class InscriptionController extends Controller
{

    public function index($user_id)
    { 
        $user = User::find($user_id);
        $inscriptions = Inscription::all()->where('student_id', $user_id);
        return view('inscriptions_user.list')->with('inscriptions', $inscriptions)->with('user', $user);
    }

}

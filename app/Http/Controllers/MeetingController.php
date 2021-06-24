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

    public function create()
    {
        return view('meetings.create');
    }

    public function store()
    {
        //

    }
}

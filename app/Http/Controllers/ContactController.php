<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\User;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

use function Psy\debug;

class ContactController extends Controller
{
    /**
     * Display a home view of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact.form');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send(Request $request)
    {
        $this->validate($request, [
            "message" => "required|string|min:20|max:2000",
            "name" => "required|string|min:3",
            "email" => "required|string|min:3",
        ]);

        $name = $request->name;
        $email = $request->email;
        $message = $request->message;

        $data = ['name' => $name, 'message' => $message, 'email' => $email];
        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactMail($data));
        return redirect()->back()->with('success_message', 'Mail enviado correctamente');
    }
}

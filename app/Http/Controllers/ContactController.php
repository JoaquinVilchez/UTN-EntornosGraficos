<?php

namespace App\Http\Controllers;

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
        $this->validate($request,[
            "message" => "required|string|min:20|max:2000",
            "name" => "required|string|min:3",
            "email" => "required|string|min:3",
        ]);
        
        $nombre = $_POST['name'];
        $email = $_POST['email'];
        $mensaje = $_POST['message'];
        $para = 'juanschar@gmail.com';
        $asunto = "Mail enviado desde la app de consultas";
        $header = 'From: ' . $email;
        $msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";
        
        if ($_POST['submit']) {
            $mail = @mail($para, $asunto, $msjCorreo, $header);
            if ($mail) {
                echo "<script language='javascript'>
                alert('Mensaje enviado'); location.href =history.back();
                </script>";
            } else {
                echo 'Falló el envio';
            }
        }
    }

}

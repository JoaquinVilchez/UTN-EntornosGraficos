<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Display a home view of users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.home');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $users = User::where('status', 'active')->paginate(10);
        return view('users.list')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dni' => ['required', 'string', 'size:8'],
            'university_id' => ['required', 'string', 'max:6'],
            'type' => 'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dni' => $request->dni,
            'university_id' => $request->university_id,
            'type' => $request->type,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('user.list')->with('success_message', 'Usuario creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'dni' => ['required', 'string', 'size:8'],
            'university_id' => ['required', 'string', 'max:6'],
            'type' => 'required'
        ]);

        $user = User::find($id);
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'dni' => $request->dni,
            'university_id' => $request->university_id,
            'type' => $request->type,
        ]);

        return redirect()->route('user.list')->with('success_message', 'Usuario editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        try {
            $user = User::findOrFail($request->userid);
            $userType = $user->getType();
            if ($user->subjects) {
                $user->update([
                    'status' => 'deleted'
                ]);
            } else {
                $user->delete();
            }

            return redirect()->route('user.list')->with('success_message', $userType . ' eliminado con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('user.list')->with('error_message', 'Hubo un problema y no pudimos eliminar al usuario.');
        }
    }
}

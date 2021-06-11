<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class SubjectTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_user)
    {
        $user = User::find($id_user);
        $subjects = $user->subjects()->paginate(10);

        
        return view('subjects_teacher.list')->with('subjects', $subjects)->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
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
    public function edit($id_user)
    {
        $user = User::all()->find($id_user);
        return view('subjects_teacher.edit')->with('user', $user);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $add_subjects, $edit_subjects, $delete_subjects)
    {  
        

        $added_roles = array_keys($request->input('add_subjects'));
        $edited_roles = array_keys($request->input('edit_subjects'));


        dd($added_roles, $edited_roles);
        


        $user_subjects_id = array_keys($request->input('user_subjects'));
        
        $subjects = Subject::all();
        $user_subjects = $subjects->intersect(Subject::whereIn('subjects.id',$user_subjects_id)->get());


        $ok = true;

        try {

            /* Agregar nuevas relaciones de usuarios materias */
            foreach ($add_subjects as $subject) {
                
                if($user->type == 'teacher'){
                    
                    
                    DB::table('subject_user')->insert([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'role'=> 'titular'
                    ]);

                
            }


        }
    
            
        }catch (\Throwable $th) {
            $ok = false;
        }


        try{

            /* Eliminar relaciones de usuarios materias */
            foreach ($delete_subjects as $subject) {
                
                if($user->type == 'teacher'){

                DB::table('subject_user')->where('subject_id',$subject->id)->where('user_id', $user->id)->delete();
                
            }
        }
            return redirect()->route('subjects_teacher.index', $user->id)->with('success_message', "Se agregaron las siguientes materias seleccionadas para el usuario determinado");

        }catch (\Throwable $th) {
            $ok = false;
        }

        if($ok){
            return redirect()->route('subjects_teacher.index', $user->id)->with('success_message', "Se agregaron y/o quitaron las materias seleccionadas para el usuario determinado");   
        }

        return redirect()->route('subjects_teacher.edit', $user->id)->with('error_message', "Hubo un problema y no se agregaron ni quitaron las materias para el usuario determinado.{$th}");

        


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
      
    }


    public function view_roles(Request $request, $id){
        
        $user = User::all()->find($id);

        $checked_subjects_id = array_keys($request->input('subjects'));
        
        $subjects = Subject::all();
        $checked_subjects = $subjects->intersect(Subject::whereIn('subjects.id',$checked_subjects_id)->get());
        
        
        $old_subjects = $user->subjects()->get();
        $add_subjects = $checked_subjects->diff($old_subjects);
        $delete_subjects = $old_subjects->diff($checked_subjects);
        $edit_subjects = $old_subjects->intersect($checked_subjects);


        return view('subjects_teacher.view_roles')->with('add_subjects', $add_subjects)->with('delete_subjects', $delete_subjects)->with('edit_subjects',$edit_subjects)->with('user', $user);

    }




}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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
    public function update(Request $request, $user_id)
    {  
        
        $user = User::find($user_id);
        $add_subjects = $request->session()->pull('add_subjects', 'default');
        $edit_subjects = $request->session()->pull('edit_subjects', 'default');
        $delete_subjects = $request->session()->pull('delete_subjects', 'default');

        
        $edited_roles = $request->input('edit_subjects');
        $added_roles = $request->input('add_subjects');

        $ok = true;



        try{
            
            /* Agregar relaciones de usuarios materias */
            foreach ($add_subjects as $subject) {

                $role = $added_roles[$subject->id];

                if($user->type == 'teacher'){                    
                    DB::table('subject_user')->insert([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'role'=> $role
                    ]);
                }
            }
        }catch (\Throwable $th) {
            $ok = false;
        }

        try{

            /* Editar relaciones de usuarios materias */

            foreach ($edit_subjects as $subject) {

                $role = $edited_roles[$subject->id];

                if($user->type == 'teacher'){
                    
                    
                    DB::table('subject_user')->where('user_id', $user->id)->where('subject_id', $subject->id)->update([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'role'=> $role
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

        }catch (\Throwable $th) {
            $ok = false;
        }

        if($ok){
            return redirect()->route('subjects_teacher.index', $user->id)->with('success_message', "Se actualizaron satisfactoriamente las materias seleccionadas para el usuario determinado");   
        }

        return redirect()->route('subjects_teacher.edit', $user->id)->with('error_message', "Hubo un problema y no se agregaron ni quitaron las materias para el usuario determinado.{$th}");

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);

        try{

            if($user->type == 'teacher'){

                DB::table('subject_user')->where('user_id', $user_id)->delete();                
            }

            /*HAY ERROR EN ESTA LINEA NO SE PORQUE */
            return redirect()->route('subjects_teacher.index', $user_id)->with('success_message', "Se eliminaron satisfactoriamente las materias seleccionadas para el usuario determinado");

        }catch (\Throwable $th) {
            return redirect()->route('subjects_teacher.edit', $user_id)->with('error_message', "Hubo un problema y no se agregaron eliminaron las materias para el usuario determinado.{$th}");
        }
      
    }


    public function view_roles(Request $request, $id){
        

        /*Si no hay materias marcadas en el checkbox, se eliminan las materias directamente, evitando el update */
        if($request->input('subjects') == null){

            $this->destroy($id);
        }

        else
        {

            $user = User::all()->find($id);
            $checked_subjects = array();
            $checked_subjects_id = array_keys($request->input('subjects'));
    
            $subjects = Subject::all();
            $old_subjects = $user->subjects()->get();
            $checked_subjects = $subjects->intersect(Subject::whereIn('subjects.id',$checked_subjects_id)->get());
            $add_subjects = $checked_subjects->diff($old_subjects)->unique();
            $edit_subjects = $old_subjects->intersect($checked_subjects)->unique();
    
            
            
            
            $delete_subjects = $old_subjects->diff($checked_subjects)->unique();
    
    
            //Es la manera correcta guardar esta informacion en sesion?
               
    
            $request->session()->put('delete_subjects', $delete_subjects);
            $request->session()->put('add_subjects', $add_subjects);
            $request->session()->put('edit_subjects', $edit_subjects);
    
            return view('subjects_teacher.view_roles')->with('add_subjects', $add_subjects)->with('delete_subjects', $delete_subjects)->with('edit_subjects',$edit_subjects)->with('user', $user);
    

        }

      
    }




}

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

class SubjectUserController extends Controller
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

        
        return view('subjects_user.list')->with('subjects', $subjects)->with('user',$user);
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
        return view('subjects_user.edit')->with('user', $user);
       
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

        
        $edited_pivot = $request->input('edit_subjects');
        $added_pivot = $request->input('add_subjects');

        $ok = true;



        try{
            
            /* Agregar relaciones de usuarios materias */
            foreach ($add_subjects as $subject) {

                $pivot = $added_pivot[$subject->id];

                if($user->type == 'teacher'){                    
                    DB::table('subject_user')->insert([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'role'=> $pivot
                    ]);
                }
                if($user->type == 'student'){                    
                    DB::table('subject_user')->insert([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'status'=> $pivot
                    ]);

            }
        } }
        
        catch (\Throwable $th) {
            $ok = false;
        }

        try{

            /* Editar relaciones de usuarios materias */

            foreach ($edit_subjects as $subject) {

                $pivot = $edited_pivot[$subject->id];

                if($user->type == 'teacher'){
                    
                    
                    DB::table('subject_user')->where('user_id', $user->id)->where('subject_id', $subject->id)->update([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'role'=> $pivot
                    ]);

                }
                if($user->type == 'student'){
                    
                    DB::table('subject_user')->where('user_id', $user->id)->where('subject_id', $subject->id)->update([
                        'user_id'=>$user->id,
                        'subject_id'=>$subject->id,
                        'status'=> $pivot
                    ]);

                }

            }
        }catch (\Throwable $th) {
            $ok = false;
        }

        try{

            /* Eliminar relaciones de usuarios materias */
            foreach ($delete_subjects as $subject) {
                
            

                DB::table('subject_user')->where('subject_id',$subject->id)->where('user_id', $user->id)->delete();
                
            }

        } catch (\Throwable $th) {
            $ok = false;
        }

        if($ok){
            return redirect()->route('subjects_user.index', $user->id)->with('success_message', "Se actualizaron satisfactoriamente las materias seleccionadas para el usuario determinado");   
        }

        return redirect()->route('subjects_user.edit', $user->id)->with('error_message', "Hubo un problema y no se agregaron ni quitaron las materias para el usuario determinado.{$th}");

    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($user_id)
    {
       
    }


    public function view_roles_and_status(Request $request, $id){
        

        /*Si no hay materias marcadas en el checkbox, se eliminan las materias directamente, evitando el update */
        if($request->input('subjects') == null){

            try{

                DB::table('subject_user')->where('user_id', $id)->delete();
                return redirect()->route('subjects_user.index', $id)->with('success_message', "Se eliminaron satisfactoriamente las materias seleccionadas para el usuario determinado");
                      
              }catch (\Throwable $th) {
      
                  dd('mal');
                  return redirect()->route('subjects_user.edit', $id)->with('error_message', "Hubo un problema y no se agregaron eliminaron las materias para el usuario determinado.{$th}");
              }
        }

        else
        {

            $user = User::find($id);
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

            

            if ($user->type =='teacher')
            {
                return view('subjects_user.view_roles')->with('add_subjects', $add_subjects)->with('delete_subjects', $delete_subjects)->with('edit_subjects',$edit_subjects)->with('user', $user);
    
            }
            if ($user->type =='student')

            {
                return view('subjects_user.view_status')->with('add_subjects', $add_subjects)->with('delete_subjects', $delete_subjects)->with('edit_subjects',$edit_subjects)->with('user', $user);
    
            }
    
           
    

        }

      
    }

    public function view_subjects_info($id_subject)
    {
        $subject = Subject::find($id_subject);
        $teachers = $subject->teachers()->unique();
        $students = $subject->students()->unique();
        return view('subjects_user.view_subject_info')->with('subject', $subject)->with('teachers', $teachers)->with('students', $students);


    }

    public function view_teacher_subjects($id_user)
    {
        $user = User::find($id_user);
        $userType = $user->getType();
        if ($userType == 'Docente')
        {
            $subjects = $user->subjects()->paginate(10);
            return view('subjects_user.view_teacher_subjects')->with('subjects', $subjects)->with('user',$user);   
        }
        else{
            
            return redirect()->route('subjects_user.view_teacher_subjects', $id_user)->with('success_message', 'No es profesor.'); //ver linea, esta mal.
         }
        
        
         
    

    }




}

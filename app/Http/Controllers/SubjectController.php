<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::paginate(10); //Trabajamos la baja de materias como banderas
       
        return view('subjects.list')->with('subjects', $subjects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('subjects.create');
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
            'name'=>['required','string','max:50'],
            'level'=>['required', 'int','between:1,5'],
            'career'=>['nullable'],
        ]);
        
         Subject::create([
            'name' => $request->name,
            'level' => $request->level,
            'career' => $request->career,

        ]);

        return redirect()->route('subject.index');
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
        $subject = Subject::find($id);
        return view('subjects.edit')->with('subject', $subject);
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
            'name'=>['required','string','max:50'],
            'level'=>['required', 'int','between:1,5'],
            'career'=>['nullable'],
        ]);
        
        $subject = Subject::find($id);
        $subject->update([
            'name' => $request->name,
            'level' => $request->level,
            'career' => $request->career,

        ]);

        return redirect()->route('subject.index');
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
            $subject = Subject::findOrFail($request->subjectid);
            $subject->delete();

            return redirect()->route('subject.index')->with('success_message', 'Materia eliminada con éxito.');
        } catch (\Throwable $th) {
            return redirect()->route('subject.index')->with('error_message', 'Hubo un problema y no pudimos eliminar la materia.');
        }
    }
}

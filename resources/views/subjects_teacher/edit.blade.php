@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row">
                @include('elements.messages')
                  <div class="col-12">
                    <div class="d-flex justify-content-between mb-2">

                        <form method="GET" action="{{ route('subjects_teacher.view_roles', $user->id) }}">
                            @csrf
                            
                            @if ($user->type == 'teacher')
            
                                <h2>Materias que brinda el docente {{$user->getFullName()}}</h2>
                            
                            @endif
                            
                            @if($user->type == 'student')

                                <h2>Materias que se encuentra inscripto el alumno {{$user->getFullName()}}</h2>

                            @endif

                            <hr>
                            @for ($i = 1; $i <= 5; $i++)
                            
                                <h3>Materias de {{$i}}° año</h3>
                                

                                @php
                                $subjects_for_level = get_subjects_for_level($i);
                                @endphp

                                @foreach ($subjects_for_level as $subject)
                                
                                
                                <div class="form-check">
                                    <input type="checkbox" name="subjects[{{$subject->id}}]" class="form-check-input" id="checkbox-id-{{$subject->id}}}"

                
                                    @if ($user->subjects()->where('subjects.id', $subject->id)->exists())
                                    checked   
                                    @endif                            
                                    >
                                    <label class="form-check-label" for="checkbox-id-{{$subject->id}}}">{{$subject->name}}</label>
                                </div>


                                @endforeach

                                <hr>

                            
                            @endfor



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                            Actualizar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection
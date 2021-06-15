@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('subjects_user.update', $user->id) }}">
                @csrf

                                    
                <div class="form-group row">
                
                @foreach ($edit_subjects as $subject)
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{$subject->name}}</span>
                        </div>
                        
                        <select  id="edit_subjects[{{$subject->id}}]" name="edit_subjects[{{$subject->id}}]" class="custom-select" required>
                            <option value="enrolled" 
                            @if ($user->getStatusofSubject($subject->id) == 'enrolled')
                                selected="selected"
                            @endif >Inscripto</option>


                            <option value="regular"
                            @if ($user->getStatusofSubject($subject->id) == 'regular')
                                selected="selected"
                            @endif >Regular</option>

                            <option value="approved" 
                            @if ($user->getStatusofSubject($subject->id) == 'approved')
                                selected="selected"
                            @endif >Aprobado</option>
                        </select>
  
                    </div>

                @endforeach
                @foreach ($add_subjects as $subject)
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{$subject->name}}</span>
                        </div>
                        
                        <select id="add_subjects[{{$subject->id}}]" name="add_subjects[{{$subject->id}}]" class="custom-select" required>
                            <option value="enrolled" selected="selected">Inscripto</option>
                            <option value="regular">Regular</option>
                            <option value="approved">Aprobado</option>
                        </select>
  
                    </div>

                @endforeach



                
                </div>    
                    
                <div class="form-group row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('Actualizar inscripciones') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
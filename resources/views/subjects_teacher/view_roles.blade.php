@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('subjects_teacher.update', $user->id) }}">
                @csrf

                                    
                <div class="form-group row">

                @foreach ($edit_subjects as $subject)
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{$subject->name}}</span>
                        </div>
                        
                        <select  id="edit_subjects[{{$subject->id}}]" class="custom-select" required>
                            <option value="titular" 
                            @if ($user->getRole($subject->id) == 'titular')
                                selected="selected"
                            @endif >Titular</option>


                            <option value="alternate"
                            @if ($user->getRole($subject->id) == 'alternate')
                                selected="selected"
                            @endif >Suplente</option>
                        </select>
  
                    </div>

                @endforeach

                @foreach ($add_subjects as $subject)
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{$subject->name}}</span>
                        </div>
                        
                        <select id="add_subjects[{{$subject->id}}]" class="custom-select" required>
                            <option value="titular" selected="selected">Titular</option>
                            <option value="alternate">Suplente</option>
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
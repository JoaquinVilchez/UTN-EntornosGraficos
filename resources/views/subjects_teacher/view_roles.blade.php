@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('subjects_teacher.update', $user->id, $add_subjects, $delete_subjects) }}">
                @csrf
                @method('PUT')

                                    
                <div class="form-group row">
                @foreach ($user_subjects as $user_subject)
                
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">{{$user_subject->name}}</span>
                        </div>
                        <select value="{{$user->getRole($user_subject->id)}}" name="user_subjects[{{$user_subject->id}}]" id="user_subjects[{{$user_subject->id}}]" class="custom-select" required>
                            <option value="titular">Titular</option>
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
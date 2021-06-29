@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12"> 
                <h1>Editar usuario</h1>
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                        <div class="col-md-6">
                            <input value="{{old('first_name',$user->first_name)}}" id="first_name" type="text" class="form-control" name="first_name" required autocomplete="first_name" autofocus>

                            {!!$errors->first('first_name', '<small style="color:red"><i class="fas fa-exclamation-circle"></i> :message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                        <div class="col-md-6">
                            <input value="{{old('last_name', $user->last_name)}}" id="last_name" type="text" class="form-control" name="last_name" required autocomplete="last_name" autofocus>

                            {!!$errors->first('last_name', '<small style="color:red"><i class="fas fa-exclamation-circle"></i> :message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                        <div class="col-md-6">
                            <input value="{{old('email', $user->email) }}" id="email" type="email" class="form-control" name="email" required autocomplete="email">

                            {!!$errors->first('email', '<small style="color:red"><i class="fas fa-exclamation-circle"></i> :message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="dni" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>

                        <div class="col-md-6">
                            <input value="{{old('dni', $user->dni)}}" id="dni" type="text" class="form-control" name="dni" required autocomplete="dni">

                            {!!$errors->first('dni', '<small style="color:red"><i class="fas fa-exclamation-circle"></i> :message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="university_id" class="col-md-4 col-form-label text-md-right">{{ __('Legajo') }}</label>

                        <div class="col-md-6">
                            <input value="{{old('university_id', $user->university_id)}}" id="university_id" type="text" class="form-control" name="university_id" autocomplete="university_id">

                            {!!$errors->first('university_id', '<small style="color:red"><i class="fas fa-exclamation-circle"></i> :message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuario') }}</label>

                        <div class="col-md-6">
                            <select class="form-control" name="type" id="type">
                                <option value="student" 
                                @if ($user->type=='student')
                                    selected
                                @endif >Alumno</option>
                                <option value="teacher"
                                @if ($user->type=='teacher')
                                    selected
                                @endif 
                                >Docente</option>
                                <option value="admin"
                                @if ($user->type=='admin')
                                    selected
                                @endif 
                                >Administrador</option>
                            </select>

                            {!!$errors->first('type', '<small style="color:red"><i class="fas fa-exclamation-circle"></i> :message</small>') !!}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Editar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
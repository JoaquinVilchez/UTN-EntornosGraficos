@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="">
                    @csrf
                    
                    

                    @for ($i = 1; $i <= 5; $i++)
                    
                        <h3>Materias de {{$i}}° año</h3>
                        

                        @php
                        $subjects_for_level = get_subjects_for_level($i);
                        @endphp

                        @foreach ($subjects_for_level as $subject)
                        
                        <div class="custom-control custom-switch">
                            <input value="{{old('dni', $user->dni)}}" class="custom-control-input" type="checkbox" id="checkbox-id-{{$i}}" />
                            <label class="custom-control-label" for="checkbox-id-{{$i}}">{{$subject->name}}</label>
                        </div>

                                             


                        @endforeach

                        <hr>

                    
                    @endfor



                    

                    
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de materia') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Año de cursado') }}</label>

                        <div class="col-md-6">
                            <input id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level" autofocus>

                            @error('level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="career" class="col-md-4 col-form-label text-md-right">{{ __('Carrera') }}</label>

                        <div class="col-md-6">
                            <select id="career" class="custom-select @error('career') is-invalid @enderror" name="career" value="{{ old('career') }}" required autocomplete="career">
                                
                            <option value="ISI">Ingeniería en Sistemas</option>
                            <option value="IM">Ingeniería Mecánica</option>
                            <option value="IQ">Ingeniería Química</option>
                            <option value="IC">Ingeniería Civil</option>
                            <option value="IE">Ingeniería Eléctrica</option>
                            </select>

                            @error('career')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                 

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Crear materia') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
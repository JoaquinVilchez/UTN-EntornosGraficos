@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('subject.update', $subject->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de materia') }}</label>

                        <div class="col-md-6">
                            <input value="{{$subject->name}}" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                            <input value="{{$subject->level}}" id="level" type="text" class="form-control @error('level') is-invalid @enderror" name="level" value="{{ old('level') }}" required autocomplete="level" autofocus>

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
                            <select value="{{$subject->career}}" id="career" type="text" class="custom-select @error('career') is-invalid @enderror" name="career" value="{{ old('career') }}" required autocomplete="career">
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
                                {{ __('Editar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
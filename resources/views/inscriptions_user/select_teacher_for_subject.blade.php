@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center pb-2">
            <h1>Crear consulta semanal</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{route('inscriptions.view_meetings')}}">
                    @csrf

                    <input type="hidden" name="subject_id" value="{{$subject->id}}">
        
                    <div class="form-group row">
                        <label for="teacher" class="col-md-4 col-form-label text-md-right">Docente</label>

                        <div class="col-md-6">
                            <select name="teacher_id" id="teacher_id" class="selectpicker" data-live-search="true" data-width="100%">
                                @foreach ($teachers as $teacher)
                                    <option value="{{$teacher->id}}">{{$teacher->getFullName()}}</option>
                                @endforeach                                
                              </select>

                            @error('teacher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

    
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Seleccionar día y horario
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
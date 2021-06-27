@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center pb-2">
            <h1>Crear consulta semanal</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('inscriptions.select_teacher_for_subject')}}">
                    @csrf
                    
                    <div class="form-group row">
                        <label for="subject" class="col-md-4 col-form-label text-md-right">Materia</label>

                        <div class="col-md-6">
                            <select name="subject_id" id="subject_id" class="selectpicker" data-live-search="true" data-width="100%">
                                    @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach                                
                              </select>

                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


    
                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                Siguiente
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
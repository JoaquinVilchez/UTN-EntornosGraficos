@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row d-flex justify-content-center pb-2">
            <h1>Crear consulta semanal</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <form method="POST" action="{{ route('inscriptions.confirmation')}}">
                    @csrf
                    
                    <div class="row">
                        <div class="col-sm"><h3>Materia:{{$subject->name}}</h3></div>
                        <div class="col-sm"><h3>Docente:{{$teacher->getFullName()}}</h3></div>
                    </div>

                        @foreach ($meetings as $meeting)
                            <div class="row">
                                <p>Dia de semana: {{$meeting->day}}</p>
                                <p>Hora: {{$meeting->hour}}</p>
                                <p>Tipo de consulta: {{$meeting->type}}</p>
                                @if ($meeting->type == 'virtual')
                                    Link: {{$meeting->meeting_url}}
                                @endif
                                @if ($meeting->type == 'face-to-face')
                                    Aula: {{$meeting->classroom}}
                                @endif
                                
                                <p>Estado: {{$meeting->state}}</p>
                                <p>Estado: {{$meeting->state}}</p>

                            </div>
                        @endforeach
                        

    
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
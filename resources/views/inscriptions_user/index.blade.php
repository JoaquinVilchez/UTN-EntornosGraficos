@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
                <div class="container">
                    <div class="row">
                        <div class="ml-auto"><a href="#" type="button" class="btn btn-primary">Inscribirse a una nueva consulta</a></div>
                    </div>
                </div>
                    <h1>Inscripciones para el alumno {{$user->getFullName()}}</h1>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Fecha y hora</th>
                        <th scope="col">Docente</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Estado de la consulta</th>
                        <th scope="col">Estado de inscripción</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($inscriptions as $inscription)
                        
                          <tr>
                            <td>{{$inscription->id}}</td>
                            <td>{{$inscription->meeting->datetime}}</td>
                            <td>{{$inscription->meeting->teacher->getFullName()}}</td>
                            <td>{{$inscription->meeting->subject->name}}</td>
                            <td>{{$inscription->meeting->getState()}}</td>
                            <td>{{$inscription->getState()}}</td>
                            <td>
                              @if($inscription->meeting->state == 'pending' && $inscription->state == 'enrolled')
                                <a href="#" type="button" class="btn btn-danger">Cancelar</a>
                              @endif
                            </td>         
                           
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>

            </div>
        </div>
    </div>


@endsection
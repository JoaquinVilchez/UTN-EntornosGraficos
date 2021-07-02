@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
              <div class="card d-flex justify-content-between mb-2">
                <h1 class="card-header">Docente: {{$user->getFullName()}}</h1>

              </div>
              
              <br>
              <div class="d-flex justify-content-between mb-2">
              <h3>Materias</h3>
              </div>
                <table class="table table-striped table-responsive-md">
                    <thead>
                      <tr>
                        <th scope="col">Año</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Nombre</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{$subject->level}}</td>
                            <td>{{$subject->career}}</td>
                            <td>{{$subject->name}}</td>
                            <td><a href="#" class="btn btn-primary">Ver disponibilidad</a></td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection
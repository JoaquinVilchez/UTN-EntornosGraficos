@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
              <div class="card d-flex justify-content-between mb-2">
                <h1 class="card-header">Materia: {{$subject->name}}</h1>
                <div class="card-body">
                  <p class="card-text">
                    Año: {{$subject->level}} <br>
                    Carrera: {{$subject->career}}
                  </p>
                  <a href="{{route('subject.edit', $subject->id)}}" class="btn btn-primary">Editar materia</a>
                </div>
              </div>
              
              <br>
              <div class="d-flex justify-content-between mb-2">
              <h3>Docentes</h3>
              </div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Rol</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($teachers as $user)
                        <tr>
                            <td>{{$user->dni}}</td>
                            <td>{{$user->university_id}}</td>
                            <td>{{$user->getFullName()}}</td>
                            <td>{{$user->getRoleSpanish($subject->id)}}</td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>

                  <br>
              <div class="d-flex justify-content-between mb-2">
              <h3>Alumnos</h3>
              </div>
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($students as $user)
                        <tr>
                            <td>{{$user->dni}}</td>
                            <td>{{$user->university_id}}</td>
                            <td>{{$user->getFullName()}}</td>
                            <td>{{$user->getStatusofSubjectSpanish($subject->id)}}</td>
                            <td></td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>
            </div>
        </div>
    </div>

@endsection


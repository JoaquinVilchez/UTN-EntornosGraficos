@extends('layouts.app')

@section('content')
    <div class="container">
      <div class="row">
          @include('elements.messages')
            <div class="col-12">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <h1>Materias para el {{strtolower($user->getType())}} {{$user->getFullName()}}</h1>
                <a class="btn btn-primary" href="{{ route('subjects_user.edit', $user->id) }}">Editar</a>
              </div>
                <table class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Materia</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Nivel</th>
                        @if($user->type=='teacher')
                        <th scope="col">Rol</th>
                        @endif
                        @if($user->type=='student')
                        <th scope="col">Estado</th>
                        @endif

                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <td>{{$subject->id}}</td>
                            <td>{{$subject->name}}</td>
                            <td>{{$subject->career}}</td>
                            <td>{{$subject->level}}</td>
                            @if($user->type=='teacher')
                            <td>{{$user->getRoleSpanish($subject->id)}}</td>
                            @endif
                            @if($user->type=='student')
                            <td>{{$user->getStatusofSubjectSpanish($subject->id)}}</td>
                            @endif

                            <td></td>
                        </tr>
                    @endforeach
                      <tr>
                    </tbody>
                  </table>

                  {{ $subjects->links() }}
            </div>
        </div>
    </div>

@endsection


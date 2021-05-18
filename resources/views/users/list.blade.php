@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Legajo</th>
                        <th scope="col">Nombre y apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->university_id}}</td>
                            <td>{{$user->getFullName()}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->getType()}}</td>
                            <td>
                                <a href="{{route('user.edit', $user->id)}}">Editar</a>
                                <a href="#">Eliminar</a>
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

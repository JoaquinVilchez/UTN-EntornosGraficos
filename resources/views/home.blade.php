@extends('layouts.app')

@section('content')
    <div class="container vh-100">
        <div class="row">
            <div class="col-sm">
                <div class="row justify-content-center">
                    <div class="card bg-secondary">
                        <div class="card-body text-white rounded">
                            <div class="row ">
                        <div class=" ml-4">
                            <img src="https://i.pinimg.com/originals/51/d0/a4/51d0a49eef5fb23029560f389f64a21e.jpg" alt="profile-picture" class="rounded-circle img-thumbnail" style="height: 100px;">
                        </div>
                        <div class="ml-4">
                            <h1 class="card-title">¡Hola Juan Perez!</h1>
                            <p class="card-text">Estudiante de Ingeniería en Sistemas de Información</p>
                        </div>
                        <div class="d-flex align-items-center m-4">
                            <button href="#" class="btn btn-primary">Editar Perfil</button>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <a href="{{route('user.index')}}" class="btn btn-primary m-2">Usuarios</a>
                    <a href="{{route('users.search_teacher')}}" class="btn btn-primary m-2">Docentes</a>
                    <a href="{{route('subject.index')}}" class="btn btn-primary m-2">Materias</a>                    
                    <a href="{{route('inscriptions_user.list')}}" class="btn btn-primary m-2">Consultas</a>
                </div>
            </div>
        </div>
    </div>
@endsection
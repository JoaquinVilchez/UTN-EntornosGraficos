@extends('layouts.app')

@section('content')

    @if(Auth::check()) 
        <div class="container vh-50">
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
                                <h1 class="card-title">Hola
                                    
                                    {{Auth::user()->first_name}}       
                                    </h1>
                                <p class="card-text">{{Auth::user()->getType()}} de la Universidad Tecnológica nacional de Rosario</p>
                            </div>
                            @if(Auth::check())    
                                <div class="d-flex align-items-center m-4">
                                    <a href="{{route('user.edit', Auth::user()->id)}}" class="btn btn-primary">Editar Perfil</a>
                                </div>
                            @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else 
    <div class="container vh-50">
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
                            <h1 class="card-title">¡Ups!</h1>
                            <p class="card-text">Es necesario estar registrado y haber iniciado sesión para poder inscribirte a las clases de consulta de la universidad.</p>
                            <p> ¿Aún no estás registrado? <a class="text-warning" href="{{route('register')}}">Click aquí</a></p>
                        </div>
                            <div class="d-flex align-items-center m-4">
                                <a href="{{route('login')}}" class="btn btn-light">Acceder</a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

        
    @endif

    <div class="container mb-4 mt-4">
        <div class="row bg-color-gray">
            <div class="col-sm align-self-center pl-5">    
                <h2 class="h2">CVG - Sistema de consultas<h2>
                <p class="lead">El sistema de gestión de consultas de la UTN permite a una red de comunicación entre alumnos, docentes y administrativos de la Universidad Tecnológica Nacional de Rosario, permitiendo controlar y gestionar la toma de clases de consultas. Nuestro propósito es que los estudiantes puedan encontrar respuestas a las inquietudes y necesidades académicas de una manera rápida y sencilla.</p>
            </div>

            <div class="col-sm">
                <img class="img-fluid" src="https://frro.cvg.utn.edu.ar/pluginfile.php/1/theme_snap/coverimage/1565009858/site-image.png" alt="utn cabecera de inicio">    
            </div>
            
        </div>
    </div>

    


@endsection
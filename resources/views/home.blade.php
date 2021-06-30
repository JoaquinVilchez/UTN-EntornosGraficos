@extends('layouts.app')

@section('content')

    <div class="container mb-4">
        <div class="row bg-color-gray">
            <div class="col-sm align-self-center pl-5">    
                <h2 class="h2">CVG - Sistema de consultas<h2>
                <p class="lead">El sistema de gestión de consultas de la UTN permite a una red de comunicación entre alumnos, docentes y administrativos de la Universidad Tecnológica Nacional de Rosario, permitiendo controlar y gestionar la toma de clases de consultas. Nuestro propósito es que los estudiantes puedan encontrar respuestas a las inquietudes y necesidades académicas de una manera rápida y sencilla.</p>
                @if(!Auth::check())
                <a href="{{route('login')}}" class="btn btn-info">Acceder</a>
                @endif
            </div>

            <div class="col-sm">
                <img class="img-fluid" src="https://frro.cvg.utn.edu.ar/pluginfile.php/1/theme_snap/coverimage/1565009858/site-image.png" alt="utn cabecera de inicio">    
            </div>
            
        </div>
    </div>

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
                            <h1 class="card-title">¡Hola
                                @if(Auth::check())    
                                {{Auth::user()->first_name}}       
                                @endif!</h1>
                            <p class="card-text">Estudiante de Ingeniería en Sistemas de Información</p>
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



                <div class="row justify-content-center">
                    <a href="{{route('user.index')}}" class="btn btn-primary m-2">Usuarios</a>
                    <a href="{{route('users.search_teacher')}}" class="btn btn-primary m-2">Docentes</a>
                    <a href="{{route('subject.index')}}" class="btn btn-primary m-2">Materias</a>                    
                    
                    @if(Auth::check())
                        @if(Auth::user()->type =='admin')
                            <a href="{{route('meetings.list')}}" class="btn btn-primary m-2">Consultas</a>      
                        @endif
                        @if(Auth::user()->type =='teacher')
                            <a href="{{route('meetings.my_meetings')}}" class="btn btn-primary m-2">Mis consultas</a>      
                        @endif
                        @if(Auth::user()->type =='student')
                        <a href="{{route('inscriptions_user.list')}}" class="btn btn-primary m-2">Mis inscripciones a consultas</a>
                        @endif

                  
                    @endif
                    

                    @if (Auth::check())
                        <a href="{{route('subjects_user.index', Auth::user()->id)}}" class="btn btn-primary m-2">Mis inscripciones a materias</a> 
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
@endsection
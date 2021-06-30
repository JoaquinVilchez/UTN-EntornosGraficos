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

                @if(Auth::check())
                    @if(Auth::user()->type == 'student')

                        @php
                            $user = Auth::user();
                            $counter = 1;
                            
                        @endphp

                        <div class="col-12">
                            <div class="row d-flex align-items-center justify-content-between pb-2">
                                <h1>Mis próximas consultas</h1>
                                <div>
                                    <a href="{{route('inscriptions_user.list')}}" class="btn btn-primary">Ver inscripciones</a>
                                </div>
                            </div>           
        
                            <div class="col">
                                <div class="row justify-content-around">
                                    
                                    @foreach ($next_inscriptions as $inscription)
        
                                        <div class="card mb-4" style="width: 25rem;
                                        @if ($inscription->status == 'canceled')
                                            background-color: lightgray;
                                        @endif
                                        ">
                                            <div class="card-body">
                                                <div class="d-flex border-bottom mb-3 justify-content-center align-items-center">
                                                    <div class="col justify-content-center">
                                                        <img style="height: 10rem;" src="https://www.gammaingenieros.com/wp-content/uploads/2017/07/400x400-300x300.gif" alt="Card image cap">
                                                        <div class="d-flex justify-content-around mt-2">
                                                            <button 
                                                                @if ($inscription->status == 'canceled')
                                                                    disabled
                                                                @endif                                                                                                           
                                                            
                                                            href="mailto:{{$inscription->meeting->teacher->email}}" class="btn btn-dark">Email</button>
                                                            
                                                            @if ($inscription->meeting->type == 'virtual')
                                                                <button 
                                                                
                                                                @if ($inscription->status == 'canceled')
                                                                    disabled
                                                                @endif
        
                                                                href="{{$inscription->meeting->meeting_url}}" class="btn btn-dark">Zoom</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-6 mb-2">
                                                        <h5 class="font-weight-bold">Profesor</h5>
                                                        <p class="card-text">{{$inscription->meeting->teacher->getFullName()}}</p>
                                                        <h5 class="font-weight-bold">Cátedra</h5>
                                                        <p class="card-text">{{$inscription->meeting->subject->name}}</p>
                                                        <h5 class="font-weight-bold">Fecha y hora</h5>
        
                                                        @php
                                                            $date = strtotime($inscription->datetime);
                                                        @endphp
                                                        <p class="card-text">{{date('d/m/Y h:i', $date)}}</p>
                                                        <h5 class="font-weight-bold">Reunión</h5>
                                                        <p class="card-text">{{$inscription->meeting->getType()}} 
                                                            @if ($inscription->meeting->type == 'face-to-face')
                                                            - Aula: {{$inscription->meeting->classroom}}                                                        
                                                            @endif
                                                        </p>
        
                                                    </div>
                                                </div>
        
                                                @if($inscription->meeting->status == 'active' && $inscription->status == 'active')
                                                    <div class="d-flex justify-content-center">
                                                        <a href="#" data-toggle="modal" data-target="#deleteModal" data-inscriptionid="{{$inscription->id}}" class="btn btn-dark">Cancelar inscripción</a>
                                                    </div>
                                                @endif
        
                                            </div>
                                        </div>

                                        @php
                                            if ($counter == 2) {
                                                break;
                                            }

                                            $counter++;

                                            
                                        @endphp
                                        
                                    @endforeach
        
                                    @if ($next_inscriptions->first() == false)
                                        <p>No se encuentra inscripto a futuras consultas.</p>
                                    @endif
                                    
                                </div>
                            </div>
        
                        </div>
               
                        
                    @endif
                @endif

                <div class="row justify-content-center">
                    <a href="{{route('user.index')}}" class="btn btn-primary m-2">Usuarios</a>
                    <a href="{{route('users.search_teacher')}}" class="btn btn-primary m-2">Docentes</a>
                    <a href="{{route('subject.index')}}" class="btn btn-primary m-2">Materias</a>                    
                    <a href="{{route('inscriptions_user.list')}}" class="btn btn-primary m-2">Mis inscripciones consultas</a>
                    <a href="{{route('meetings.list')}}" class="btn btn-primary m-2">Consultas</a>      
      

                    @if (Auth::check())
                        <a href="{{route('subjects_user.index', Auth::user()->id)}}" class="btn btn-primary m-2">Mis inscripciones a materias</a> 
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
@endsection
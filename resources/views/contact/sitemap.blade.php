@extends('layouts.app')

@section('content')
<div class="container vh-100">
    <div class="row">
        <div class="col-12">
          <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
                <h1>Mapa del sitio</h1>
          </div>
            <div class="col mt-4">
                <div class="d-flex justify-content-center">
                    <h3><a href="{{ url('/') }}">Inicio</a></h3>
                </div>
           
                <div class="row">
                    <div class="col mt-4">
                        <ul>
                            <div class="row">
                                <div class="col mt-2">
                                    <li><a href={{route('contact.about_us')}}>¿Quienes somos?</a></li>
                                    <li><a href={{route('contact.index')}}>Contacto</a></li>
                                </div>

                                @if (Auth::check())
                                @else 
                                    <div class="col mt-6">
                                        <li><a href={{route('login')}}>Login</a></li>
                                        <li><a href={{route('register')}}>Registro</a></li>
                                    </div>
                                @endif
                            </div>
                        </ul>    
                    </div>
            
                    @if (Auth::check())
                    <div class="col mt-4">
                            @if(Auth::user()->type == 'student')
                                <ul>
                                    <li><a href={{route('user.my_user', Auth::user()->id)}}>Mis Datos</a></li>
                                    <li><a href={{route('subjects_user.index', Auth::user()->id)}}>Mis Materias</a>
                                        <ul>
                                            <li><a href={{route('subjects_user.edit', Auth::user()->id)}}>Editar materia</a></li>
                                        </ul>
                                    </li>
                                    <li><a href={{route('inscriptions_user.list')}}>Mis Consultas</a></li>
                                        <ul>
                                            <li><a href={{route('inscriptions_user.create')}}>Nueva Inscripción a Consulta</a></li>
                                        </ul>
                                    </li>
                                    
                                    <li><a href={{route('users.search_teacher')}}>Docentes</a></li>
                                </ul>
                            @endif

                            @if(Auth::user()->type == 'teacher')
                                <ul>
                                    <li><a href={{route('user.my_user', Auth::user()->id)}}>Mis Datos</a></li>
                                    <li><a href={{route('subjects_user.index', Auth::user()->id)}}>Mis Materias</a>
                                        <ul>
                                            <li><a href={{route('subjects_user.edit', Auth::user()->id)}}>Editar materia</a></li>
                                        </ul>
                                    </li>
                                    <li><a href={{route('meetings.my_meetings')}}>Mis Consultas</a></li>
                                        <ul>
                                            <li><a href={{route('meetings.history')}}>Historial consultas</a></li>
                                        </ul>
                                    </li>
                                    <li><a href={{route('meetings.create_for_teacher')}}>Crear Consulta</a></li>
                                    <li><a href={{route('users.search_teacher')}}>Docentes</a></li>
                                </ul>
                            @endif

                            @if(Auth::user()->type == 'admin')
                                <ul>
                                    <li><a href={{route('user.my_user', Auth::user()->id)}}>Mis Datos</a></li>
                                    <li><a href={{route('user.index', Auth::user()->id)}}>Usuarios</a>
                                        <ul>
                                            <li><a href={{route('user.create', Auth::user()->id)}}>Nuevo usuario</a></li>
                                        </ul>
                                    </li>
                                    <li><a href={{route('subject.index', Auth::user()->id)}}>Materias</a></li>
                                        <ul>
                                            <li><a href={{route('subject.create', Auth::user()->id)}}>Nueva materia</a></li>
                                        </ul>
                                    </li>
                                    <li><a href={{route('meetings.list')}}>Consultas</a></li>
                                        <ul>
                                            <li><a href={{route('meetings.create')}}>Crear consulta</a></li>
                                        </ul>
                                    </li>
                                    <li><a href={{route('users.search_teacher')}}>Docentes</a></li>
                                </ul>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
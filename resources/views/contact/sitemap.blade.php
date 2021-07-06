@extends('layouts.app')

@section('content')
<div class="container vh-100">
    <div class="row">
        <div class="col-12">
          <div class="row d-flex align-items-center justify-content-between border-bottom pb-2">
                <h1>Mapa del sitio</h1>
          </div>
            <div class="col mt-4">
                <h3>Inicio</h3>
                <ul>
                    <li><a href={{route('contact.about_us')}}>¿Quienes somos?</a></li>
                    <li><a href={{route('contact.index')}}>Contacto</a></li>
                    @if (Auth::check())
                    @else 
                        <li><a href={{route('login')}}>Login</a></li>
                        <li><a href={{route('register')}}>Registro</a></li>
                    @endif
                </ul>

                @if (Auth::check())
                    @if(Auth::user()->type == 'student')
                        <h3>Sitios Estudiante</h3>
                        <ul>
                            <li><a href={{route('subjects_user.index', Auth::user()->id)}}>Mis Datos</a></li>
                            <li><a href={{route('subjects_user.index', Auth::user()->id)}}>Mis Materias</a></li>
                            <li><a href={{route('inscriptions_user.list')}}>Mis Consultas</a></li>
                            <li><a href={{route('inscriptions_user.create')}}>Nueva Inscripción a Consulta</a></li>
                            <li><a href={{route('users.search_teacher')}}>Docentes</a></li>
                        </ul>
                    @endif

                    @if(Auth::user()->type == 'teacher')
                        <h3>Sitios Docente</h3>
                        <ul>
                            <li><a href={{route('user.my_user', Auth::user()->id)}}>Mis Datos</a></li>
                            <li><a href={{route('subjects_user.index', Auth::user()->id)}}>Mis Materias</a></li>
                            <li><a href={{route('meetings.my_meetings')}}>Mis Consultas</a></li>
                            <li><a href={{route('meetings.history')}}>Historial consultas</a></li>
                            <li><a href={{route('meetings.create_for_teacher')}}>Crear Consulta</a></li>
                            <li><a href={{route('users.search_teacher')}}>Docentes</a></li>
                        </ul>
                    @endif

                    @if(Auth::user()->type == 'admin')
                        <h3>Sitios Administrador</h3>
                        <ul>
                            <li><a href={{route('user.my_user', Auth::user()->id)}}>Mis Datos</a></li>
                            <li><a href={{route('user.index', Auth::user()->id)}}>Usuarios</a></li>
                            <li><a href={{route('subject.index', Auth::user()->id)}}>Materias</a></li>
                            <li><a href={{route('meetings.list')}}>Consultas</a></li>
                            <li><a href={{route('meetings.create')}}>Crear consulta</a></li>
                            <li><a href={{route('users.search_teacher')}}>Docentes</a></li>
                        </ul>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
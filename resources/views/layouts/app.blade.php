<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles --> 
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  

    {{-- Bootstrap Select --}}
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-es_ES.min.js"></script>

    {{-- Font Awesome --}}
    <script src="https://kit.fontawesome.com/e739f5c7c6.js" crossorigin="anonymous"></script>

    {{-- Cleave --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js" integrity="sha512-KaIyHb30iXTXfGyI9cyKFUIRSSuekJt6/vqXtyQKhQP6ozZEGY8nOtRS6fExqE4+RbYHus2yGyYg1BrqxzV6YA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('css-script')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark text-white">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav mr-auto">
                        
                        @if (Auth::check())

                            <!-- Student view-->
                            @if(Auth::user()->type == 'student')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('subjects_user.index', Auth::user()->id)}}">Mis materias</a>
                                </li>
        
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('inscriptions_user.list')}}">Mis consultas</a>
                                </li>
                                
                            @endif


                            <!-- Teacher view-->
                            @if(Auth::user()->type == 'teacher')
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('subjects_user.index', Auth::user()->id)}}">Mis materias</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('meetings.my_meetings')}}">Mis consultas</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('meetings.create_for_teacher')}}">Crear consulta</a>
                            </li>
    
                            @endif

                            @if(Auth::user()->type == 'admin')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.index')}}">Usuarios</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('subject.index')}}">Materias</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('meetings.list')}}">Consultas</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('meetings.create')}}">Crear consulta</a>
                                </li>

                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{route('users.search_teacher')}}">Docentes</a>
                            </li>

                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    
                                    <a class="dropdown-item" href="{{ route('user.my_user', Auth::user()->id) }}">
                                     Mis datos
                                    </a>
                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Cerrar sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                    
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="my-5 scrollable-body" style="height: 100vh; ">
            @yield('content')
        </main>

        <footer class="w-100  bg-dark text-white pt-5 pb-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 footers-one ">
                        <h5 class="text-uppercase">Puede interesarte:</h5>
                
                        <ul class="list-unstyled d-flex justify-content-start">
                            <li>
                                <a class="mr-3 text-light"  href="{{ route('contact.about_us') }}">¿Quienes somos?</a>
                            </li>
                            <li>
                                <a class="mr-3 text-light" href="{{ route('contact.index') }}">Contacto</a>
                            </li>
                            <li>
                                <a class="mr-3 text-light" href="#">Mapa del sitio</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    @yield('js-script')
</body>
</html>

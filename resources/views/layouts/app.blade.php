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

    <!-- Icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

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
    <div id="app" class="animate">
        <nav class="navbar navbar-expand-md navbar-dark bg-dark text-white">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <span class="navbar-toggler-icon leftmenutrigger"></span>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarText">
                            <ul class="navbar-nav animate side-nav">
                            <li class="nav-item m-2 border-bottom border-secondary">
                                <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                            </li>
                            <li class="nav-item m-2 border-bottom border-secondary">
                                <a class="nav-link" href="{{ url('/mis-inscripciones') }}">Mis inscripciones a consultas</a>
                            </li>
                            <li class="nav-item m-2 border-bottom border-secondary">
                                <a class="nav-link" href="{{ url('/materias') }}">Materias</a>
                            </li>
                            </ul>
                        </div>
            
                    
            
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </ul>
                </div>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto align-items-center">
                <!-- Notification -->
                <li class="nav-item dropdown align-items-center">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <ion-icon name="notifications-circle-outline" size="large"></ion-icon>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" 
                            onclick="event.preventDefault()"
                        >

                            <div>
                                Notificación 1
                            </div>
                        </a>
                    </div>
                </li>           
                    
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
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                >
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </nav>

        <div id="wrapper">
            <main class="my-5 scrollable-body" style="height: 100vh;">
                @yield('content')
            </main>
        </div>

        <footer class="w-100  bg-dark text-white pt-5 pb-3"  style="z-index:1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-4 footers-one ">
                        <h5 class="text-uppercase">Puede interesarte:</h5>
                
                        <ul class="list-unstyled d-flex justify-content-start">
                            <li>
                                <a class="mr-3"  href="{{ route('contact.about_us') }}">¿Quienes somos?</a>
                            </li>
                            <li>
                                <a class="mr-3" href="{{ route('contact.index') }}">Contacto</a>
                            </li>
                            <li>
                                <a class="mr-3" href="#">Mapa del sitio</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @section('js-script')
    <script>
        $( document ).ready(function() {
        $('.leftmenutrigger').on('click', function(e) {
        $('.side-nav').toggleClass("open");
        e.preventDefault();
        });
        });
    </script>
    @endsection
    @yield('js-script')
</body>
</html>

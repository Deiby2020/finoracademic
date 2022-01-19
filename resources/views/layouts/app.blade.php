<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@hasSection('title') @yield('title') | @endif {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	 @livewireStyles
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    <?php 
                        $auth = Auth::user();
                        $est = new App\Models\Estudiante();
                        $estudiante = null;
                        if ( $auth != null ) {
                            $estudiante = $est->where( 'fkid_usuario', '=', $auth->id )->first();
                        }
                    ?>

					@auth()
                        @if ( $estudiante == null ) 
                            <ul class="navbar-nav mr-auto">
                                <!--Nav Bar Hooks - Do not delete!!-->
                                <li class="nav-item">
                                    <a href="{{ url('/inscripciones') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Inscripciones</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/maestro_ofertas') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Maestro_ofertas</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/aulas') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Aulas</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/modulos') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Modulos</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/horarios') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Horarios</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/docentes') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Docentes</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/estudiantes') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Estudiantes</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/materias') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Materias</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/grupos') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Grupos</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/gestiones') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Gestiones</a> 
                                </li>
                                
                                {{-- <li class="nav-item">
                                    <a href="{{ url('/cuentas') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Cuentas</a> 
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/clientes') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Clientes</a> 
                                </li> --}}
                            </ul>
                        @else
                        <ul class="navbar-nav mr-auto">
                            <!--Nav Bar Hooks - Do not delete!!-->
                            <li class="nav-item">
                                <a href="{{ url('/inscripciones') }}" class="nav-link"><i class="fab fa-laravel text-info"></i> Inscripciones</a> 
                            </li>
                        </ul>
                        @endif
					@endauth()
					
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Acceder') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                                <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
            </div>
        </nav>

        <main class="py-2">
            @yield('content')
        </main>
    </div>
    @livewireScripts
<script type="text/javascript">
	window.livewire.on('closeModal', () => {
		$('#exampleModal').modal('hide');
	});
</script>
</body>
</html>
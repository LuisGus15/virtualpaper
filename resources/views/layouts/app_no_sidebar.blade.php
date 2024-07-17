<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    @if(session('theme') == 'joven')
        <link rel="stylesheet" href="{{ asset('css/joven.css') }}">
    @elseif(session('theme') == 'nino')
        <link rel="stylesheet" href="{{ asset('css/nino.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/adulto.css') }}">
    @endif
</head>
<body>
    <div id="app">
        <div class="navbar">
            <div class="navbar-left">
                <a href="{{ url('/') }}">Virtual Papers</a>
                <a href="{{ url('/') }}" class="nav-link">Inicio</a>
            </div>
            <div class="navbar-right">
                <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                <a href="#" 
                   onclick="event.preventDefault(); 
                            document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Cerrar sesión
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <!-- Dropdown for theme selection -->
                <div class="dropdown theme-selector">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="themeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Seleccionar Tema
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="themeDropdown">
                        <a class="dropdown-item" href="{{ route('changeTheme', 'adulto') }}">Adulto</a>
                        <a class="dropdown-item" href="{{ route('changeTheme', 'joven') }}">Joven</a>
                        <a class="dropdown-item" href="{{ route('changeTheme', 'nino') }}">Niño</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar">
            <div class="user-info">
                <strong>{{ Auth::user()->nombre }}</strong>
                <p>{{ Auth::user()->apellido }}</p>
            </div>
            <a href="{{ route('cliente.ventas.index') }}">Compras</a>
            <a href="{{ route('cliente.cotizaciones.index') }}">Cotizaciones de perfil</a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
        <div class="content">
            <main>
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Virtual Papers</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMcRRs1CZp3J4lvQ4Xoj0Y2v1e4t4n/NBO0/lRI" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @if(session('theme') == 'joven')
        <link rel="stylesheet" href="{{ asset('css/joven.css') }}">
    @elseif(session('theme') == 'nino')
        <link rel="stylesheet" href="{{ asset('css/nino.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/adulto.css') }}">
    @endif
</head>
<body>
    <div class="navbar">
        <div class="navbar-left">
            <a href="{{ url('/') }}">Virtual Papers</a>
            <a href="{{ url('/') }}" class="nav-link">Inicio</a>
        </div>
        <div class="navbar-right">
            <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
            <a href="{{ route('logout') }}" 
               onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
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
        <nav>
            <a href="{{ url('/usuarios') }}" class="nav-link">Usuario</a>
            <a href="{{ url('/categoria') }}" class="nav-link">Categoría</a>
            <a href="{{ url('/producto') }}" class="nav-link">Producto</a>
            <a href="{{ url('/inventario') }}" class="nav-link">Inventario</a>
            <a href="{{ url('/promociones') }}" class="nav-link">Promociones</a>
            <a href="{{ url('/cotizaciones') }}" class="nav-link">Cotizaciones</a>
            <a href="{{ url('/ventas') }}" class="nav-link">Ventas</a>
            <a href="{{ url('/pago') }}" class="nav-link">Pago</a>
            <a href="{{ url('/estadistica') }}" class="nav-link">Estadística</a>
        </nav>
    </div>
    <div class="content">
        @yield('content')
    </div>
</body>
</html>

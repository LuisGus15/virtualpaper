<!DOCTYPE html>
<html>
<head>
    <title>Virtual Papers</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
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

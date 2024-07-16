<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="sidebar">
            <div class="user-info">
                <strong>{{ Auth::user()->nombre }}</strong>
                <p>{{ Auth::user()->apellido }}</p>
            </div>
            <a href="{{ route('cliente.ventas.index') }}">Ventas</a>
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

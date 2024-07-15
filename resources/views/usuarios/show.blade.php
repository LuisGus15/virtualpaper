<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
</head>
<body>
    <div class="container detalle-usuario-container">
        <h1>Detalle del Usuario</h1>
        <div class="user-detail">
            <p><strong>Nombre:</strong> {{ $usuario->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $usuario->apellido }}</p>
            <p><strong>Correo:</strong> {{ $usuario->correo }}</p>
            <p><strong>Edad:</strong> {{ $usuario->edad }}</p>
            <p><strong>Celular:</strong> {{ $usuario->celular }}</p>
            <p><strong>Sexo:</strong> {{ $usuario->sexo }}</p>
            <p><strong>Rol:</strong> {{ $usuario->rol }}</p>
        </div>
    </div>
</body>
</html>

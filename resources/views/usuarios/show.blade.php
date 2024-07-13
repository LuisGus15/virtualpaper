<!DOCTYPE html>
<html>
<head>
    <title>Usuario</title>
</head>
<body>
    <h1>Detalle del Usuario</h1>
    <p>Nombre: {{ $usuario->nombre }}</p>
    <p>Apellido: {{ $usuario->apellido }}</p>
    <p>Correo: {{ $usuario->correo }}</p>
    <p>Edad: {{ $usuario->edad }}</p>
    <p>Celular: {{ $usuario->celular }}</p>
    <p>Sexo: {{ $usuario->sexo }}</p>
    <p>Rol: {{ $usuario->rol }}</p>
</body>
</html>

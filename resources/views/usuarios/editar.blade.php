<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
</head>
<body>
    <h1>Editar Usuario</h1>
    <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}">
        @csrf
        @method('PATCH')
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ $usuario->nombre }}" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" value="{{ $usuario->apellido }}" required>
        <br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" value="{{ $usuario->correo }}" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena">
        <br>
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" value="{{ $usuario->edad }}" required>
        <br>
        <label for="celular">Celular:</label>
        <input type="text" name="celular" id="celular" value="{{ $usuario->celular }}" required>
        <br>
        <label for="sexo">Sexo:</label>
        <input type="text" name="sexo" id="sexo" value="{{ $usuario->sexo }}" required>
        <br>
        <label for="rol">Rol:</label>
        <input type="text" name="rol" id="rol" value="{{ $usuario->rol }}" required>
        <br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>

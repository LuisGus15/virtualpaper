<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
</head>
<body>
    <h1>Crear Usuario</h1>
    <form method="POST" action="{{ route('usuarios.store') }}">
        @csrf
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>
        <label for="apellido">Apellido:</label>
        <input type="text" name="apellido" id="apellido" required>
        <br>
        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required>
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" required>
        <br>
        <label for="edad">Edad:</label>
        <input type="number" name="edad" id="edad" required>
        <br>
        <label for="celular">Celular:</label>
        <input type="text" name="celular" id="celular" required>
        <br>
        <label for="sexo">Sexo:</label>
        <input type="text" name="sexo" id="sexo" required>
        <br>
        <label for="rol">Rol:</label>
        <input type="text" name="rol" id="rol" required>
        <br>
        <button type="submit">Guardar</button>
    </form>
</body>
</html>

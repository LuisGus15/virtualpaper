<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
</head>
<body>
    <div class="container crear-usuario-container">
        <h1>Crear Usuario</h1>
        <form method="POST" action="{{ route('usuarios.store') }}" class="user-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" name="edad" id="edad" required>
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" id="celular" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <input type="text" name="sexo" id="sexo" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <input type="text" name="rol" id="rol" required>
                </div>
            </div>
            <button type="submit" class="btn">Guardar</button>
        </form>
    </div>
    <div class="footer">
        <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
    </div>
</body>
</html>

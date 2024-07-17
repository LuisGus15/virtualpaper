<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/usuarios.css') }}">
</head>
<body>
    <div class="container editar-usuario-container">
        <h1>Editar Usuario</h1>
        <form method="POST" action="{{ route('usuarios.update', $usuario->id) }}" class="user-form">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="{{ $usuario->nombre }}" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" value="{{ $usuario->apellido }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="correo">Correo:</label>
                    <input type="email" name="correo" id="correo" value="{{ $usuario->correo }}" required>
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" name="edad" id="edad" value="{{ $usuario->edad }}" required>
                </div>
                <div class="form-group">
                    <label for="celular">Celular:</label>
                    <input type="text" name="celular" id="celular" value="{{ $usuario->celular }}" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="sexo">Sexo:</label>
                    <input type="text" name="sexo" id="sexo" value="{{ $usuario->sexo }}" required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol:</label>
                    <input type="text" name="rol" id="rol" value="{{ $usuario->rol }}" required>
                </div>
            </div>
            <button type="submit" class="btn">Actualizar</button>
        </form>
    </div>
    <div class="footer">
        <p>Esta vista ha sido visitada {{ $pageViews->where('route_name', \Request::route()->getName())->first()->views ?? 0 }} veces.</p>
    </div>
</body>
</html>

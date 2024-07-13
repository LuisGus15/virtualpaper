<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="contrasena_confirmation">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena_confirmation" name="contrasena_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label for="edad">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="celular">Celular:</label>
                        <input type="text" class="form-control" id="celular" name="celular" required>
                    </div>
                    <div class="form-group">
                        <label for="sexo">Sexo:</label>
                        <input type="text" class="form-control" id="sexo" name="sexo" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="rol">Rol:</label>
                        <input type="text" class="form-control" id="rol" name="rol" required>
                    </div>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>
    </div>
</body>

</html>

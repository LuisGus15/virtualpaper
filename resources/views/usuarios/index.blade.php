<!DOCTYPE html>
<html>
<head>
    <title>Usuarios</title>
</head>
<body>
    <h1>Lista de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}">Crear Usuario</a>
    @if(session()->get('success'))
        <div>
            {{ session()->get('success') }}
        </div>
    @endif
    <ul>
        @foreach ($usuarios as $usuario)
            <li>{{ $usuario->nombre }} {{ $usuario->apellido }}
                <a href="{{ route('usuarios.show', $usuario->id) }}">Ver</a>
                <a href="{{ route('usuarios.edit', $usuario->id) }}">Editar</a>
                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>

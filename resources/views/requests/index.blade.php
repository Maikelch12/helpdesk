<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>HelpDesk - Solicitudes</title>
    <link rel="stylesheet" href="{{ asset('css/requests/index.css') }}">
</head>

<body>

    <h1>HelpDesk - Solicitudes de soporte</h1>

    @if(session('success'))
        <p>
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('requests.create') }}">
        Nueva solicitud
    </a>

    <hr>

    <h2>Filtrar solicitudes</h2>

    <form method="GET" action="{{ route('requests.index') }}">

        <label for="status">
            Estado:
        </label>

        <select name="status" id="status">

            <option value="">
                Todos
            </option>

            <option value="pending"
                {{ request('status') == 'pending' ? 'selected' : '' }}>
                Pendiente
            </option>

            <option value="in_progress"
                {{ request('status') == 'in_progress' ? 'selected' : '' }}>
                En progreso
            </option>

            <option value="resolved"
                {{ request('status') == 'resolved' ? 'selected' : '' }}>
                Resuelto
            </option>

        </select>

        <button type="submit">
            Filtrar
        </button>

    </form>

    <hr>

    <h2>Solicitudes registradas</h2>

    <table border="1">

        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Categoría</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse($requests as $request)

                <tr>

                    <td>
                        {{ $request->id }}
                    </td>

                    <td>
                        {{ $request->title }}
                    </td>

                    <td>
                        {{ $request->category->name }}
                    </td>

                    <td>
                        {{ $request->status }}
                    </td>

                    <td>
                        {{ $request->created_at }}
                    </td>

                    <td>

                        <a href="{{ route('requests.edit', $request) }}">
                            Editar
                        </a>

                        <form
                            method="POST"
                            action="{{ route('requests.destroy', $request) }}"
                            style="display:inline;"
                        >

                            @csrf

                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="6">
                        No hay solicitudes registradas.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>
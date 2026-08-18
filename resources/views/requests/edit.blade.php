<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HelpDesk - Editar solicitud</title>
</head>
<body>

<h1>HelpDesk</h1>
<h2>Editar solicitud</h2>

<a href="{{ route('requests.index') }}">Volver a solicitudes</a>

<hr>

@if ($errors->any())
<div>
    <strong>Se encontraron los siguientes errores:</strong>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form method="POST" action="{{ route('requests.update', $supportRequest) }}">
@csrf
@method('PUT')

<div>
    <label for="title">Título:</label><br>
    <input type="text" id="title" name="title" value="{{ old('title', $supportRequest->title) }}">
</div>

<br>

<div>
    <label for="description">Descripción:</label><br>
    <textarea id="description" name="description" rows="5" cols="50">{{ old('description', $supportRequest->description) }}</textarea>
</div>

<br>

<div>
    <label for="category_id">Categoría:</label><br>
    <select name="category_id" id="category_id">
        <option value="">Seleccione una categoría</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id', $supportRequest->category_id) == $category->id ? 'selected' : '' }}>
            {{ $category->name }}
        </option>
        @endforeach
    </select>
</div>

<br>

<div>
    <label for="status">Estado:</label><br>
    <select name="status" id="status">
        <option value="">Seleccione un estado</option>
        <option value="pending" {{ old('status', $supportRequest->status) == 'pending' ? 'selected' : '' }}>Pendiente</option>
        <option value="in_progress" {{ old('status', $supportRequest->status) == 'in_progress' ? 'selected' : '' }}>En progreso</option>
        <option value="resolved" {{ old('status', $supportRequest->status) == 'resolved' ? 'selected' : '' }}>Resuelto</option>
    </select>
</div>

<br>

<button type="submit">Actualizar solicitud</button>

</form>

</body>
</html>
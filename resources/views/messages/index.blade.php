<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Mensajes</title>
</head>
<body>
    <h1>Listado de Mensajes</h1>
    <a href="{{ route('messages.create') }}">Crear nuevo mensaje</a>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($messages->isEmpty())
        <p>No hay mensajes.</p>
    @else
        <form action="{{ route('messages.destroyMultiple') }}" method="POST">
            @csrf
            @method('DELETE')
            <table border="1" cellpadding="5">
                <thead>
                    <tr>
                        <th>Seleccionar</th>
                        <th>Texto</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($messages as $message)
                        
                        <tr>
                            <td><input type="checkbox" name="messages[]" value="{{ $message->id }}"></td>
                            <td>{{ $message->text }}</td>
                            <td>
                                @if($message->imagen)
                                    <img src="{{ $message->imagen }}" alt="Imagen del mensaje" width="50">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('messages.edit', $message->id) }}">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit">Eliminar seleccionados</button>
        </form>
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Mensaje</title>
</head>
<body>
    <h1>Crear Mensaje</h1>

    @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('messages.store') }}" method="POST">
        @csrf
        <div>
            <label>Texto: </label>
            <input type="text" name="text" value="{{ old('text') }}">
        </div>


        <div>
            <label>Imagen (URL): </label>
            <input type="text" name="imagen" value="{{ old('imagen') }}">
        </div>

        <button type="submit">Guardar</button>
        <a href="{{ route('messages.index') }}">Volver al listado</a>
    </form>
</body>
</html>


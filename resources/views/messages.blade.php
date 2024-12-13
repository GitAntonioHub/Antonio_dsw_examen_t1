<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Estilos básicos para que el formulario se oculte inicialmente */
        .edit-form {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prueba superada</h1>
        @if($messages->isEmpty())
            <p>No hay mensajes en la base de datos</p>
        @else
            <ul>
                @foreach($messages as $message)
                    

                    <li style="{{ $estilo }}">
                        {{ $message->text }}
                        <button type="button" onclick="toggleForm({{ $message->id }})">Editar</button>
                        
                        <!-- Formulario oculto para editar el mensaje -->
                        <div id="form-{{ $message->id }}" class="edit-form">
                            <form action="{{ route('messages.update', $message->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div>
                                    <label for="text-{{ $message->id }}">Texto:</label>
                                    <input type="text" name="text" id="text-{{ $message->id }}" value="{{ $message->text }}">
                                </div>

                                

                                

                                <button type="submit">Guardar cambios</button>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
    <script>
        function toggleForm(messageId) {
            const form = document.getElementById('form-' + messageId);
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</body>
</html>

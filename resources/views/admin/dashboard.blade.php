<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-dashboard</title>

    <script>
      function confirmDelete(event)
      {
        if (!confirm("¿Estás seguro de que deseas eliminar esta nota?"))
        {
          event.preventDefault(); // Cancela la eliminación si el usuario cancela
        }
      }
    </script>

</head>

<body>

  @extends('adminlte::page')
  @section('title', 'Admin Dashboard')
  @section('content_header')
    <h1>Admin Dashboard</h1>
  @endsection
  @section('content')
    <p>Bienvenido al panel de administración.</p>
  @endsection
</body>
<html
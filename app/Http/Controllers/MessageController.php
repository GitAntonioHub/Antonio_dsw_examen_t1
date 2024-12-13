<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Mostrar lista de mensajes
    public function index()
    {
        $filePath = storage_path('app/mensajes.csv');
        $messages = [];

        if (file_exists($filePath)) {
            $file = fopen($filePath, 'r');
            $headers = fgetcsv($file); // leer encabezados
            
            while (($data = fgetcsv($file)) !== false) {
                $messages[] = [
                    'text' => $data[0],
                    'imagen' => $data[1],
                ];
            }
            fclose($file);
        }

        $messages = Message::all();
        return view('messages.index', compact('messages'));
    }

    // Mostrar formulario para crear un nuevo mensaje
    public function create()
    {
        $coloresPermitidos = ['red', 'blue', 'black', 'green'];

        return view('messages.create', compact('coloresPermitidos'));
    }

    // Guardar el mensaje en la BD
    public function store(Request $request)
    {


        // Validación
        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'imagen' => 'nullable|url',
        ], );

        if ($request->hasFile('imagen')) {
            $trainer->imagen = $request->file('imagen')->store('img', 'public');
        }


        // Ruta del archivo CSV
        $filePath = storage_path('app/mensajes.csv');

        // Verificar si el archivo existe, si no, crearlo con encabezados
        $isNewFile = !file_exists($filePath);
        $file = fopen($filePath, 'a'); // 'a' para append (agregar al final del archivo)

        if ($isNewFile) {
            // Escribir encabezados
            fputcsv($file, ['text', 'imagen']);
        }

        // Escribir el registro
        fputcsv($file, [
            $validated['text'],
            $validated['imagen'] ?? ''
        ]);

        fclose($file);

            Message::create($validated);

            return redirect()->route('messages.index')->with('success', 'Mensaje creado con éxito');
    }

    // Mostrar formulario para editar un mensaje existente
    public function edit(Message $message)
    {
       

        return view('messages.edit', compact('message'));
    }

    // Actualizar un mensaje existente
    public function update(Request $request, Message $message)
    {

        $validated = $request->validate([
            'text' => 'required|string|max:255',
            
            'imagen' => 'nullable|url',
        ], );

        if ($request->hasFile('imagen')) {
            $trainer->imagen = $request->file('imagen')->store('img', 'public');
        }

        $message->update($validated);

        return redirect()->route('messages.index')->with('success', 'Mensaje actualizado con éxito');
    }

    // Borrado múltiple
    public function destroyMultiple(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'messages.*' => 'exists:messages,id'
        ]);

        Message::whereIn('id', $request->messages)->delete();

        return redirect()->route('messages.index')->with('success', 'Mensajes eliminados con éxito');
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Método para mostrar el formulario de creación de un nuevo post
    public function create()
    {
        return view('posts.createPost');
    }

    // Método para almacenar un nuevo post en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'texto' => 'required|max:250',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
        ]);

        // Crear un nuevo post
        $post = new Post();
        $post->texto = $request->texto;

        // Obtener el user_id del usuario autenticado y asignarlo al post
        $post->user_id = auth()->id();


        // Manejar la subida de imágenes si existe
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('public/imagenes');
            $post->imagen_url = str_replace('public/', 'storage/', $imagenPath);
        }

        // Guardar la URL del video si existe
        $post->video_url = $request->video_url;

        // Guardar el post en la base de datos
        $post->save();

        // Redirigir de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Post creado correctamente.');
    }
}

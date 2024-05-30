<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;

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
    $request->validate([
        'texto' => 'required|max:250',
        'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'video_url' => 'nullable|url',
    ]);

    $post = new Post();
    $post->texto = $request->texto;
    $post->user_id = auth()->id();

    if ($request->hasFile('imagen')) {
        $imagenPath = $request->file('imagen')->store('public/imagenes');
        $post->imagen_url = str_replace('public/', 'storage/', $imagenPath);
    }

    $post->video_url = $request->video_url;

    if ($request->has('group_id')) {
        $post->group_id = $request->input('group_id');
    }

    $post->save();

    return redirect()->back()->with('success', 'Post creado correctamente.');
}

    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }



    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $request->validate([
            'texto' => 'required|max:250',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
        ]);

        $post->texto = $request->texto;

        // Actualizar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('public/imagenes');
            $post->imagen_url = str_replace('public/', 'storage/', $imagenPath);
        }

        $post->video_url = $request->video_url;

        $post->save();

        return redirect()->route('perfil')->with('success', 'Post actualizado correctamente.');
    }

    // Método para eliminar un post de la base de datos
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('perfil')->with('success', 'Post eliminado correctamente.');
    }


    public function confirmDelete($id)
    {
        $post = Post::find($id);
        return view('posts.confirmDelete', compact('post'));
    }
}

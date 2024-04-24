<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function mostrarPerfil()
    {
        $usuario = auth()->user();
        $posts = Post::where('user_id', $usuario->id)->get();
        return view('perfil', compact('usuario', 'posts'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;


use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function mostrarPerfil()
    {
        $usuario = auth()->user();
        $posts = Post::where('user_id', $usuario->id)->orderBy('created_at', 'desc')->get();
        return view('perfil', compact('usuario', 'posts'));
    }

    public function mostrarPerfilAjeno($username)
    {
        $usuario = User::where('username', $username)->firstOrFail();
        $posts = Post::where('user_id', $usuario->id)->orderBy('created_at', 'desc')->get();
        return view('perfil-ajeno', compact('usuario', 'posts'));
    }
}

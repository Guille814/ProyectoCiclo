<?php
// app/Http/Controllers/CommentController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'user_id' => 'required|exists:users,id',
            'contenido' => 'required|max:255',
        ]);

        $comment = Comment::create($request->all());

        // Retornar datos relevantes para actualizar la UI
        return response()->json([
            'id' => $comment->id,
            'username' => $comment->user->username,
            'profile_picture' => $comment->user->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png'),
            'created_at' => $comment->created_at->diffForHumans(),
            'contenido' => $comment->contenido,
        ]);
    }
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id === auth()->id() || $comment->post->user_id === auth()->id()) {
            $comment->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false, 'message' => 'No tienes permiso para eliminar este comentario'], 403);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost($postId)
    {
        $post = Post::findOrFail($postId);
        $liked = false;

        if (!$post->isLikedBy(Auth::user())) {
            $like = new Like();
            $like->user_id = Auth::id();
            $like->post_id = $post->id;
            $like->save();
            $post->increment('likes_count');
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likesCount' => $post->likes_count
        ]);
    }

    public function unlikePost($postId)
    {
        $post = Post::findOrFail($postId);
        $like = $post->likes()->where('user_id', Auth::id())->first();
        $unliked = false;

        if ($like) {
            $like->delete();
            $post->decrement('likes_count');
            $unliked = true;
        }

        return response()->json([
            'unliked' => $unliked,
            'likesCount' => $post->likes_count
        ]);
    }
}

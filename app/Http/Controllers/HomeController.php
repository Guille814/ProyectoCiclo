<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
            $user = auth()->user();
    
            // Obtener los IDs de los grupos a los que pertenece, sigue o ha creado
            $groupIds = $user->groups->pluck('id')->toArray();
            $followingGroupIds = $user->followingGroups->pluck('id')->toArray();
            $allGroupIds = array_unique(array_merge($groupIds, $followingGroupIds));
    
            // Obtener los posts de esos grupos y de los usuarios que sigue
            $posts = Post::whereIn('group_id', $allGroupIds)
                ->orWhereIn('user_id', $user->following->pluck('id'))
                ->orWhere('user_id', $user->id) // Incluir los posts propios
                ->with(['user', 'group', 'likes', 'comments.user'])
                ->orderBy('created_at', 'desc')
                ->get();
    
            return view('home', compact('posts'));
        }
    }


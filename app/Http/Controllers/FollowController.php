<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;
use App\Events\UserFollowed;

class FollowController extends Controller
{
    public function follow(User $usuario)
    {
        $follower = new Follower();
        $follower->follower_id = auth()->user()->id;
        $follower->follows_id = $usuario->id;
        $follower->save();

        event(new UserFollowed(auth()->user(), $usuario));

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ahora estás siguiendo a ' . $usuario->username,
                'followersCount' => $usuario->followers()->count() 
            ]);
        }

        return back()->with('success', 'Ahora estás siguiendo a ' . $usuario->username);
    }

    public function unfollow(User $usuario)
    {
        $follower = Follower::where('follower_id', auth()->user()->id)
            ->where('follows_id', $usuario->id)
            ->first();

        if ($follower) {
            $follower->delete();
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Has dejado de seguir a ' . $usuario->username,
                    'followersCount' => $usuario->followers()->count() 
                ]);
            }
            return back()->with('success', 'Has dejado de seguir a ' . $usuario->username);
        } else {
            if (request()->ajax()) {
                return response()->json(['error' => true, 'message' => 'No estabas siguiendo a ' . $usuario->username]);
            }
            return back()->with('error', 'No estabas siguiendo a ' . $usuario->username);
        }
    }
}


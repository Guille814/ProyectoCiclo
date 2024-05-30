<?php

namespace App\Http\Controllers;

use App\Notifications\UsuarioSeguido;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follower;

class NotificationController extends Controller
{
    public function sendNotification(Request $request)
    {
        $user = User::find($request->user_id);
        $follower = User::find($request->follower_id);

        $user->notify(new Follower($follower));

        return back()->with('success', 'Notificación enviada exitosamente.');
    }

    public function showNotifications($userId)
    {
        $user = User::find($userId);
        $notifications = $user->notifications;

        return view('notifications.index', compact('notifications'));
    }

    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}

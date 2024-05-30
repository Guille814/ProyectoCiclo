<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatAdmin;
use Illuminate\Support\Facades\Auth;

class ChatAdminController extends Controller
{
    public function create()
    {
        return view('admin.chat.create');
    }
    public function index()
    {
        $messages = ChatAdmin::with('admin')->latest()->paginate(10);
        return view('admin.chat.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $message = new ChatAdmin();
        $message->user_id = auth('admin')->id();  // Asegúrate de que se guarda user_id del admin autenticado
        $message->message = $request->input('message');
        $message->save();

        // Devolver una respuesta JSON para AJAX
        return response()->json([
            'message' => $message->load('admin')
        ]);
    }
}

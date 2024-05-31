<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Group;
use App\Models\Event;

class UserController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('query', $request->input('q'));
        $filter = $request->input('filter', 'usuarios');
        $currentUser = auth()->user();

        if ($filter === 'grupos') {
            $resultados = Group::where('name', 'LIKE', "%$query%")->get();
        } elseif ($filter === 'eventos') {
            $resultados = Event::where('created_by', '<>', $currentUser->id)
                ->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('name', 'LIKE', "%$query%")
                        ->orWhere('description', 'LIKE', "%$query%");
                })
                ->get();
        } else {
            $resultados = User::where(function ($queryBuilder) use ($query, $currentUser) {
                $queryBuilder->where('username', 'LIKE', "%$query%")
                    ->orWhere('nombre', 'LIKE', "%$query%")
                    ->orWhere('apellido', 'LIKE', "%$query%");
            })
                ->where('id', '<>', $currentUser->id) // Excluir al usuario autenticado
                ->get();
        }

        if ($request->ajax()) {
            return response()->json($resultados->map(function ($item) use ($filter) {
                if ($filter === 'grupos') {
                    return [
                        'id' => $item->id,
                        'text' => $item->name,
                    ];
                } elseif ($filter === 'eventos') {
                    return [
                        'id' => $item->id,
                        'text' => $item->name,
                    ];
                } else {
                    return [
                        'id' => $item->id,
                        'text' => $item->username,
                    ];
                }
            }));
        }

        return view('usuarios.lista', compact('resultados', 'filter'));
    }


    public function index()
    {
        $usuarios = User::all(); // O cualquier otra lógica para obtener los usuarios
        return view('admin.users.index', compact('usuarios'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.users.edit', compact('usuario'));
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }

    public function ajustes()
    {
        return view('usuarios.ajustes');
    }

    public function actualizar(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'email' => 'required|email',
            'username' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'spotify_url' => 'nullable|url',
            'soundcloud_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'apple_music_url' => 'nullable|url',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // Actualización de los datos del usuario
        $userData = $request->except('imagen_perfil');
        $user->update($userData);

        if ($request->hasFile('imagen_perfil')) {
            $imagen_perfil = $request->file('imagen_perfil');

            $ruta_imagen = $imagen_perfil->store('profile_pictures', 'public');
            $user->imagen_perfil = 'storage/' . $ruta_imagen;
            $user->save();
        }


        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function enlaces()
    {
        return view('usuarios.enlaces');
    }

    public function actualizarEnlaces(Request $request)
    {
        $user = auth()->user();

        // Validación de los datos
        $request->validate([
            'spotify_url' => 'nullable|url',
            'soundcloud_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'apple_music_url' => 'nullable|url',
        ]);

        // Actualización de los enlaces de redes sociales
        $user->spotify_url = $request->input('spotify_url');
        $user->soundcloud_url = $request->input('soundcloud_url');
        $user->youtube_url = $request->input('youtube_url');
        $user->apple_music_url = $request->input('apple_music_url');
        $user->save();

        // Redireccionar al perfil del usuario con un mensaje de éxito
        return redirect()->route('perfil')->with('success', 'Enlaces de redes sociales actualizados correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validación de los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'biografia' => 'nullable|string',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Obtener el usuario a actualizar
        $usuario = User::findOrFail($id);

        // Actualización de los datos del usuario
        $userData = $request->except('imagen_perfil'); // Excluye la imagen del arreglo de datos a actualizar
        $usuario->update($userData);

        // Manejar la imagen de perfil si se ha cargado
        if ($request->hasFile('imagen_perfil')) {
            // Obtener el archivo cargado
            $imagen_perfil = $request->file('imagen_perfil');

            // Almacenar la imagen en la ubicación deseada
            $ruta_imagen = $imagen_perfil->store('profile_pictures', 'public');

            // Guardar la ruta de la imagen en la base de datos con la referencia a 'storage/'
            $usuario->imagen_perfil = 'storage/' . $ruta_imagen;
            $usuario->save();
        }

        // Redireccionar al índice de usuarios con un mensaje de éxito
        return redirect()->route('admin.users')->with('success', 'Usuario actualizado correctamente.');
    }
}

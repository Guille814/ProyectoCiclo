<?php

// App\Http\Controllers\GroupController.php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'members' => 'nullable|array',
            'members.*' => 'exists:users,id',
        ]);

        $imagenPerfilPath = $request->file('imagen_perfil') ? $request->file('imagen_perfil')->store('profile_images', 'public') : null;
        $bannerPerfilPath = $request->file('banner_perfil') ? $request->file('banner_perfil')->store('banner_images', 'public') : null;

        $group = new Group([
            'name' => $request->name,
            'biography' => $request->biography,
            'created_by' => auth()->id(),
            'imagen_perfil' => $imagenPerfilPath,
            'banner_perfil' => $bannerPerfilPath,
        ]);

        $group->save();

        $group->members()->attach(auth()->id(), ['role' => 'Creador']);

        if ($request->has('members')) {
            foreach ($request->members as $memberId) {
                $group->members()->attach($memberId, ['role' => 'Miembro']);
            }
        }

        return redirect()->route('groups.index')->with('success', 'Grupo creado exitosamente!');
    }

    public function show(Group $group)
    {
        $group->load('members', 'posts.user', 'posts.likes'); // Cargar relaciones necesarias
        return view('groups.show', compact('group'));
    }

    public function addMember(Request $request, Group $group)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'nullable|string'
        ]);

        $group->members()->attach($request->user_id, ['role' => $request->role]);

        return back()->with('success', 'Miembro añadido exitosamente al grupo!');
    }

    public function index()
    {
        $groups = Auth::user()->groups;
        return view('groups.index', compact('groups'));
    }

    public function edit(Group $group)
    {
        return view('groups.ajustes.edit', compact('group'));
    }

    public function update(Request $request, Group $group)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'imagen_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banner_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'spotify_url' => 'nullable|url',
            'soundcloud_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'apple_music_url' => 'nullable|url',
        ]);

        $group->update($request->all());  // Utiliza la asignación masiva para actualizar el modelo

        return redirect()->route('groups.show', $group->id)->with('success', 'Grupo actualizado exitosamente!');
    }

    // App\Http\Controllers\GroupController.php

    public function editLinks(Group $group)
    {
        // Asegúrate de cargar el grupo con sus enlaces actuales si es necesario
        return view('groups.ajustes.enlaces', compact('group'));
    }

    public function updateLinks(Request $request, Group $group)
    {
        $request->validate([
            'spotify_url' => ['nullable', 'url', 'regex:/^https:\/\/open\.spotify\.com\/.+/'],
            'soundcloud_url' => ['nullable', 'url', 'regex:/^https:\/\/soundcloud\.com\/.+/'],
            'youtube_url' => ['nullable', 'url', 'regex:/^https:\/\/(www\.youtube\.com\/|youtu\.be\/).+/'],
            'apple_music_url' => ['nullable', 'url', 'regex:/^https:\/\/music\.apple\.com\/.+/'],
        ]);

        $group->update($request->only(['spotify_url', 'soundcloud_url', 'youtube_url', 'apple_music_url']));

        return redirect()->route('groups.show', $group->id)->with('success', 'Enlaces de redes sociales actualizados correctamente.');
    }
    public function getMembers(Group $group)
    {
        $members = $group->members->map(function ($member) {
            return [
                'username' => $member->username,  // Ajusta estos campos según tu modelo de datos
                'role' => $member->pivot->role  // Suponiendo que 'role' se guarda en el pivot table
            ];
        });

        return response()->json($members);
    }
    public function lista()
    {
        $groups = Group::all(); // Obtiene todos los grupos
        return view('groups.lista', compact('groups')); // Asegúrate de que esta vista realmente existe
    }

    public function adminIndex()
    {
        $groups = Group::all();
        return view('admin.groups.index', compact('groups'));
    }

    public function adminCreate()
    {
        return view('admin.groups.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'imagen_perfil' => 'nullable|image|max:2048',
            'banner_perfil' => 'nullable|image|max:2048',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->biography = $request->biography;

        if ($request->hasFile('imagen_perfil')) {
            $path = $request->imagen_perfil->store('public/groups');
            $group->imagen_perfil = $path;
        }

        if ($request->hasFile('banner_perfil')) {
            $path = $request->banner_perfil->store('public/groups');
            $group->banner_perfil = $path;
        }

        $group->save();

        return redirect()->route('admin.groups.index')->with('success', 'Grupo creado con éxito.');
    }

    public function adminEdit($id)
    {
        $group = Group::findOrFail($id);
        return view('admin.groups.edit', compact('group'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
            'imagen_perfil' => 'nullable|image|max:2048',
            'banner_perfil' => 'nullable|image|max:2048',
        ]);

        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->biography = $request->biography;

        if ($request->hasFile('imagen_perfil')) {
            $path = $request->imagen_perfil->store('public/groups');
            $group->imagen_perfil = $path;
        }

        if ($request->hasFile('banner_perfil')) {
            $path = $request->banner_perfil->store('public/groups');
            $group->banner_perfil = $path;
        }

        $group->save();

        return redirect()->route('admin.groups.index')->with('success', 'Grupo actualizado con éxito.');
    }

    public function adminDestroy($id)
    {
        $group = Group::findOrFail($id);
        $group->delete();

        return redirect()->route('admin.groups.index')->with('success', 'Grupo eliminado con éxito.');
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->created_by = auth()->id();
        $event->event_date = $request->event_date;
        $event->location = $request->location;

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('events.index')->with('success', 'Evento creado con éxito.');
    }

    public function index(Request $request)
    {
        if ($request->has('from') && $request->input('from') == 'user_menu') {
            // Muestra solo los eventos creados por el usuario
            $events = Event::where('created_by', auth()->user()->id)->get();
        } else {
            // Muestra todos los eventos excepto los creados por el usuario
            $events = Event::where('created_by', '!=', auth()->user()->id)->get();
        }

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $event->load('attendees');
        $isCreator = $event->created_by === auth()->id();
        $isAttending = $event->attendees->contains(auth()->id());

        return view('events.show', compact('event', 'isCreator', 'isAttending'));
    }

    public function attendEvent(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->attendees()->syncWithoutDetaching([auth()->id()]);

        return back()->with('success', 'Te has apuntado al evento.');
    }

    public function leaveEvent(Request $request, $eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->attendees()->detach(auth()->id());

        return back()->with('success', 'Has dejado de asistir al evento.');
    }
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    // Método para actualizar el evento en la base de datos
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $event->name = $request->name;
        $event->description = $request->description;
        $event->event_date = $request->event_date;
        $event->location = $request->location;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/events');
            $event->image = basename($path);
        }

        $event->save();

        return redirect()->route('events.show', $event)->with('success', 'Evento actualizado correctamente.');
    }
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Evento eliminado correctamente.');
    }

    public function indexAdmin()
    {
        $events = Event::all(); // Recuperar todos los eventos
        return view('admin.events.index', compact('events')); // Pasar eventos a la vista
    }
    public function adminEdit($id)
    {
        $event = Event::findOrFail($id); // Asegúrate de que el evento exista
        return view('admin.events.edit', compact('event'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = Event::findOrFail($id);
        $event->name = $request->name;
        $event->description = $request->description;
        $event->event_date = new Carbon($request->event_date);
        $event->location = $request->location;

        if ($request->hasFile('image')) {
            $path = $request->image->store('public/events');
            $event->image = $path;
        }

        $event->save();

        return redirect()->route('admin.events.index')->with('success', 'Evento actualizado con éxito.');
    }
}

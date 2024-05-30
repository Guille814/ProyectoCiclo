@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Imagen del evento con borde redondeado y superposición oscura -->
            <div class="position-relative" style="height: 300px; width: 100%; background-image: url('{{ $event->image ? asset('storage/' . $event->image) : asset('images/default_event_banner.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 10px; overflow: hidden;">
                <div class="position-absolute top-0 left-0 w-100 h-100" style="background-color: rgba(0, 0, 0, 0.5);"></div>
                <div class="position-absolute bottom-0 left-0 p-3 text-white" style="z-index: 1; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">
                    <p class="text mb-0">{{ \Carbon\Carbon::parse($event->event_date)->format('H:i') }} | {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('D [de] MMMM [de] YYYY') }}</p>
                </div>
                <div class="position-absolute top-50 start-50 translate-middle text-center text-white" style="z-index: 1; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">
                    <h1 class="display-4">{{ $event->name }}</h1>
                </div>
                <div class="position-absolute top-0 end-0 m-3 p-2 bg-white text-center" style="width: 70px; height: 75px; border-radius: 10px; z-index: 1;">
                    <p class="mb-0" style="color: black; font-weight: bold; font-size: 1.5rem;">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</p>
                    <p class="mb-0" style="color: black; font-weight: bold; font-size: 0.8rem;">{{ strtoupper(\Carbon\Carbon::parse($event->event_date)->shortMonthName) }}</p>
                </div>
            </div>

            @php
            $isAttending = $event->attendees->contains(auth()->id());
            $isCreator = $event->created_by === auth()->id();
            @endphp

            @if ($isCreator)
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('events.edit', $event) }}" class="btn btn-warning mr-2" style="padding: 10px 20px; border-radius:10px;">Editar Evento</a>
                <form action="{{ route('events.destroy', $event) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="padding: 10px 20px; border-radius:10px;">Eliminar Evento</button>
                </form>
            </div>
            @endif

            @if (!$isCreator)
            <div class="d-flex justify-content-center mt-4">
                @if ($isAttending)
                <form action="{{ route('events.leave', $event) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="padding: 10px 20px; border-radius:10px;">Dejar de ir</button>
                </form>
                @else
                <form action="{{ route('events.attend', $event) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; border-radius:10px;">¡Me apunto!</button>
                </form>
                @endif
            </div>
            @endif

            <!-- Cuadro de información del evento -->
            <div class="card mt-4" style="background-color: #1F2937; border-color: #374151; color: white;">
                <div class="card-body">
                    <p class="mb-3" style="font-size: 1rem;"><strong>Lugar:</strong> {{ ucfirst($event->location) }}</p>
                    <p>{{ $event->description }}</p>
                </div>
            </div>

            <!-- Lista de asistentes -->
            <div class="card mt-4" style="background-color: #1F2937; border-color: #374151; color: white;">
                <div class="card-header">
                    <h4 class="mb-0">{{ __('Asistentes') }}</h4>
                </div>
                <div class="card-body">
                    @if($event->attendees->isEmpty())
                        <p>No hay asistentes confirmados todavía.</p>
                    @else
                        <ul class="list-group list-group-flush" style="background-color: #1F2937; color: white;">
                            @foreach($event->attendees as $attendee)
                                <li class="list-group-item" style="background-color: #1F2937; color: white;">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $attendee->imagen_perfil ? asset('storage/' . $attendee->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div class="ml-3">
                                            <strong>{{ $attendee->username }}</strong>
                                            <p class="mb-0">{{ $attendee->nombre }} {{ $attendee->apellido }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container" style="color: #f8f9fa;">
    <h1 class="text-center" style="color: #ffffff; font-weight: bold;">Eventos</h1>

    @if ($events->isEmpty())
    <div class="text-center">
        <a href="{{ route('events.create') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">+ Nuevo Evento</a>
        <p class="text-muted" style="font-style: italic; color: #ffffff !important; margin-top: 100px;">No hay ningún evento todavía.</p>
    </div>
    @else
    <div class="text-center">
        <a href="{{ route('events.create') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">+ Nuevo Evento</a>
    </div>

    <div class="row justify-content-center">
        @foreach ($events as $event)
            <div class="col-md-4">
                <div class="card mb-3" style="background-color: #2c3e50; border-color: #4e5d6c; color: #ffffff; border-radius: 10px;">
                    @if ($event->image)
                        <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 250px; object-fit: cover; border-radius: 10px 10px 0 0;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title text-center" style="font-weight: bold;">{{ $event->name }}</h5>
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($event->description, 70, '...') }}</p>
                        <p class="card-text" style="color:grey;"><small>Fecha: {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('D [de] MMMM [de] YYYY') }}</small></p>
                        <p class="card-text" style="color:grey;"><small>Lugar: {{ ucfirst($event->location) }}</small></p>
                        <div class="position-absolute top-0 end-0 m-3 p-2 bg-white text-center" style="width: 70px; height: 75px; border-radius: 10px; z-index: 1;">
                            <p class="mb-0" style="color: black; font-weight: bold; font-size: 1.5rem;">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</p>
                            <p class="mb-0" style="color: black; font-weight: bold; font-size: 0.8rem;">{{ strtoupper(\Carbon\Carbon::parse($event->event_date)->shortMonthName) }}</p>
                        </div>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary" style="width: 100%; background-color: #2563eb; border-color: #2563eb;">Ver Evento</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #111827; min-height: 100vh; margin-top: 10px;">
    <div class="row justify-content-center">
        <!-- Logo y nombre de la aplicación fuera del cuadro del formulario -->
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CYPHER" style="width: 80px; height: 80px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">CYPHER</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="border-radius: 10px; background-color: #1f2937; border: 1px solid #4b5563;">
                <div class="card-body" style="border-radius: 15px;">
                    <form method="POST" action="{{ route('events.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top: 10px;">
                            Crear Evento
                        </h3>

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="name" class="form-label" style="color: white; font-size: 1.0rem;">Nombre del Evento:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required placeholder="Ingresa el nombre del evento" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="description" class="form-label" style="color: white; font-size: 1.0rem;">Descripción:</label>
                            <textarea class="form-control" id="description" name="description" required placeholder="Ingresa la descripción del evento" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="event_date" class="form-label" style="color: white; font-size: 1.0rem;">Fecha del Evento:</label>
                            <input type="datetime-local" class="form-control" id="event_date" name="event_date" value="{{ old('event_date') }}" required style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="location" class="form-label" style="color: white; font-size: 1.0rem;">Ubicación:</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required placeholder="Ingresa la ubicación del evento" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="image" class="form-label" style="color: white; font-size: 1.0rem;">Imagen:</label>
                            <input type="file" class="form-control-file" id="image" name="image" style="color: white;">
                        </div>

                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 90%; background-color: #2563eb; border-color: #2563eb; padding: 0.75rem; font-size: 0.9rem;">
                                Crear Evento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Evento') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.events.update', $event->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nombre del Evento') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $event->name }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Descripción') }}</label>
                            <textarea id="description" class="form-control" name="description" rows="4">{{ $event->description }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="event_date" class="form-label">{{ __('Fecha del Evento') }}</label>
                            <input id="event_date" type="date" class="form-control" name="event_date" value="{{ $event->event_date->format('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">{{ __('Ubicación') }}</label>
                            <input id="location" type="text" class="form-control" name="location" value="{{ $event->location }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Imagen del Evento') }}</label>
                            <input id="image" type="file" class="form-control" name="image">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="Imagen del Evento" class="img-thumbnail mt-2" style="width: 100px;">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

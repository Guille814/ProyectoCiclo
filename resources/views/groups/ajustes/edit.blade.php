@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #111827; min-height: 100vh; padding-top: 10px;">
    <div class="row justify-content-center">
        <!-- Asumiendo que quieres mantener un diseño coherente con el logo y nombre de la aplicación -->
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 80px; height: 80px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">Editar Grupo</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="border-radius: 10px; background-color: #1f2937; border: 1px solid #4b5563;">
                <div class="card-body" style="border-radius: 15px;">
                    <form action="{{ route('groups.update', $group->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nombre del Grupo -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="name" class="form-label" style="color: white; font-size: 1.0rem;">Nombre del Grupo</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $group->name) }}" placeholder="Nombre del Grupo" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">
                        </div>

                        <!-- Biografía -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="biography" class="form-label" style="color: white; font-size: 1.0rem;">Biografía</label>
                            <textarea id="biography" name="biography" class="form-control" rows="3" placeholder="Breve descripción del grupo..." style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">{{ old('biography', $group->biography) }}</textarea>
                        </div>

                        <!-- Imagen de Perfil -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="imagen_perfil" class="form-label" style="color: white; font-size: 1.0rem;">Imagen de Perfil</label>
                            <input type="file" id="imagen_perfil" name="imagen_perfil" class="form-control" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">
                        </div>

                        <!-- Banner de Perfil -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="banner_perfil" class="form-label" style="color: white; font-size: 1.0rem;">Banner de Perfil</label>
                            <input type="file" id="banner_perfil" name="banner_perfil" class="form-control" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">
                        </div>

                        <!-- Botón para guardar cambios -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn" style="background-color: #2563eb; color: white; border-radius: 10px; padding: 10px 20px;">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

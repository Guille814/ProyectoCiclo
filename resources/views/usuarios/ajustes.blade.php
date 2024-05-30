@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #111827; min-height: 100vh; padding-top: 10px;">
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
                    <form method="POST" action="{{ route('perfil.actualizar') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top:10px;">
                            {{ __('Ajustes del Perfil') }}
                        </h3>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="email" class="form-label" style="color: white; font-size: 1.0rem;">Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="nombre@correo.com" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="username" class="form-label" style="color: white; font-size: 1.0rem;">Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="{{ auth()->user()->username }}" placeholder="tu_nombre_de_usuario" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="nombre" class="form-label" style="color: white; font-size: 1.0rem;">Nombre</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ auth()->user()->nombre }}" placeholder="Tu Nombre" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="apellido" class="form-label" style="color: white; font-size: 1.0rem;">Apellido</label>
                            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ auth()->user()->apellido }}" placeholder="Tu Apellido" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="fecha_nacimiento" class="form-label" style="color: white; font-size: 1.0rem;">Fecha de Nacimiento</label>
                            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" value="{{ auth()->user()->fecha_nacimiento }}" placeholder="yyyy-mm-dd" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="imagen_perfil" class="form-label" style="color: white; font-size: 1.0rem;">Imagen de Perfil</label>
                            <input type="file" id="imagen_perfil" name="imagen_perfil" class="form-control" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="biografia" class="form-label" style="color: white; font-size: 1.0rem;">Biografía</label>
                            <textarea id="biografia" name="biografia" class="form-control" rows="3" placeholder="In the beginning, back in nineteen fifty-five, man didn't know 'bout a rock 'n' roll show..." style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">{{ auth()->user()->biografia }}</textarea>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn" style="background-color: #2563eb; color: white; border-radius: 10px; padding: 10px 20px;">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

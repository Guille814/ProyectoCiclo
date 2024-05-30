@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Usuario') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $usuario->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">{{ __('Nombre') }}</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $usuario->nombre }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="apellido" class="form-label">{{ __('Apellido') }}</label>
                            <input id="apellido" type="text" class="form-control" name="apellido" value="{{ $usuario->apellido }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">{{ __('Username') }}</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ $usuario->username }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">{{ __('Fecha de Nacimiento') }}</label>
                            <input id="fecha_nacimiento" type="date" class="form-control" name="fecha_nacimiento" value="{{ $usuario->fecha_nacimiento }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="imagen_perfil" class="form-label">{{ __('Imagen de Perfil') }}</label>
                            <input id="imagen_perfil" type="file" class="form-control" name="imagen_perfil">
                        </div>

                        <div class="mb-3">
                            <label for="biografia" class="form-label">{{ __('Biografía') }}</label>
                            <textarea id="biografia" class="form-control" name="biografia" rows="4">{{ $usuario->biografia }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

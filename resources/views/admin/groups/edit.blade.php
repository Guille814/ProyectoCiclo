@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar Grupo') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.groups.update', $group->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Nombre del Grupo') }}</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ $group->name }}" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label for="biography" class="form-label">{{ __('Biografía') }}</label>
                            <textarea id="biography" class="form-control" name="biography" rows="4">{{ $group->biography }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="imagen_perfil" class="form-label">{{ __('Imagen de Perfil') }}</label>
                            <input id="imagen_perfil" type="file" class="form-control" name="imagen_perfil">
                            @if($group->imagen_perfil)
                                <img src="{{ asset($group->imagen_perfil) }}" alt="Imagen de Perfil" class="img-thumbnail mt-2" style="width: 100px;">
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="banner_perfil" class="form-label">{{ __('Banner del Perfil') }}</label>
                            <input id="banner_perfil" type="file" class="form-control" name="banner_perfil">
                            @if($group->banner_perfil)
                                <img src="{{ asset($group->banner_perfil) }}" alt="Banner de Perfil" class="img-thumbnail mt-2" style="width: 100px;">
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Actualizar') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

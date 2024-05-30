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
                    <form action="{{ route('groups.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top: 10px;">
                            Crear Grupo
                        </h3>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="name" class="form-label" style="color: white; font-size: 1.0rem;">Nombre del Grupo:</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Ingresa el nombre del grupo" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="biography" class="form-label" style="color: white; font-size: 1.0rem;">Biografía:</label>
                            <textarea class="form-control" id="biography" name="biography" placeholder="Ingresa una biografía" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;"></textarea>
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="imagen_perfil" class="form-label" style="color: white; font-size: 1.0rem;">Imagen de Perfil:</label>
                            <input type="file" class="form-control-file" id="imagen_perfil" name="imagen_perfil" style="color: white;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="banner_perfil" class="form-label" style="color: white; font-size: 1.0rem;">Banner de Perfil:</label>
                            <input type="file" class="form-control-file" id="banner_perfil" name="banner_perfil" style="color: white;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="members" class="form-label" style="color: white; font-size: 1.0rem;">Miembros del Grupo:</label>
                            <select class="form-control" id="members" name="members[]" multiple style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;"></select>
                        </div>

                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 90%; background-color: #2563eb; border-color: #2563eb; padding: 0.75rem; font-size: 0.9rem;">
                                Crear Grupo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        background-color: #374151;
        border: 1px solid #4b5563;
        border-radius: 4px;
        padding: 0.4rem;
        font-size: 0.9rem;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
        color: white;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #2563eb;
        border: 1px solid #2563eb;
        color: white;
        padding: 0.25rem;
        margin: 0.15rem 0.25rem 0.15rem 0;
        font-size: 0.85rem;
        border-radius: 4px;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
        color: white;
        margin-left: 5px;
    }
    .select2-dropdown {
        background-color: #374151;
        color: white;
        border: 1px solid #4b5563;
    }
    .select2-search--dropdown .select2-search__field {
        background-color: #374151;
        color: white;
        border: 1px solid #4b5563;
    }
    .select2-results__option {
        background-color: #374151;
        color: white;
    }
    .select2-results__option--highlighted {
        background-color: #2563eb;
        color: white;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#members').select2({
            ajax: {
                url: '{{ route('usuarios.buscar') }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term, // search term
                    };
                },
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            placeholder: 'Buscar usuarios',
            minimumInputLength: 1,
            maximumSelectionLength: 10,
            allowClear: true,
        });
    });
</script>
@endsection

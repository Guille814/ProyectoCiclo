@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #111827; min-height: 100vh; padding-top: 10px;">
    <div class="row justify-content-center">
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CYPHER" style="width: 80px; height: 80px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">CYPHER</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="border-radius: 10px; background-color: #1f2937; border: 1px solid #4b5563;">
                <div class="card-body" style="border-radius: 15px;">
                    <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-top:10px;">
                        {{ __('Vincular Redes Sociales') }}
                    </h3>
                    <form action="{{ route('groups.links.update', $group->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Campos de entrada para cada red social -->
                        @foreach (['spotify', 'soundcloud', 'youtube', 'apple_music'] as $network)
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('svg/'.$network.'.png') }}" alt="{{ ucfirst($network) }}" style="width: 20px; height: 20px; margin-right: 10px;">
                                <label for="{{ $network.'_url' }}" class="form-label" style="color: white; font-size: 1.0rem;">{{ ucfirst($network) }}</label>
                            </div>
                            <input id="{{ $network.'_url' }}" type="url" class="form-control" name="{{ $network.'_url' }}" value="{{ old($network.'_url', $group->{$network.'_url'}) }}" placeholder="https://{{ $network }}.com/yourusername" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-top: 0.5rem; font-size: 0.9rem;">
                        </div>
                        @endforeach
                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 90%; background-color: #2563eb; border-color: #2563eb; padding: 0.75rem; font-size: 0.9rem;">
                                {{ __('Guardar') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const urls = {
        'spotify_url': /^https:\/\/open\.spotify\.com\/.+$/,
        'soundcloud_url': /^https:\/\/soundcloud\.com\/.+$/,
        'youtube_url': /^https:\/\/(www\.youtube\.com\/|youtu\.be\/).+$/,
        'apple_music_url': /^https:\/\/music\.apple\.com\/.+$/,
    };

    Object.keys(urls).forEach(function(id) {
        const inputElement = document.getElementById(id);
        inputElement.addEventListener('input', function() {
            const regex = urls[id];
            if (regex.test(inputElement.value)) {
                inputElement.style.borderColor = 'green';
                inputElement.setCustomValidity(''); // Clear any custom validation messages
            } else {
                inputElement.style.borderColor = 'red';
                inputElement.setCustomValidity('URL no válida para ' + id);
            }
        });
    });
});
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #111827; min-height: 100vh; margin-top: 10px;">
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
                    <form action="{{ route('usuarios.enlaces.actualizar') }}" method="POST">
                        @csrf
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('svg/spotify.png') }}" alt="Spotify" style="width: 20px; height: 20px; margin-right: 10px;">
                                <label for="spotify_url" class="form-label" style="color: white; font-size: 1.0rem;">Spotify</label>
                            </div>
                            <input id="spotify_url" type="url" class="form-control" name="spotify_url" value="{{ auth()->user()->spotify_url }}" placeholder="https://open.spotify.com/user/yourusername" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-top: 0.5rem; font-size: 0.9rem;">
                        </div>
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('svg/soundcloud.png') }}" alt="SoundCloud" style="width: 20px; height: 20px; margin-right: 10px;">
                                <label for="soundcloud_url" class="form-label" style="color: white; font-size: 1.0rem;">SoundCloud</label>
                            </div>
                            <input id="soundcloud_url" type="url" class="form-control" name="soundcloud_url" value="{{ auth()->user()->soundcloud_url }}" placeholder="https://soundcloud.com/yourusername" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-top: 0.5rem; font-size: 0.9rem;">
                        </div>
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('svg/youtube.png') }}" alt="YouTube" style="width: 20px; height: 20px; margin-right: 10px;">
                                <label for="youtube_url" class="form-label" style="color: white; font-size: 1.0rem;">YouTube</label>
                            </div>
                            <input id="youtube_url" type="url" class="form-control" name="youtube_url" value="{{ auth()->user()->youtube_url }}" placeholder="https://www.youtube.com/user/yourusername" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-top: 0.5rem; font-size: 0.9rem;">
                        </div>
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <div style="display: flex; align-items: center;">
                                <img src="{{ asset('svg/applemusic.png') }}" alt="Apple Music" style="width: 20px; height: 20px; margin-right: 10px;">
                                <label for="apple_music_url" class="form-label" style="color: white; font-size: 1.0rem;">Apple Music</label>
                            </div>
                            <input id="apple_music_url" type="url" class="form-control" name="apple_music_url" value="{{ auth()->user()->apple_music_url }}" placeholder="https://music.apple.com/yourusername" style="background-color: #374151; color: white; border: none; padding: 0.75rem; margin-top: 0.5rem; font-size: 0.9rem;">
                        </div>
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
<!--RESTRICCIONES VALIDACION URL RRSS-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        validateSocialLink('spotify-link', 'spotify-error', /^https:\/\/open\.spotify\.com\/user\/.+$/);
        validateSocialLink('soundcloud-link', 'soundcloud-error', /^https:\/\/soundcloud\.com\/.+$/);
        validateSocialLink('youtube-link', 'youtube-error', /^https:\/\/www\.youtube\.com\/(user|channel)\/.+$/);
        validateSocialLink('apple-music-link', 'apple-music-error', /^https:\/\/music\.apple\.com\/.+$/);
    });

    function validateSocialLink(linkId, errorId, regex) {
        const link = document.getElementById(linkId);
        if (link) {
            const url = link.getAttribute('href');
            const isValid = regex.test(url);
            const errorElement = document.getElementById(errorId);
            if (!isValid) {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevenir que el enlace se siga si es inválido
                    errorElement.style.display = 'block';
                });
            } else {
                errorElement.style.display = 'none';
            }
        }
    }
</script>
@endsection
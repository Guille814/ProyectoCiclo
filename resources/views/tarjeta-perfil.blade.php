<div class="profile-banner" style="position: relative; height: 150px; background-image: url('{{ asset('banner_images/default_banner_picture.jpg') }}'); background-size: cover; background-position: center; border-radius: 10px 10px 0 0;">
</div>

<div class="card" style="background-color: #1F2937; border-radius: 0 0 10px 10px; color: white; margin-top: -50px; padding: 20px;">
    <div style="display: flex; flex-direction: column; align-items: center;">
        <div class="profile-picture mx-auto" style="position: relative; width: 140px; height: 140px; margin-top: -70px;">
            <img src="{{ $usuario->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover; border: 4px solid #1F2937;">
        </div>
        <div class="card-body" style="padding-top: 5px; padding-bottom: 0; text-align: center;">
            <h4>{{ $usuario->username }}</h4>
            <p>{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
            <div class="d-flex justify-content-center mb-2">
                <div class="p-2">
                    <p>{{ $usuario->followersCount() }} <b>Seguidores</b></p>
                </div>
                <div class="p-2">
                    <p>{{ $usuario->followingCount() }} <b>Seguidos</b></p>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-top: 10px;">
            <div style="padding: 5px;">
                @if($usuario->spotify_url)
                <a href="{{ $usuario->spotify_url }}" target="_blank" class="btn btn-dark" id="spotify-link" style="background-color: #1F2937;">
                    <img src="{{ asset('svg/spotify.png') }}" alt="Spotify" style="width: 30px; height: 30px; vertical-align: middle;"> Spotify
                </a>
                @endif
            </div>
            <div style="padding: 5px;">
                @if($usuario->soundcloud_url)
                <a href="{{ $usuario->soundcloud_url }}" target="_blank" class="btn btn-dark" id="soundcloud-link" style="background-color: #1F2937;">
                    <img src="{{ asset('svg/soundcloud.png') }}" alt="SoundCloud" style="width: 30px; height: 30px; vertical-align: middle;"> SoundCloud
                </a>
                @endif
            </div>
            <div style="padding: 5px;">
                @if($usuario->youtube_url)
                <a href="{{ $usuario->youtube_url }}" target="_blank" class="btn btn-dark" id="youtube-link" style="background-color: #1F2937;">
                    <img src="{{ asset('svg/youtube.png') }}" alt="YouTube" style="width: 30px; height: 30px; vertical-align: middle;"> YouTube
                </a>
                @endif
            </div>
            <div style="padding: 5px;">
                @if($usuario->apple_music_url)
                <a href="{{ $usuario->apple_music_url }}" target="_blank" class="btn btn-dark" id="apple-music-link" style="background-color: #1F2937;">
                    <img src="{{ asset('svg/applemusic.png') }}" alt="Apple Music" style="width: 30px; height: 30px; vertical-align: middle;"> Apple Music
                </a>
                @endif
            </div>
        </div>
    </div>

    <!-- Botones en la parte inferior de la tarjeta -->
    <div class="d-flex justify-content-around p-2" style="margin-top: 10px;">
        <button class="btn btn-primary" onclick="togglePostForm()" style="flex-grow: 1; margin-right: 5px; padding: 8px 10px;">Publicar un post</button>
        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal" style="flex-grow: 1; background-color: #007bff;">Editar Perfil</a>
    </div>
</div>

<div class="card mt-4" id="postFormCard" style="background-color: #1F2937; color: white; display: none;">
    <div class="card-header">{{ __('Crear un Post') }}</div>
    <div class="card-body">
        @include('posts.createPost')
    </div>
</div>

<!--VENTANA FLOTANTE-->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #1f2937; color: white;">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Opciones del Perfil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a href="{{ route('perfil.ajustes') }}" style="color: white; text-decoration: none;">
                    <p>Editar Información del Perfil</p>
                </a>
                <a href="{{ route('password.change') }}" style="color: white; text-decoration: none;">
                    <p>Cambiar Contraseña</p>
                </a>
                <a href="{{ route('perfil.enlaces') }}" style="color: white; text-decoration: none;">
                    <p>Vincular Redes Sociales</p>
                </a>
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

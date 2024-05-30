@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <!-- Columna del perfil más estrecha -->
        <div class="col-md-5">
            <div class="profile-banner" style="position: relative; height: 150px; background-image: url('{{ asset('banner_images/default_banner_picture.jpg') }}'); background-size: cover; background-position: center; border-radius: 10px 10px 0 0;"></div>
            <div class="card text-center" style="background-color: #1F2937; border-radius: 0 0 10px 10px; color: white; margin-top: -50px;">
                <div class="profile-picture mx-auto" style="position: relative; top: -70px; width: 150px; height: 150px;">
                    <img src="{{ $usuario->imagen_perfil ? asset($usuario->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover; border: 4px solid #1F2937;">
                </div>

                <!-- Menú desplegable para opciones del perfil, como denunciar -->
                <a id="navbarDropdownMenuLink" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position: absolute; top: 10px; right: 10px; color: white;">
                    &#8942;
                </a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item report-button" href="#" data-id="{{ $usuario->id }}" data-type="User">Denunciar perfil</a>
                </div>

                <!-- Detalles del usuario como nombre, seguidores y seguidos -->
                <div class="card-body" style="margin-top: -50px;">
                    <h4>{{ $usuario->username }}</h4>
                    <p>{{ $usuario->nombre }} {{ $usuario->apellido }}</p>
                    <div class="d-flex justify-content-center mb-4">
                        <div class="p-2">
                            <p id="followers-count">{{ $usuario->followersCount() }}</p>
                            <p>seguidores</p>
                        </div>
                        <div class="p-2">
                            <p>{{ $usuario->followingCount() }}</p>
                            <p>seguidos</p>
                        </div>
                    </div>

                    <!-- Enlaces a redes sociales, si están disponibles -->
                    <div class="d-flex justify-content-center mb-4">
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

                    <!-- Botones de acción para seguir o dejar de seguir, dependiendo del estado actual -->
                    @if (auth()->user()->isFollowing($usuario))
                    <form id="unfollow-form" action="{{ route('usuario.unfollow', $usuario) }}" method="POST" class="ajax-form" data-id="{{ $usuario->id }}" data-action="unfollow">
                        @csrf
                        <button type="button" class="btn btn-success follow-btn">Siguiendo</button>
                    </form>
                    @else
                    <form action="{{ route('usuario.follow', $usuario) }}" method="POST" class="ajax-form" data-id="{{ $usuario->id }}" data-action="follow">
                        @csrf
                        <button type="submit" class="btn btn-primary follow-btn">Seguir</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Columna de las publicaciones más ancha -->
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h2 class="text-center my-4" style="color: white;">{{ __('Posts') }}</h2>
            @if ($posts->count() > 0)
            @foreach ($posts as $post)
            <div class="post-card mb-4 p-3" style="background-color: #1F2937; border-radius: 5px; color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div class="d-flex justify-content-between">
                    <div class="d-flex">
                        <a href="#" style="text-decoration: none; color: inherit;">
                            <img src="{{ $post->user->imagen_perfil ? asset($post->user->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle me-2" style="width: 40px; height: 40px;">
                        </a>
                        <div>
                            <p class="mb-1" style="margin-bottom: 0;">
                                <b>{{ $post->user->username }}</b>
                                &nbsp;&nbsp;
                                <span>{{ ucfirst($post->user->nombre) }} {{ $post->user->apellido }}</span>
                            </p>
                            <p class="mb-1" style="color: #bbb;">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- Menú de acciones para cada post, con opciones de edición y eliminación si el usuario autenticado es el propietario -->
                    @if(auth()->check() && $post->user_id === auth()->id())
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                        &#8942;
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('posts.edit', ['id' => $post->id]) }}">Editar</a>
                        <a class="dropdown-item" href="{{ route('posts.confirmDelete', ['id' => $post->id]) }}">Eliminar</a>
                    </div>
                    @elseif(auth()->check())
                    <!-- Opción de denunciar disponible para todos los usuarios excepto el propietario -->
                    <a id="navbarDropdownMenuLink" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                        &#8942;
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item report-button" href="#" data-id="{{ $post->id }}" data-type="Post">Denunciar post</a>
                    </div>
                    @endif
                </div>

                <!-- Contenido del post incluyendo texto e imagen si está disponible -->
                <p class="mt-2" style="margin-left: 60px;">{{ $post->texto }}</p>
                @if ($post->imagen_url)
                <img src="{{ url($post->imagen_url) }}" alt="Imagen del post" style="max-width: 100%;">
                @endif

                <!-- Sección de comentarios para cada post -->
                @if ($post->comments->count() > 0)
                <div class="comments mt-3" style="background-color: #374151; padding: 10px; border-radius: 5px; margin-top: 20px;">
                    <h5 class="text-center" style="font-size: 1.2rem;">Comentarios</h5>
                    @php $commentCount = $post->comments->count(); @endphp
                    <div class="comment-list" style="max-height: {{ $commentCount > 10 ? '300px' : 'none' }}; overflow-y: {{ $commentCount > 10 ? 'scroll' : 'visible' }};">
                        @foreach($post->comments as $comment)
                        <div class="comment mb-3 d-flex justify-content-between" data-comment-id="{{ $comment->id }}">
                            <div class="d-flex align-items-center">
                                <!-- Enlace de imagen de perfil sin estilo de enlace -->
                                <a href="{{ $comment->user_id == $usuario->id ? '#' : ($comment->group_id ? '/groups/'.$comment->group_id : ($comment->user_id == auth()->id() ? '/perfil' : '/perfil/'.$comment->user->username)) }}" style="text-decoration: none; color: inherit;">
                                    <img src="{{ $comment->user->imagen_perfil ? asset($comment->user->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                </a>
                                <div>
                                    <p class="mb-1" style="margin-bottom: 0;">
                                        <a href="{{ $comment->user_id == $usuario->id ? '#' : ($comment->group_id ? '/groups/'.$comment->group_id : ($comment->user_id == auth()->id() ? '/perfil' : '/perfil/'.$comment->user->username)) }}" style="text-decoration: none; color: inherit;">
                                            <b>{{ $comment->user->username }}</b>
                                        </a>
                                        &nbsp;&nbsp;
                                        <span style="color: #bbb;">{{ $comment->created_at->diffForHumans() }}</span>
                                    </p>
                                    <p class="mb-0">{{ $comment->contenido }}</p>
                                </div>
                            </div>
                            <div class="comment-actions" style="margin-right: 15px;">
                                <!-- Menú de acciones para cada comentario -->
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                    &#8942;
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(auth()->check() && $comment->user_id === auth()->id())
                                    <!-- Solo mostrar eliminar si el comentario es del usuario autenticado -->
                                    <a href="#" class="delete-comment btn btn-link" data-comment-id="{{ $comment->id }}" style="text-decoration: none; color: black;">
                                        Eliminar comentario
                                    </a>
                                    @else
                                    <!-- Mostrar denunciar si el comentario no es del usuario autenticado -->
                                    <a class="dropdown-item report-button" href="#" data-id="{{ $comment->id }}" data-type="Comment">Denunciar comentario</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- Botón para expandir la sección de comentarios si hay muchos -->
                    @if ($commentCount > 3)
                    <div class="text-center">
                        <button class="btn btn-link show-comments" style="color: white;" onclick="toggleComments(this)">
                            <img src="{{ asset('svg/fecha-abajo.png') }}" alt="Mostrar más comentarios" style="width: 24px; height: 24px;">
                        </button>
                    </div>
                    @endif
                </div>
                @endif


                <!-- Botones de interacción para me gusta y comentar, y formulario para nuevos comentarios -->
                <div class="d-flex flex-column align-items-start mt-3" style="margin-left: 5px;">
                    <div class="d-flex align-items-center gap-10">
                        <button class="like-button btn btn-link" style="padding: 0; border: none; margin-right: 10px;" data-post-id="{{ $post->id }}" data-liked="{{ $post->isLikedBy(auth()->user()) }}">
                            <img src="{{ $post->isLikedBy(auth()->user()) ? asset('svg/like.png') : asset('svg/unlike.png') }}" alt="Like" id="like-icon-{{ $post->id }}" style="width: 24px; height: 24px;">
                        </button>
                        <button class="btn btn-link" style="padding: 0; border: none;" onclick="toggleCommentForm(this)">
                            <img src="{{ asset('svg/comentario.png') }}" alt="Comment" style="width: 24px; height: 24px;">
                        </button>
                    </div>
                    <span id="likes-count-{{ $post->id }}" class="text-left">{{ $post->likes_count }} {{ Str::plural('Me gusta', $post->likes_count) }}</span>
                </div>

                <div class="comment-form mt-3" style="display: none; background-color: #1F2937; padding: 10px; border-radius: 5px;">
                    <form>
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <input type="hidden" name="post_user_id" value="{{ $post->user_id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <textarea name="contenido" rows="3" class="form-control mb-2" style="background-color: #374151; border: none;" placeholder="Escribe un comentario"></textarea>
                        <button type="button" class="submit-comment btn btn-primary">
                            <img src="{{ asset('svg/enviar.png') }}" alt="Enviar" style="width: 24px; height: 24px;">
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
            @else
            <p>No hay posts para mostrar.</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.follow-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevenir el envío del formulario directamente
                const form = button.closest('form'); // Obtener el formulario más cercano al botón
                const action = form.dataset.action;

                // Solo pedir confirmación si la acción es 'unfollow'
                if (action === 'unfollow' && !confirm("¿Seguro que quieres dejar de seguir a este usuario?")) {
                    return; // Detener la ejecución si el usuario cancela la acción
                }

                // Continuar con la ejecución normal si el usuario confirma o si la acción es 'follow'
                const formData = new FormData(form);
                const url = form.action;
                const method = form.method;

                fetch(url, {
                        method: method,
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cambiar el botón según la acción realizada
                            if (action === 'follow') {
                                button.innerHTML = 'Siguiendo';
                                button.classList.remove('btn-primary');
                                button.classList.add('btn-success');
                                form.dataset.action = 'unfollow';
                                form.action = form.action.replace('follow', 'unfollow');
                            } else if (action === 'unfollow') {
                                button.innerHTML = 'Seguir';
                                button.classList.remove('btn-success');
                                button.classList.add('btn-primary');
                                form.dataset.action = 'follow';
                                form.action = form.action.replace('unfollow', 'follow');
                            }

                            // Actualizar el conteo de seguidores
                            const followersCountElement = document.getElementById('followers-count');
                            if (followersCountElement) {
                                followersCountElement.textContent = data.followersCount;
                            }
                        } else {
                            alert('Error al procesar la solicitud. Por favor, inténtalo de nuevo.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error al procesar la solicitud. Por favor, verifica tu conexión y prueba de nuevo.');
                    });
            });
        });
    });
</script>


@include('reports.modal')
@include('scripts.post_scripts')
@include('includes.fixed_button')
@endsection
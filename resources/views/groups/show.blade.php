@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <!-- Banner del grupo -->
            <div class="profile-banner" style="position: relative; height: 200px; width: 100%; background-image: url('{{ $group->banner_perfil ? Storage::url($group->banner_perfil) : asset('banner_images/default_banner_picture.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 10px 10px 0 0; margin-bottom: -70px;">
            </div>

            <!-- Tarjeta de grupo -->
            <div class="card mx-auto text-center" style="background-color: #1F2937; border-radius: 0 0 10px 10px; color: white;">
                <div>
                    <div class="profile-picture mx-auto" style="position: relative; top: -40px; width: 190px; height: 190px; margin-bottom: -40px;">
                        <a href="#" onclick="redirectToGroupProfile('{{ $group->id }}')">
                            <img src="{{ $group->imagen_perfil ? Storage::url($group->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover; border: 4px solid #1F2937;">
                        </a>
                    </div>
                    <div class="card-body" style="padding-top: 5px; padding-bottom: 0;">
                        <h4>{{ $group->name }}</h4>
                        <p>{{ $group->biography }}</p>
                        <div class="d-flex justify-content-center mb-2">
                            <p>{{ $group->members->count() }} <b>Miembros</b></p>
                            <p>{{ $group->followers()->count() }} <b>Seguidores</b></p>
                        </div>
                    </div>
                </div>

                <!--Botones redes sociales-->
                <div class="d-flex justify-content-center" style="margin-top: 10px;">
                    <div style="padding: 5px;">
                        @if($group->spotify_url)
                        <a href="{{ $group->spotify_url }}" target="_blank" class="btn btn-dark" id="spotify-link" style="background-color: #1F2937;">
                            <img src="{{ asset('svg/spotify.png') }}" alt="Spotify" style="width: 30px; height: 30px; vertical-align: middle;"> Spotify
                        </a>
                        @endif
                    </div>
                    <div style="padding: 5px;">
                        @if($group->soundcloud_url)
                        <a href="{{ $group->soundcloud_url }}" target="_blank" class="btn btn-dark" id="soundcloud-link" style="background-color: #1F2937;">
                            <img src="{{ asset('svg/soundcloud.png') }}" alt="SoundCloud" style="width: 30px; height: 30px; vertical-align: middle;"> SoundCloud
                        </a>
                        @endif
                    </div>
                    <div style="padding: 5px;">
                        @if($group->youtube_url)
                        <a href="{{ $group->youtube_url }}" target="_blank" class="btn btn-dark" id="youtube-link" style="background-color: #1F2937;">
                            <img src="{{ asset('svg/youtube.png') }}" alt="YouTube" style="width: 30px; height: 30px; vertical-align: middle;"> YouTube
                        </a>
                        @endif
                    </div>
                    <div style="padding: 5px;">
                        @if($group->apple_music_url)
                        <a href="{{ $group->apple_music_url }}" target="_blank" class="btn btn-dark" id="apple-music-link" style="background-color: #1F2937;">
                            <img src="{{ asset('svg/applemusic.png') }}" alt="Apple Music" style="width: 30px; height: 30px; vertical-align: middle;"> Apple Music
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Botones en la parte inferior de la tarjeta -->
                <div class="d-flex justify-content-around p-2">
                    <!-- Botones para miembros o creadores del grupo -->
                    @if(auth()->check() && $group->isMemberOrCreator(auth()->user()))
                    <button class="btn btn-primary" onclick="togglePostForm()" style="flex-grow: 1; margin-right: 5px; padding: 8px 10px;">Publicar un post</button>
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal" style="flex-grow: 1; background-color: #007bff;">Editar Perfil</a>
                    @endif

                    <!-- Botones para no miembros -->
                    @if(auth()->check() && !$group->isMemberOrCreator(auth()->user()))
                    @if($group->isFollowedBy(auth()->user()))
                    <form id="unfollowForm" action="{{ route('groups.unfollow', $group) }}" method="POST" style="flex-grow: 1;">
                        @csrf
                        <button type="submit" class="btn btn-success" style="width: 100%;">Siguiendo</button>
                    </form>
                    @else
                    <form id="followForm" action="{{ route('groups.follow', $group) }}" method="POST" style="flex-grow: 1;">
                        @csrf
                        <button type="submit" class="btn btn-primary" style="width: 100%;">Seguir</button>
                    </form>
                    @endif
                    @endif
                </div>
            </div>

            <!-- Formulario de creación de post -->
            <div class="card mt-4 mx-auto" id="postFormCard" style="background-color: #1F2937; color: white; display: none;">
                <div class="card-header">{{ __('Crear un Post en el Grupo') }}</div>
                <div class="card-body">
                    @include('posts.createPost', ['group' => $group])
                </div>
            </div>
            <!-- Diálogo modal para mostrar miembros -->
            <dialog id="membersListModal" class="modal" style="border: none; border-radius: 8px; padding: 20px; width: auto; max-width: 80%;">
                <h3>Miembros del Grupo</h3>
                <div id="membersContent" style="margin-top: 10px;">
                    <!-- Lista de miembros se carga aquí -->
                </div>
                <div style="text-align: right; margin-top: 20px;">
                    <button onclick="document.getElementById('membersListModal').close();" class="btn btn-secondary">Cerrar</button>
                </div>
            </dialog>

        </div>
    </div>
    <!-- Lista de posts del grupo -->
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h2 class="text-center my-4" style="color: white;">{{ __('Posts del Grupo') }}</h2>
            <div class="col-md-12">
                @if ($group->posts->count() > 0)
                @foreach ($group->posts as $post)
                <div class="post-card mb-4 p-3" style="background-color: #1F2937; border-radius: 5px; color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <!-- Contenido del post -->
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <a href="{{ auth()->id() === $post->user_id ? '#' : '/perfil/'.$post->user->username }}" style="text-decoration: none; color: inherit;">
                                <img src="{{ $group->imagen_perfil ? Storage::url($group->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil del Grupo" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                            </a>

                            <div>
                                <p class="mb-1" style="margin-bottom: 0;">
                                    <a href="#" onclick="redirectToGroupProfile('{{ $group->id }}')" style="color: white; text-decoration: none;"><b>{{ $group->name }}</b></a> &nbsp;&nbsp;
                                    <span><a href="#" onclick="redirectToProfileOrGroup('{{ $post->user }}', '{{ $group }}', '{{ $post->user->username }}')" style="color: white; text-decoration: none;"></a></span>
                                </p>
                                <p class="mb-1" style="color: #bbb;">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                            &#8942;
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('posts.edit', ['id' => $post->id]) }}">Editar</a>
                            <a class="dropdown-item" href="{{ route('posts.confirmDelete', ['id' => $post->id]) }}">Eliminar</a>
                        </div>
                    </div>

                    <p class="mt-2" style="margin-left: 60px;">{{ $post->texto }}</p>

                    @if ($post->imagen_url)
                    <img src="{{ url($post->imagen_url) }}" alt="Imagen del post" style="max-width: 100%;">
                    @endif

                    <!-- Comentarios -->
                    @if ($post->comments->count() > 0)
                    <div class="comments mt-3" style="background-color: #374151; padding: 10px; border-radius: 5px; margin-top: 20px;">
                        <h5 class="text-center" style="font-size: 1.2rem;">Comentarios</h5>
                        <div class="comment-list" style="max-height: 300px; overflow-y: scroll;">
                            @foreach($post->comments as $comment)
                            <div class="comment mb-3 d-flex justify-content-between" data-comment-id="{{ $comment->id }}">
                                <div class="d-flex align-items-center">
                                    <a href="{{ $comment->user_id === auth()->id() ? '#' : '/perfil/'.$comment->user->username }}" style="text-decoration: none; color: inherit;">
                                        <img src="{{ $comment->user->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                    </a>
                                    <div>
                                        <p class="mb-1" style="margin-bottom: 0;">
                                            <a href="#" onclick="redirectToProfileOrGroup('{{ $comment->user }}', '{{ $group }}', '{{ $comment->user->username }}')" style="color: white; text-decoration: none;"><b>{{ $comment->user->username }}</b></a>
                                            &nbsp;&nbsp;
                                            <span style="color: #bbb;">{{ $comment->created_at->diffForHumans() }}</span>
                                        </p>
                                        <p class="mb-0">{{ $comment->contenido }}</p>
                                    </div>
                                </div>
                                <div class="comment-actions" style="margin-right: 15px;">
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                        &#8942;
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if(auth()->check() && ($comment->user_id === auth()->id() || $post->user_id === auth()->id()))
                                        <!-- Botón para eliminar comentario con AJAX -->
                                        <a href="#" class="delete-comment btn btn-link" data-comment-id="{{ $comment->id }}" style="text-decoration: none; color: black;">
                                            Eliminar comentario
                                        </a>
                                        @endif
                                        <a class="dropdown-item" href="#">Denunciar comentario</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Formulario de comentario -->
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
                        <form action="{{ route('comment.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                            <textarea name="contenido" rows="3" class="form-control mb-2" style="background-color: #374151; border: none;" placeholder="Escribe un comentario"></textarea>
                            <button type="submit" class="submit-comment btn btn-primary">
                                <img src="{{ asset('svg/enviar.png') }}" alt="Enviar" style="width: 24px; height: 24px;">
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
                @else
                <p class="text-center" style="color:white;">No hay posts para mostrar.</p>
                @endif
            </div>
        </div>
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
                <a href="{{ route('groups.ajustes.edit', $group->id) }}" style="color: white; text-decoration: none;">
                    <p>Editar Información del Perfil</p>
                </a>
                <a href="{{ route('groups.ajustes.enlaces', $group->id) }}" style="color: white; text-decoration: none;">
                    <p>Vincular Redes Sociales</p>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const followForm = document.getElementById('followForm');
        const unfollowForm = document.getElementById('unfollowForm');

        function ajaxFormSubmit(form) {
            if (!form) return;

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Previene la recarga de la página
                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': formData.get('_token') // Asegura enviar el token CSRF
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Actualiza la UI según si se sigue o no se sigue al usuario
                            if (form === followForm) {
                                followForm.style.display = 'none';
                                unfollowForm.style.display = 'block';
                            } else {
                                followForm.style.display = 'block';
                                unfollowForm.style.display = 'none';
                            }
                        }
                        alert(data.message);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Algo salió mal.');
                    });
            });
        }

        ajaxFormSubmit(followForm);
        ajaxFormSubmit(unfollowForm);
    });


    function togglePostForm() {
        var postFormCard = document.getElementById('postFormCard');
        if (postFormCard.style.display === "none") {
            postFormCard.style.display = "block";
        } else {
            postFormCard.style.display = "none";
        }
    }

    function redirectToProfile(username) {
        window.location.href = "/perfil/" + username;
    }

    function redirectToGroupProfile(groupId) {
        window.location.href = "/groups/" + groupId;
    }

    function redirectToProfileOrGroup(user, group, username) {
        if (user.id === group.id) {
            redirectToGroupProfile(group.id);
        } else {
            redirectToProfile(username);
        }
    }

    function confirmUnfollow(userId) {
        if (confirm("¿Seguro que quieres dejar de seguir a este usuario?")) {
            document.getElementById("unfollow-form-" + userId).submit();
        }
    }

    function toggleCommentForm(button) {
        var commentForm = button.closest('.post-card').querySelector('.comment-form');
        commentForm.style.display = commentForm.style.display === 'none' ? 'block' : 'none';
    }

    function toggleComments(button) {
        var commentList = button.closest('.comments').querySelector('.comment-list');
        var isExpanded = commentList.style.maxHeight === 'none';
        commentList.style.maxHeight = isExpanded ? '300px' : 'none';
        commentList.style.overflowY = isExpanded ? 'scroll' : 'visible';
        button.querySelector('img').src = isExpanded ? '{{ asset('svg/fecha-abajo.png') }}': '{{ asset('svg/fecha-arriba.png') }}';
    }
</script>

<script>
function showMembersList() {
    const modal = document.getElementById('membersListModal');
    const membersContent = document.getElementById('membersContent');
    membersContent.innerHTML = '<p>Cargando miembros...</p>';

    fetch(`/groups/{{ $group->id }}/members`)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                membersContent.innerHTML = '';
                data.forEach(member => {
                    membersContent.innerHTML += `<div>${member.name} - ${member.role}</div>`;
                });
            } else {
                membersContent.innerHTML = '<p>No hay miembros que mostrar.</p>';
            }
            modal.showModal();
        })
        .catch(error => {
            console.error('Error:', error);
            membersContent.innerHTML = '<p>Error al cargar la lista de miembros.</p>';
        });
}


</script>

@include('scripts.post_scripts')
@include('includes.fixed_button')
@endsection
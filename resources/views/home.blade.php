@extends('layouts.app')

@section('content')
<style>
    .image-wrapper {
        text-align: center;
        /* Centra el contenido */
        margin: 20px 0;
        /* Espacio arriba y abajo de la imagen */
    }

    .image-wrapper img {
        
        /* Máximo ancho de 400px */
        max-height: 500px;
        /* Máximo alto de 400px */
        height: auto;
        /* Altura automática para mantener la proporción */
        width: auto;
        /* Anchura automática para mantener la proporción */
        border-radius: 5px;
        /* Bordes redondeados */
    }
</style>


<div class="container">
    <!-- Fila para centrar el contenido -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Título del feed -->
            <h2 class="text-center my-4" style="color: white;">{{ __('¡No te pierdas lo nuevo de hoy!') }}</h2>
            <div class="col-md-12">
                @if ($posts->count() > 0)
                <!-- Recorre cada post -->
                @foreach ($posts as $post)
                <div class="post-card mb-4 p-3" style="background-color: #1F2937; border-radius: 5px; color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <!-- Imagen del autor del post o del grupo -->
                            <a href="{{ $post->group_id ? '/groups/' . $post->group_id : ($post->user_id === auth()->id() ? '/perfil' : '/perfil/' . $post->user->username) }}" style="text-decoration: none; color: inherit;">
                                <img src="{{ $post->group_id ? ($post->group->imagen_perfil ? Storage::url($post->group->imagen_perfil) : asset('profile_pictures/default_profile_picture.png')) : ($post->user->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png')) }}" alt="Perfil" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                            </a>

                            <!-- Nombre del autor del post o del grupo -->
                            <p class="mb-1" style="margin-bottom: 0;">
                                <b><a href="{{ $post->group_id ? '/groups/' . $post->group_id : ($post->user_id === auth()->id() ? '/perfil' : '/perfil/' . $post->user->username) }}" style="text-decoration: none; color: inherit;">{{ $post->group_id ? $post->group->name : $post->user->username }}</a></b>
                                &nbsp;&nbsp;
                                <span>{{ $post->group_id ? $post->group->name : ucfirst($post->user->nombre) . ' ' . ucfirst($post->user->apellido) }}</span>
                            </p>
                        </div>
                        <!-- Menú desplegable para acciones del post -->
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                            &#8942;
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if(auth()->check())
                            @if($post->user_id === auth()->id())
                            <!-- Opciones para el usuario propietario del post -->
                            <a class="dropdown-item" href="{{ route('posts.edit', ['id' => $post->id]) }}">Editar</a>
                            <a class="dropdown-item" href="{{ route('posts.confirmDelete', ['id' => $post->id]) }}">Eliminar</a>
                            @else
                            <!-- Opción para denunciar disponible solo para posts de otros usuarios -->
                            <a class="dropdown-item report-button" href="#" data-id="{{ $post->id }}" data-type="Post">Denunciar post</a>
                            @endif
                            @endif
                        </div>
                    </div>

                    <!-- Contenido del texto del post -->
                    <p class="mt-2" style="margin-left: 60px;">{{ $post->texto }}</p>

                    <!-- Imagen del post -->
                    @if ($post->imagen_url)
                    <div class="image-wrapper">
                        <img src="{{ url($post->imagen_url) }}" alt="Imagen del post">
                    </div> @endif

                    <!-- Sección de comentarios -->
                    @if ($post->comments->count() > 0)
                    <div class="comments mt-3" style="background-color: #374151; padding: 10px; border-radius: 5px; margin-top: 20px;">
                        <h5 class="text-center" style="font-size: 1.2rem;">Comentarios</h5>
                        @php $commentCount = $post->comments->count(); @endphp
                        <div class="comment-list" style="max-height: {{ $commentCount > 10 ? '300px' : 'none' }}; overflow-y: {{ $commentCount > 10 ? 'scroll' : 'visible' }};">
                            <!-- Recorre cada comentario -->
                            @foreach($post->comments as $comment)
                            <div class="comment mb-3 d-flex justify-content-between" data-comment-id="{{ $comment->id }}">
                                <div class="d-flex align-items-center">
                                    <!-- Imagen del autor del comentario -->
                                    <a href="{{ $comment->user_id === auth()->id() ? '/perfil' : '/perfil/' . $comment->user->username }}" style="text-decoration: none; color: inherit;">
                                        <img src="{{ $comment->user->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                    </a>
                                    <div>
                                        <!-- Nombre del autor del comentario y tiempo de creación -->
                                        <p class="mb-1" style="margin-bottom: 0;">
                                            <b><a href="{{ $comment->user_id === auth()->id() ? '/perfil' : '/perfil/' . $comment->user->username }}" style="text-decoration: none; color: inherit;">{{ $comment->user->username }}</a></b>
                                            &nbsp;&nbsp;
                                            <span style="color: #bbb;">{{ $comment->created_at->diffForHumans() }}</span>
                                        </p>
                                        <!-- Contenido del comentario -->
                                        <p class="mb-0">{{ $comment->contenido }}</p>
                                    </div>
                                </div>
                                <div class="comment-actions" style="margin-right: 15px;">
                                    <!-- Menú desplegable para acciones del comentario -->
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                        &#8942;
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if(auth()->check() && $comment->user_id === auth()->id())
                                        <!-- Opciones para el usuario propietario del comentario -->
                                        <a href="#" class="delete-comment btn btn-link" data-comment-id="{{ $comment->id }}" style="text-decoration: none; color: black;">
                                            Eliminar comentario
                                        </a>
                                        @else
                                        <!-- Opción para denunciar disponible solo para comentarios de otros usuarios -->
                                        <a class="dropdown-item report-button" href="#" data-id="{{ $comment->id }}" data-type="Comment">Denunciar comentario</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @if ($commentCount > 3)
                        <!-- Botón para mostrar más comentarios -->
                        <div class="text-center">
                            <button class="btn btn-link show-comments" style="color: white;" onclick="toggleComments(this)">
                                <img src="{{ asset('svg/fecha-abajo.png') }}" alt="Mostrar más comentarios" style="width: 24px; height: 24px;">
                            </button>
                        </div>
                        @endif
                    </div>
                    @endif
                    <!-- Botones de me gusta y comentar -->
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

                    <!-- Formulario de comentarios -->
                    <div class="comment-form mt-3" style="display: none; background-color: #1F2937; padding: 10px; border-radius: 5px;">
                        <form action="{{ route('comment.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
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
                <!-- Mensaje cuando no hay posts -->
                <p style="color: white;">No hay posts para mostrar.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@include('reports.modal')
@include('scripts.post_scripts')
@include('includes.fixed_button')
@endsection
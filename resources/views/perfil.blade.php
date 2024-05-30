{{-- Extiende el layout principal de la aplicación desde el archivo "layouts.app" --}}
@extends('layouts.app')

{{-- Contenido principal de la vista --}}
@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- Columna que contiene la tarjeta de perfil del usuario --}}
        <div class="col-md-6">
            {{-- Incluye la vista parcial que contiene la tarjeta de perfil --}}
            @include('tarjeta-perfil')
        </div>
    </div>

    {{-- Nueva fila para los posts del usuario --}}
    <div class="row justify-content-center">
        <div class="col-md-7">
            {{-- Título de la sección de posts --}}
            <h2 class="text-center my-4" style="color: white;">{{ __('Mis Posts') }}</h2>
            <div class="col-md-12">
                {{-- Verifica si hay posts disponibles --}}
                @if ($posts->count() > 0)
                {{-- Itera sobre cada post asociado al usuario --}}
                @foreach ($posts as $post)
                @if (!$post->group_id) {{-- Solo muestra los posts que no pertenecen a un grupo --}}
                <div class="post-card mb-4 p-3" style="background-color: #1F2937; border-radius: 5px; color: white; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            {{-- Enlace que redirige a "#" si es el perfil del usuario actual, de lo contrario a /perfil/{username} --}}
                            <a href="{{ auth()->id() === $post->user_id ? '#' : '/perfil/'.$post->user->username }}" style="text-decoration: none; color: inherit;">
                                <img src="{{ $post->user->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 4px solid #1F2937;">
                            </a>
                            <div>
                                {{-- Enlace que redirige a "#" si es el perfil del usuario actual, de lo contrario a /perfil/{username} --}}
                                <p class="mb-1" style="margin-bottom: 0;">
                                    <a href="{{ auth()->id() === $post->user_id ? '#' : '/perfil/'.$post->user->username }}" style="text-decoration: none; color: inherit;">
                                        <b>{{ $post->user->username }}</b>
                                    </a>
                                    &nbsp;&nbsp;
                                    <span>{{ ucfirst($post->user->nombre) }} {{ $post->user->apellido }}</span>
                                </p>
                                {{-- Muestra la fecha de creación del post, formateada para ser legible para humanos --}}
                                <p class="mb-1" style="color: #bbb;">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        {{-- Dropdown para acciones del post como editar o eliminar --}}
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                            &#8942;
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- Opción para editar el post --}}
                            <a class="dropdown-item" href="{{ route('posts.edit', ['id' => $post->id]) }}">Editar</a>
                            {{-- Opción para eliminar el post --}}
                            <a class="dropdown-item" href="{{ route('posts.confirmDelete', ['id' => $post->id]) }}">Eliminar</a>
                        </div>
                    </div>

                    {{-- Muestra el texto del post --}}
                    <p class="mt-2" style="margin-left: 60px;">{{ $post->texto }}</p>

                    {{-- Muestra una imagen asociada al post si está disponible --}}
                    @if ($post->imagen_url)
                    <img src="{{ url($post->imagen_url) }}" alt="Imagen del post" style="max-width: 100%;">
                    @endif

                    {{-- Sección para mostrar comentarios del post --}}
                    @if ($post->comments->count() > 0)
                    @php $commentCount = $post->comments->count(); @endphp
                    <div class="comments mt-3" style="background-color: #374151; padding: 10px; border-radius: 5px; margin-top: 20px;">
                        <h5 class="text-center" style="font-size: 1.2rem;">Comentarios</h5>
                        <div class="comment-list" style="max-height: {{ $commentCount > 10 ? '300px' : 'none' }}; overflow-y: {{ $commentCount > 10 ? 'scroll' : 'visible' }};">
                            @foreach($post->comments as $comment)
                            <div class="comment mb-3 d-flex justify-content-between" data-comment-id="{{ $comment->id }}">
                                <div class="d-flex align-items-center">
                                    {{-- Enlace que redirige según la condición del perfil del usuario, a "#" si es el propio usuario, de lo contrario a /perfil/{username} --}}
                                    <a href="{{ $comment->user_id === auth()->id() ? '#' : '/perfil/'.$comment->user->username }}" style="text-decoration: none; color: inherit;">
                                        <img src="{{ $comment->user->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                    </a>
                                    <div>
                                        {{-- Enlace que redirige según la condición del perfil del usuario, a "#" si es el propio usuario, de lo contrario a /perfil/{username} --}}
                                        <p class="mb-1" style="margin-bottom: 0;">
                                            <a href="{{ $comment->user_id === auth()->id() ? '#' : '/perfil/'.$comment->user->username }}" style="text-decoration: none; color: inherit;">
                                                <b>{{ $comment->user->username }}</b>
                                            </a>
                                            &nbsp;&nbsp;
                                            <span style="color: #bbb;">{{ $comment->created_at->diffForHumans() }}</span>
                                        </p>
                                        {{-- Muestra el contenido del comentario --}}
                                        <p class="mb-0">{{ $comment->contenido }}</p>
                                    </div>
                                </div>
                                <div class="comment-actions" style="margin-right: 15px;">
                                    {{-- Dropdown para acciones sobre comentarios --}}
                                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                        &#8942;
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        @if(auth()->id() === $comment->user_id)
                                        {{-- Opción para eliminar comentario, solo visible para el autor del comentario --}}
                                        <a href="#" class="delete-comment btn btn-link" data-comment-id="{{ $comment->id }}" style="text-decoration: none; color: black;">
                                            Eliminar comentario
                                        </a>
                                        @else
                                        {{-- Opción para denunciar comentario, visible solo si el usuario autenticado no es el autor --}}
                                        <a class="dropdown-item report-button" href="#" data-id="{{ $comment->id }}" data-type="Comment">Denunciar comentario</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{-- Botón para expandir los comentarios si hay muchos --}}
                        @if ($commentCount > 3)
                        <div class="text-center">
                            <button class="btn btn-link show-comments" style="color: white;" onclick="toggleComments(this)">
                                <img src="{{ asset('svg/fecha-abajo.png') }}" alt="Mostrar más comentarios" style="width: 24px; height: 24px;">
                            </button>
                        </div>
                        @endif
                    </div>
                    @endif

                    {{-- Sección para me gusta y comentarios --}}
                    <div class="d-flex flex-column align-items-start mt-3" style="margin-left: 5px;">
                        <div class="d-flex align-items-center gap-10">
                            {{-- Botón de me gusta --}}
                            <button class="like-button btn btn-link" style="padding: 0; border: none; margin-right: 10px;" data-post-id="{{ $post->id }}" data-liked="{{ $post->isLikedBy(auth()->user()) }}">
                                <img src="{{ $post->isLikedBy(auth()->user()) ? asset('svg/like.png') : asset('svg/unlike.png') }}" alt="Like" id="like-icon-{{ $post->id }}" style="width: 24px; height: 24px;">
                            </button>
                            {{-- Botón para mostrar el formulario de comentario --}}
                            <button class="btn btn-link" style="padding: 0; border: none;" onclick="toggleCommentForm(this)">
                                <img src="{{ asset('svg/comentario.png') }}" alt="Comment" style="width: 24px; height: 24px;">
                            </button>
                        </div>
                        {{-- Contador de me gusta --}}
                        <span id="likes-count-{{ $post->id }}" class="text-left">{{ $post->likes_count }} {{ Str::plural('Me gusta', $post->likes_count) }}</span>
                    </div>

                    {{-- Formulario para añadir un nuevo comentario, oculto por defecto --}}
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
                @endif {{-- Cierra la verificación del grupo --}}
                @endforeach
                @else
                {{-- Mensaje si no hay posts para mostrar --}}
                <p>No hay posts para mostrar.</p>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- Incluye modales y scripts adicionales necesarios para la página --}}
@include('reports.modal')
@include('scripts.post_scripts')
@include('includes.fixed_button')
@endsection

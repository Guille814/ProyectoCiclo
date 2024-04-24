<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mi Perfil') }}</div>

                <div class="card-body">
                    <p>Nombre: {{ $usuario->nombre }}</p>
                    <p>Apellido: {{ $usuario->apellido }}</p>
                    <p>Email: {{ $usuario->email }}</p>
                    <!-- Agrega más información del perfil aquí -->

                    <!-- Formulario para crear un post -->
                    @include('posts.createPost')
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('Mis Posts') }}</div>

                <div class="card-body">
                    @if ($posts->count() > 0)
                    <ul>
                        @foreach ($posts as $post)
                        <li>{{ $post->texto }}</li>
                        <!-- Agrega más detalles del post según sea necesario -->
                        @endforeach
                    </ul>
                    @else
                    <p>No hay posts para mostrar.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.app')

<div class="container" style="background-color: #111827; min-height: 100vh; margin-top: 10px;">
    <div class="row justify-content-center">
        <!-- Logo y nombre de la aplicación fuera del cuadro del formulario -->
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CYPHER" style="width: 80px; height: 80px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">CYPHER</h2>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card" style="border-radius: 10px; background-color: #1f2937; border: 1px solid #4b5563;">
                <div class="card-body" style="border-radius: 15px;">
                    <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top:10px;">
                        {{ __('Confirmar Eliminación') }}
                    </h3>
                    <p style="color: white; text-align: center;">¿Estás seguro de que deseas eliminar este post?</p>
                    <p style="color: white; text-align: center;"><strong>Contenido del post:</strong> {{ $post->texto }}</p>
                    @if ($post->imagen_url)
                        <div class="text-center mb-4">
                            <img src="{{ url($post->imagen_url) }}" alt="Imagen del post" style="width: 200px; height: 200px; object-fit: cover;">
                        </div>
                    @endif
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="text-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="background-color: #dc2626; border-color: #dc2626; padding: 0.75rem; font-size: 0.9rem; margin: 0.5rem;">Confirmar eliminación</button>
                        <a href="{{ route('perfil') }}" class="btn btn-secondary" style="background-color: #6b7280; border-color: #6b7280; padding: 0.75rem; font-size: 0.9rem; margin: 0.5rem;">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

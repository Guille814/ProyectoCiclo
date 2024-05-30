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
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top:10px;">
                            {{ __('Editar Post') }}
                        </h3>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="texto" class="form-label" style="color: white; font-size: 1.0rem;">Texto:</label>
                            <textarea class="form-control" id="texto" name="texto" rows="3" required style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">{{ $post->texto }}</textarea>
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="imagen" class="form-label" style="color: white; font-size: 1.0rem;">Imagen:</label>
                            <input type="file" class="form-control-file" id="imagen" name="imagen" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="video_url" class="form-label" style="color: white; font-size: 1.0rem;">URL de video:</label>
                            <input type="text" class="form-control" id="video_url" name="video_url" value="{{ $post->video_url }}" style="background-color: #374151; color: white; border: none; padding: 0.75rem; font-size: 0.9rem;">
                        </div>

                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 20%; background-color: #2563eb; border-color: #2563eb; padding: 0.75rem; font-size: 0.9rem;">
                                Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="post-details">
    <h4>Detalle de Post</h4>
    <p>Autor: {{ $post->user->username }}</p>
    <p>Fecha: {{ $post->created_at->diffForHumans() }}</p>
    <p>Contenido: {{ $post->texto }}</p>
    @if ($post->imagen_url)
        <img src="{{ url($post->imagen_url) }}" alt="Imagen del Post" style="max-width: 100%;">
    @endif
    <div class="comments">
        <h5>Comentarios</h5>
        @foreach ($post->comments as $comment)
            <div class="comment">
                <strong>{{ $comment->user->username }}:</strong>
                <p>{{ $comment->contenido }}</p>
            </div>
        @endforeach
    </div>
</div>

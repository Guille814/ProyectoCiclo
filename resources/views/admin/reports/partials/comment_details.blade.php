<div class="comment-details">
    <h4>Detalle de Comentario</h4>
    <p>Autor: {{ $comment->user->username }}</p>
    <p>Fecha: {{ $comment->created_at->diffForHumans() }}</p>
    <p>Contenido: {{ $comment->contenido }}</p>
    <p>En respuesta a Post: {{ $comment->post->texto }}</p>
    <!-- Opcional: Mostrar un enlace al post completo -->
</div>

<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="texto">Texto:</label>
        <textarea class="form-control" id="texto" name="texto" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen:</label>
        <input type="file" class="form-control-file" id="imagen" name="imagen">
    </div>
    <div class="form-group">
        <label for="video_url">URL de video:</label>
        <input type="text" class="form-control" id="video_url" name="video_url">
    </div>
    <button type="submit" class="btn btn-primary">Publicar</button>
</form>
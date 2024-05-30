<!-- posts/createPost.blade.php -->

<form action="{{ isset($group) ? route('posts.store', ['group' => $group->id]) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="texto">Texto</label>
        <textarea name="texto" id="texto" rows="3" class="form-control">{{ old('texto') }}</textarea>
    </div>
    <div class="form-group">
        <label for="imagen">Imagen</label>
        <input type="file" name="imagen" id="imagen" class="form-control">
    </div>
    <div class="form-group">
        <label for="video_url">URL del Video</label>
        <input type="url" name="video_url" id="video_url" class="form-control" value="{{ old('video_url') }}">
    </div>
    @if(isset($group))
    <input type="hidden" name="group_id" value="{{ $group->id }}">
    @endif
    <button type="submit" class="btn btn-primary">Publicar</button>
</form>

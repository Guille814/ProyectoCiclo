<div class="user-profile p-3 mb-3 border rounded">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Perfil de Usuario: {{ $user->username }}</h4>
        <img src="{{ $user->imagen_perfil ?: asset('default_profile.png') }}" alt="Perfil" class="rounded-circle" style="width: 60px; height: 60px;">
    </div>
    <p>Nombre Completo: {{ $user->nombre }} {{ $user->apellido }}</p>
    <p>Seguidores: {{ $user->followersCount() }}</p>
    <p>Siguiendo: {{ $user->followingCount() }}</p>
    <!-- Agrega más información si es necesario -->
</div>

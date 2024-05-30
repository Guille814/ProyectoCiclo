@extends('layouts.app')

@section('content')
<div class="container" style="color: #f8f9fa;">
    <h1 class="text-center" style="color: #ffffff;">Mis Grupos</h1>
    @if($groups->isEmpty())
    <div class="text-center">
        <a href="{{ route('groups.create') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">+ Nuevo Grupo</a>
        <p class="text-muted" style="font-style: italic; color: #ffffff !important; margin-top: 100px;">No hay ningún grupo todavía.</p>
    </div>
    @else
    <div class="text-center">
        <a href="{{ route('groups.create') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">+ Nuevo Grupo</a>
    </div>

    <div class="d-flex flex-column align-items-center">
        @foreach($groups as $group)
        <div class="list-group-item list-group-item-action d-flex align-items-center" style="background-color: #2c3e50; border-color: #4e5d6c; color: #ffffff; margin-bottom: 10px; padding: 15px; width: 100%; max-width: 600px; border-radius:10px;">
            <a href="{{ route('groups.show', $group->id) }}" class="d-flex align-items-center text-decoration-none" style="color: #ffffff;">
                <img src="{{ $group->imagen_perfil ? Storage::url($group->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover; margin-right: 15px;">
                <div>
                    <strong style="font-size: 1.2em;">{{ $group->name }}</strong>
                    <p class="text mb-0" style="font-size: 0.9em;">Creador: <span style="color: #ffffff;">{{ $group->creator->username }}</span></p>
                </div>
            </a>
            <div class="ml-auto d-flex align-items-center">
                @if(auth()->check() && !$group->members->contains(auth()->user()))
                    @if($group->isFollowedBy(auth()->user()))
                        <form id="unfollow-form-{{ $group->id }}" action="{{ route('groups.unfollow', $group) }}" method="POST" style="margin-right: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-success" style="width: 50px; height: 40px;">
                                <img src="{{ asset('svg/siguiendo.png') }}" alt="Siguiendo" style="width: 24px; height: 24px;">
                            </button>
                        </form>
                    @else
                        <form action="{{ route('groups.follow', $group) }}" method="POST" style="margin-right: 10px;">
                            @csrf
                            <button type="submit" class="btn btn-primary" style="width: 50px; height: 40px;">
                                <img src="{{ asset('svg/adduser.png') }}" alt="Seguir" style="width: 24px; height: 24px;">
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection

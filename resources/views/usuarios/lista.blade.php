@extends('layouts.app')

@section('content')
<a href="{{ route('login') }}" style="text-decoration: none;">
    <div class="text-center mb-4 d-flex justify-content-center align-items-center" style="margin-top: 1.5rem; transform: translateX(-5px);">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="rounded-circle" style="width: 50px; height: 47px; margin-right: 3px;">
        <span style="color: white; font-size: 2rem; font-weight: bold;">CYPHER</span>
    </div>
</a>
<div class="container" style="background-color: #111827; padding: 2rem; border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @if ($filter === 'grupos')
                <h1 class="text-white mb-4 text-center">Lista de Grupos</h1>
                @foreach ($resultados as $group)
                <div class="card mb-3 mx-auto" style="background-color: #1f2937; border: 1px solid #4b5563; border-radius: 10px; max-width: 600px;">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <img src="{{ $group->imagen_perfil ? Storage::url($group->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="img-fluid" style="border-radius: 50%; width: 70px; height: 70px; margin: 10px;">
                        </div>
                        <div class="col-md-9 d-flex align-items-center justify-content-between">
                            <div class="card-body d-flex align-items-center" style="color: white; padding-left: 0;">
                                <div>
                                    <h5 class="card-title"><a href="{{ route('groups.show', $group->id) }}" class="group-link" style="text-decoration: none; color: inherit;">{{ $group->name }}</a></h5>
                                    <p class="card-text">
                                        <small class="text-muted" style="color: white;">Creador: {{ $group->creator->username }}</small>
                                    </p>
                                </div>
                            </div>
                            @if(auth()->check() && !$group->members->contains(auth()->user()))
                            <div class="d-flex align-items-center" style="padding-right: 15px;">
                                @if ($group->isFollowedBy(auth()->user()))
                                <form id="unfollow-form-{{ $group->id }}" action="{{ route('groups.unfollow', $group) }}" method="POST" class="ajax-form" data-id="{{ $group->id }}" data-action="unfollow">
                                    @csrf
                                    <button type="button" class="btn btn-success follow-btn" style="width: 50px; height: 40px;">
                                        <img src="{{ asset('svg/siguiendo.png') }}" alt="Siguiendo" style="width: 24px; height: 24px;">
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('groups.follow', $group) }}" method="POST" class="ajax-form" data-id="{{ $group->id }}" data-action="follow">
                                    @csrf
                                    <button type="button" class="btn btn-primary follow-btn" style="width: 50px; height: 40px;">
                                        <img src="{{ asset('svg/adduser.png') }}" alt="Seguir" style="width: 24px; height: 24px;">
                                    </button>
                                </form>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            @elseif ($filter === 'usuarios')
                <h1 class="text-white mb-4 text-center">Lista de Usuarios</h1>
                @foreach ($resultados as $usuario)
                <div class="card mb-3 mx-auto" style="background-color: #1f2937; border: 1px solid #4b5563; border-radius: 10px; max-width: 600px;">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-3 d-flex align-items-center justify-content-center">
                            <img src="{{ $usuario->imagen_perfil ?: asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="img-fluid" style="border-radius: 50%; width: 70px; height: 70px; margin: 10px;">
                        </div>
                        <div class="col-md-9 d-flex align-items-center justify-content-between">
                            <div class="card-body d-flex align-items-center" style="color: white; padding-left: 0;">
                                <div>
                                    <h5 class="card-title"><a href="{{ route('perfil.mostrar', ['username' => $usuario->username]) }}" class="user-link" style="text-decoration: none; color: inherit;">{{ $usuario->username }}</a></h5>
                                    <p class="card-text">
                                        <small class="text" style="color: grey;">{{ ucfirst($usuario->nombre) }} {{ ucfirst($usuario->apellido) }}</small>
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center" style="padding-right: 15px;">
                                @if(auth()->check() && $usuario->username != auth()->user()->username)
                                @if (auth()->user()->isFollowing($usuario))
                                <form id="unfollow-form-{{ $usuario->id }}" action="{{ route('usuario.unfollow', $usuario) }}" method="POST" class="ajax-form" data-id="{{ $usuario->id }}" data-action="unfollow">
                                    @csrf
                                    <button type="button" class="btn btn-success follow-btn" style="width: 50px; height: 40px;">
                                        <img src="{{ asset('svg/siguiendo.png') }}" alt="Siguiendo" style="width: 24px; height: 24px;">
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('usuario.follow', $usuario) }}" method="POST" class="ajax-form" data-id="{{ $usuario->id }}" data-action="follow">
                                    @csrf
                                    <button type="button" class="btn btn-primary follow-btn" style="width: 50px; height: 40px;">
                                        <img src="{{ asset('svg/adduser.png') }}" alt="Seguir" style="width: 24px; height: 24px;">
                                    </button>
                                </form>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @elseif ($filter === 'eventos')
                <h1 class="text-white mb-4 text-center" style="font-weight: bold;">Eventos</h1>

                @if ($resultados->isEmpty())
                <div class="text-center">
                    <a href="{{ route('events.create') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">+ Nuevo Evento</a>
                    <p class="text-muted" style="font-style: italic; color: #ffffff !important; margin-top: 100px;">No hay ningún evento todavía.</p>
                </div>
                @else
                <div class="text-center">
                    <a href="{{ route('events.create') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 20px;">+ Nuevo Evento</a>
                </div>

                <div class="row justify-content-center">
                    @foreach ($resultados as $event)
                    <div class="col-md-4">
                        <div class="card mb-3" style="background-color: #2c3e50; border-color: #4e5d6c; color: #ffffff; border-radius: 10px;">
                            @if ($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 250px; object-fit: cover; border-radius: 10px 10px 0 0;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title text-center" style="font-weight: bold;">{{ $event->name }}</h5>
                                <p class="card-text">{{ $event->description }}</p>
                                <p class="card-text" style="color:grey;"><small>Fecha: {{ \Carbon\Carbon::parse($event->event_date)->isoFormat('D [de] MMMM [de] YYYY') }}</small></p>
                                <p class="card-text" style="color:grey;"><small>Lugar: {{ ucfirst($event->location) }}</small></p>
                                <div class="position-absolute top-0 end-0 m-3 p-2 bg-white text-center" style="width: 70px; height: 75px; border-radius: 10px;">
                                    <p class="mb-0" style="color: black; font-weight: bold; font-size: 1.5rem;">{{ \Carbon\Carbon::parse($event->event_date)->format('d') }}</p>
                                    <p class="mb-0" style="color: black; font-weight: bold; font-size: 0.8rem;">{{ strtoupper(\Carbon\Carbon::parse($event->event_date)->shortMonthName) }}</p>
                                </div>
                                <a href="{{ route('events.show', $event) }}" class="btn btn-primary" style="width: 100%; background-color: #2563eb; border-color: #2563eb;">Ver Evento</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.ajax-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                handleFormSubmission(form);
            });
        });

        document.querySelectorAll('.follow-btn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.stopPropagation(); // Previene la redirección
                const form = button.closest('form');
                handleFormSubmission(form);
            });
        });

        function handleFormSubmission(form) {
            const formData = new FormData(form);
            const url = form.action;
            const method = form.method;
            const action = form.dataset.action;
            const id = form.dataset.id;

            fetch(url, {
                method: method,
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const button = form.querySelector('.follow-btn');
                    if (action === 'follow') {
                        button.innerHTML = '<img src="{{ asset('svg/siguiendo.png') }}" alt="Siguiendo" style="width: 24px; height: 24px;">';
                        button.classList.remove('btn-primary');
                        button.classList.add('btn-success');
                        form.dataset.action = 'unfollow';
                        form.action = form.action.replace('follow', 'unfollow');
                    } else {
                        button.innerHTML = '<img src="{{ asset('svg/adduser.png') }}" alt="Seguir" style="width: 24px; height: 24px;">';
                        button.classList.remove('btn-success');
                        button.classList.add('btn-primary');
                        form.dataset.action = 'follow';
                        form.action = form.action.replace('unfollow', 'follow');
                    }
                }
            });
        }
    });
</script>
@include('includes.fixed_button')
@endsection

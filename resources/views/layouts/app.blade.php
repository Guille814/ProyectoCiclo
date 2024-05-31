<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <title>Cypher</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #111827;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .container {
            max-width: 100%;
        }

        .navbar {
            background-color: #1f2937;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color: white;
        }

        .navbar-brand span {
            color: #2563eb;
            font-weight: bold;
        }

        .form-control {
            background-color: #374151;
            border: none;
            color: white;
        }

        .form-control::placeholder {
            color: #9ca3af;
        }

        .btn-search {
            background-color: #2563eb;
            border-color: #2563eb;
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        @media (max-width: 768px) {
            .navbar-center {
                position: relative;
                left: auto;
                transform: none;
                width: 100%;
                margin-top: 10px;
            }

            .navbar-center .form-control {
                width: calc(100% - 50px);
            }

            .btn-search {
                width: 50px;
            }
        }

        /* Custom style for the select dropdown */
        .custom-select-wrapper {
            position: relative;
            display: inline-block;
        }

        .custom-select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #374151;
            color: white;
            padding-right: 30px;
            /* Make space for the arrow */
        }

        .custom-select-arrow {
            position: absolute;
            top: 50%;
            right: 10px;
            margin-right: 5px;
            /* Añadir margen a la derecha */
            width: 0;
            height: 0;
            pointer-events: none;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid white;
            transform: translateY(-50%);
        }
    </style>
</head>

<body>
    <div id="app">
        @if (!in_array(Request::path(), ['login', 'register', '/', 'password/reset', 'password/email', 'password/confirm', 'admin/login', 'admin/register']))
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container position-relative">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 30px; height: 30px;">
                    <span>Cypher</span>
                </a>
                <form class="d-flex navbar-center" action="{{ route('usuarios.buscar') }}" method="GET">
                    <div class="custom-select-wrapper">
                        <select name="filter" class="form-control custom-select me-2" style="width: auto; margin-right: 5px;">
                            <option value="usuarios">Usuarios</option>
                            <option value="grupos">Grupos</option>
                            <option value="eventos">Eventos</option>
                        </select>
                        <span class="custom-select-arrow"></span>
                    </div>
                    <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Buscar">
                    <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
                </form>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('notifications.index') }}"><i class="fas fa-bell"></i></a>
                        </li>
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                        </li>
                        @endif
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="profileDropdownTrigger" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ Auth::user()->imagen_perfil ? asset(Auth::user()->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 30px; height: 30px;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdownTrigger">
                                <li><a class="dropdown-item" href="{{ route('perfil') }}">Mi Perfil</a></li>
                                <li><a class="dropdown-item" href="{{ route('groups.index') }}">Mis Grupos</a></li>
                                <li><a class="dropdown-item" href="{{ route('events.index', ['from' => 'user_menu']) }}">Mis Eventos</a></li>
                                @if (Request::is('perfil'))
                                <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#editProfileModal">Configuración</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('app.info') }}">Información de la Aplicación</a></li>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Cerrar sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    </li>
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('scripts')
</body>

</html>
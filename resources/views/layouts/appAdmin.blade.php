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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #112827;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Nunito', sans-serif;
        }

        .navbar {
            background-color: #1F3729;
            color: white;
        }

        .form-control {
            background-color: #374151;
            border: none;
            color: white;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.25);
        }

        .form-control:focus {
            border-color: #00C853;
            box-shadow: 0 0 0 0.2rem rgba(0, 200, 83, 0.25);
        }

        .btn-primary {
            background-color: #10b981;
            border-color: #10b981;
        }

        .card {
            background-color: #1f2937;
            border: 1px solid #4b5563;
            color: white;
        }

        .card-header {
            background-color: #1f2937;
            border-bottom: 1px solid #4b5563;
        }

        .modal-content {
            background-color: #1f2937;
            color: white;
        }

        .custom-select {
            background-color: #374151;
            color: white;
        }

        .custom-select:focus {
            border-color: #00C853;
            box-shadow: 0 0 0 0.2rem rgba(0, 200, 83, 0.25);
        }

        .btn-search {
            background-color: #10b981;
            border-color: #10b981;
        }

        .navbar-center {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>

</head>

<body>
    <div id="app">
        @if (!in_array(Request::path(), ['login', 'register', '/', 'password/reset', 'password/email', 'password/confirm', 'admin/login', 'admin/register']))
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 30px; height: 30px;">
                    <span>Cypher</span>
                </a>
                <div class="navbar-center">
                    <form class="form-inline" action="{{ route('usuarios.buscar') }}" method="GET">
                        <div class="custom-select-wrapper">
                            <select name="filter" class="form-control custom-select me-2" style="width: auto; margin-right: 5px;">
                                <option value="usuarios">Usuarios</option>
                                <option value="grupos">Grupos</option>
                            </select>
                            <span class="custom-select-arrow"></span>
                        </div>
                        <input class="form-control me-2" type="search" name="query" placeholder="Buscar" aria-label="Buscar">
                        <button class="btn btn-search" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/admin/dashboard') }}"><i class="fas fa-home"></i></a>
                    </li>
                    @guest

                    @else
                    <li class="nav-item dropdown">
                        <a id="profileDropdownTrigger" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth('admin')->user()->imagen_perfil ? asset(auth('admin')->user()->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 30px; height: 30px;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdownTrigger">
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
        </nav>
        @endif
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('scripts')
</body>

</html>
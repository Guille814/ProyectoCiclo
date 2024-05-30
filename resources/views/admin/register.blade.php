@extends('layouts.appAdmin')

@section('content')
<div class="container" style="background-color: #112827; min-height: 100vh; margin-top: 10px;">
    <div class="row justify-content-center">
        <!-- Logo y nombre de la aplicación fuera del cuadro del formulario -->
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CYPHER" style="width: 80px; height: 80px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">ADMIN CYPHER</h2>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card" style="border-radius: 10px; background-color: #1F3729; border: 1px solid #1F3729;">
                <div class="card-body" style="border-radius: 15px; padding: 20px;">
                    <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top: 10px;">
                        Regístrate aquí
                    </h3>
                    <form method="POST" action="{{ route('admin.register') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <label for="nombre" class="form-label" style="color: white; margin-left: 10px;">Nombre</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" required autofocus placeholder="Nombre" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; ::placeholder {color: #e0e0e0;}">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label" style="color: white; margin-left: 10px;">Apellido</label>
                            <input id="apellido" type="text" class="form-control" name="apellido" required autofocus placeholder="Apellido" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; ::placeholder {color: #e0e0e0;}">
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label" style="color: white; margin-left: 10px;">Nombre de usuario</label>
                            <input id="username" type="text" class="form-control" name="username" required autofocus placeholder="Nombre de usuario" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; ::placeholder {color: #e0e0e0;}">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label" style="color: white; margin-left: 10px;">Correo electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" required autocomplete="email" placeholder="nombre@correo.com" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; ::placeholder {color: #e0e0e0;}">
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label" style="color: white; margin-left: 10px;">Contraseña</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="••••••••" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; ::placeholder {color: #e0e0e0;}">
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" the="form-label" style="color: white; margin-left: 10px;">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar contraseña" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; ::placeholder {color: #e0e0e0;}">
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary" style="width: 50%; background-color: #00C853; border-color: #00C853; padding: 0.75rem; font-size: 0.9rem;">
                                Regístrate
                            </button>
                        </div>

                        <div class="col-12 text-start" style="margin-top: 20px; color: #6b7280; font-size: 0.9rem;">
                            ¿Ya tienes una cuenta? <a href="{{ route('admin.login') }}" style="color: #00C853; font-weight: bold; text-decoration: none;">Inicia sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

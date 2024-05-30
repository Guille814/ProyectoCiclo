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

        <div class="col-md-5">
            <div class="card" style="border-radius: 10px; background-color: #1F3729; border: 1px solid #1F3729;">
                <div class="card-body" style="border-radius: 15px;">
                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf
                        <h3 class="text-center mb-4" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 2rem; margin-top: 10px;">
                            Inicia sesión con tu cuenta
                        </h3>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="email" class="form-label" style="color: white; font-size: 1.0rem;">Email Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="nombre@correo.com" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem; ::placeholder {color: #e0e0e0;}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="password" class="form-label" style="color: white; font-size: 1.0rem;">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••" style="background-color: #2C4B3A; color: white; border: none; padding: 0.75rem; margin-bottom: 0.5rem; font-size: 0.9rem; ::placeholder {color: #e0e0e0;}">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
<!--
                        <div class="mb-3 d-flex justify-content-between" style="width: 90%; margin: 0 auto;">
                            <div class="form-check" style="color: #6b7280; font-size: 0.9rem;">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="background-color: #374151; border-color: #374151;">
                                <label class="form-check-label" for="remember" style="margin-left: 0.5rem;">
                                    Remember Me
                                </label>
                            </div>
                            <a class="text-sm font-medium" href="{{ route('password.request') }}" style="color: #00C853; font-weight: bold; text-decoration: none;">Forgot Your Password?</a>
                        </div>
-->
                        <div class="mb-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" style="width: 90%; background-color: #00C853; border-color: #00C853; padding: 0.75rem; font-size: 0.9rem;">
                                Inicia Sesion
                            </button>
                        </div>

                        <div class="mb-3 d-flex justify-content-between" style="width: 100%; margin: 0 auto;">
                            <div class="form-check" style="color: #6b7280; font-size: 0.9rem;">
                                ¿No tienes cuenta? <a class="text-sm font-medium" href="{{ route('admin.register') }}" style="color: #00C853; font-weight: bold; text-decoration: none; margin-left: 3px;">Regístrate</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

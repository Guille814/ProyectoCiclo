@include('layouts.app')

<div class="container" style="background-color: #111827; min-height: 100vh; margin-top: 10px;">
    <div class="row justify-content-center">
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CYPHER" style="width: 80px; height: 76px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">CYPHER</h2>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card" style="border-radius: 10px; background-color: #1f2937; border: 1px solid #4b5563;">
                <div class="card-body" style="border-radius: 15px; padding: 20px;">
                    <h3 class="text-center" style="color: white; font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">Registrate aquí</h3>
                    <form method="POST" action="{{ route('register') }}" class="row g-3">
                        @csrf

                        <div class="col-md-6">
                            <label for="nombre" class="form-label" style="color: white; margin-left: 10px;">Nombre</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required autofocus placeholder="Nombre" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                        </div>
                        <div class="col-md-6">
                            <label for="apellido" class="form-label" style="color: white; margin-left: 10px;">Apellido</label>
                            <input id="apellido" type="text" class="form-control" name="apellido" value="{{ old('apellido') }}" required autofocus placeholder="Apellido" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                        </div>

                        <div class="col-md-6">
                            <label for="username" class="form-label" style="color: white; margin-left: 10px;">Username</label>
                            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus placeholder="Username" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label" style="color: white; margin-left: 10px;">Email Address</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label" style="color: white; margin-left: 10px;">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label" style="color: white; margin-left: 10px;">Confirm Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary" style="width: 50%; background-color: #2563eb; border-color: #2563eb; padding: 0.75rem; margin-top: 20px;">
                                Registrate
                            </button>
                        </div>

                        <div class="col-12 text-start" style="margin-top: 20px; color: #6b7280; font-size: 0.9rem;">
                            {{ __('¿Ya tienes una cuenta?') }}
                            <a href="{{ route('login') }}" style="color: #3b82f6; font-weight: bold; text-decoration: none;">Inicia sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

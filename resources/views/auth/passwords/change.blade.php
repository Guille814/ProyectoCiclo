@extends('layouts.app')

@section('content')
<div class="container" style="background-color: #111827; min-height: 100vh; padding-top: 10px;">
    <div class="row justify-content-center">
        <!-- Logo y nombre de la aplicación fuera del cuadro del formulario -->
        <div class="text-center mb-4">
            <div style="display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('images/logo.png') }}" alt="Logo CYPHER" style="width: 80px; height: 80px;">
                <h2 style="color: white; margin-left: 20px; font-size: 2.5rem; font-weight: bold;">CYPHER</h2>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card" style="border-radius: 10px; background-color: #1f2937; border: 1px solid #4b5563;">
                <div class="card-header text-center" style="background-color: #1f2937; color: white; font-size: 1.5rem; font-weight: bold; border-bottom: 1px solid #4b5563;">
                    Cambiar Contraseña
                </div>
                <div class="card-body" style="border-radius: 15px;">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <!-- Current Password -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="current_password" class="form-label" style="color: white; font-size: 1.0rem;">Contraseña Actual</label>
                            <div class="input-group">
                                <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autocomplete="current-password" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color: #374151; border: none; cursor: pointer;" onclick="togglePasswordVisibility('current_password')">
                                        <i class="fa fa-eye" id="toggle-current_password"></i>
                                    </span>
                                </div>
                            </div>
                            @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="password" class="form-label" style="color: white; font-size: 1.0rem;">Nueva Contraseña</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color: #374151; border: none; cursor: pointer;" onclick="togglePasswordVisibility('password')">
                                        <i class="fa fa-eye" id="toggle-password"></i>
                                    </span>
                                </div>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div class="mb-4 text-start" style="margin-left: 1rem; margin-right: 1rem;">
                            <label for="password_confirmation" class="form-label" style="color: white; font-size: 1.0rem;">Confirmar Nueva Contraseña</label>
                            <div class="input-group">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" style="background-color: #374151; color: white; border: none; padding: 0.75rem;">
                                <div class="input-group-append">
                                    <span class="input-group-text" style="background-color: #374151; border: none; cursor: pointer;" onclick="togglePasswordVisibility('password_confirmation')">
                                        <i class="fa fa-eye" id="toggle-password_confirmation"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0 justify-content-center">
                            <div class="col-md-6 text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #2563eb; color: white; border-radius: 10px; padding: 10px 20px;">
                                    Cambiar Contraseña
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById('toggle-' + fieldId);
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection

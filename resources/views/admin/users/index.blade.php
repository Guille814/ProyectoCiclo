@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <style>
        .table tbody tr:nth-child(even) {
            background-color: #374151;
        }
        .table tbody tr:nth-child(odd) {
            background-color: #1f2937;
        }
        .table tbody tr {
            color: white;
        }
    </style>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: #1f2937; border-bottom: 1px solid #4b5563;">{{ __('Lista de Usuarios') }}</div>

                <div class="card-body" style="background-color: #1f2937;">
                    <table class="table" style="width: 100%; border-collapse: collapse; background-color: #1f2937; color: white;">
                        <thead>
                            <tr style="background-color: #1f2937;">
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">ID</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Imagen de Perfil</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Nombre</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Apellido</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Username</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $usuario->id }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">
                                    <img src="{{ $usuario->imagen_perfil ? asset($usuario->imagen_perfil) : asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $usuario->nombre }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $usuario->apellido }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $usuario->username }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.users.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar al usuario {{ $usuario->username }}?');">
                                            <i class="fas fa-trash-alt"></i> 
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

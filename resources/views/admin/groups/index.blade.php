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
                <div class="card-header" style="background-color: #1f2937; border-bottom: 1px solid #4b5563;">{{ __('Lista de Grupos') }}</div>

                <div class="card-body" style="background-color: #1f2937;">
                    <table class="table" style="width: 100%; border-collapse: collapse; background-color: #1f2937; color: white;">
                        <thead>
                            <tr style="background-color: #1f2937;">
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">ID</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Imagen de Perfil</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Nombre</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Creador</th>
                                <th scope="col" style="padding: 12px; border-bottom: 1px solid #4b5563;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $group->id }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">
                                    <img src="{{ $group->imagen_perfil ? asset($group->imagen_perfil) : asset('profile_pictures/default_group_picture.png') }}" alt="Perfil" class="rounded-circle" style="width: 30px; height: 30px;">
                                </td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $group->name }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">{{ $group->creator->username }}</td>
                                <td style="padding: 12px; border-bottom: 1px solid #4b5563;">
                                    <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de querer eliminar este grupo?')">
                                            <i class="fas fa-trash-alt"></i> Eliminar
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
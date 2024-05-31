@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="background-color: #1F3729; color: white;">
                    <h4>{{ __('Información de la Aplicación Administrativa') }}</h4>
                </div>

                <div class="card-body" style="background-color: #112827; color: white;">
                    <p><em>Bienvenido a la aplicación administrativa de la red social Cypher. Aquí, los administradores pueden gestionar diversos aspectos de la plataforma, incluyendo usuarios, grupos musicales y eventos.</em></p>
                    <p><em>Funciones disponibles:</em></p>
                    <ul>
                        <li><em>Gestión de usuarios: permite ver, editar y eliminar usuarios.</em></li>
                        <li><em>Gestión de grupos musicales: permite ver, editar y eliminar grupos musicales.</em></li>
                        <li><em>Gestión de eventos: permite ver, editar y eliminar eventos.</em></li>
                        <li><em>Listado de reportes: permite ver y gestionar los reportes de usuarios.</em></li>
                        <li><em>Chat de administradores: facilita la comunicación entre administradores.</em></li>
                    </ul>
                    <p><em>Esta aplicación está diseñada para proporcionar un control completo y eficiente sobre las operaciones y contenidos de la red social Cypher.</em></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

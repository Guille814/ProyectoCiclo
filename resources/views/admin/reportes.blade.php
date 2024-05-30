@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Lista de Reportes') }}</div>

                <div class="card-body" style="overflow-x:auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">ID del Usuario</th>
                                <th scope="col">ID del Contenido</th>
                                <th scope="col">Tipo de Contenido</th>
                                <th scope="col">Motivo</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Fecha de Creación</th>
                                <th scope="col">Fecha de Actualización</th>
                                <th scope="col">Número de Reportes</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->id }}</td>
                                <td>{{ $report->user_id }}</td>
                                <td>{{ $report->reportable_id }}</td>
                                <td>{{ $report->reportable_type }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>
                                    <a href="#" class="description-link" data-description="{{ $report->description }}" style="text-decoration: none; color: inherit;">
                                        {{ Str::limit($report->description, 30) }}
                                    </a>
                                </td>
                                <td>{{ $report->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $report->updated_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $reportCounts[$report->reportable_type . '_' . $report->reportable_id]->total_reports ?? 0 }}</td>
                                <td>
                                    <form action="{{ route('admin.reports.destroy', $report->reportable_id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este reporte?');">
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

<!-- Modal para mostrar la descripción completa -->
<div class="modal fade" id="descriptionModal" tabindex="-1" role="dialog" aria-labelledby="descriptionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #1f2937; color: white;">
            <div class="modal-header">
                <h5 class="modal-title" id="descriptionModalLabel">Descripción Completa del Reporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modalDescriptionText"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var descriptionLinks = document.querySelectorAll('.description-link');
        descriptionLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var description = this.getAttribute('data-description');
                document.getElementById('modalDescriptionText').innerText = description;
                $('#descriptionModal').modal('show');
            });
        });

        // Asegúrate de que el botón de cerrar funcione
        document.querySelectorAll('.close, .btn-secondary').forEach(function(button) {
            button.addEventListener('click', function() {
                $('#descriptionModal').modal('hide');
            });
        });
    });
</script>
@endsection

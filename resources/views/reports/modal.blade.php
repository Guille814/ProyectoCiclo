<!-- Modal de Reporte -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportModalLabel">Reportar contenido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="reportForm">
                    @csrf
                    <input type="hidden" name="reportable_id" id="reportable_id">
                    <input type="hidden" name="reportable_type" id="reportable_type">
                    <div class="mb-3">
                        <label for="reason" class="form-label">Motivo</label>
                        <select class="form-select" id="reason" name="reason" required>
                            <option value="spam">Spam</option>
                            <option value="abuse">Abuso</option>
                            <option value="inappropriate">Contenido inapropiado</option>
                            <option value="other">Otro</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción (opcional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar reporte</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const reportButtons = document.querySelectorAll('.report-button');
        const reportForm = document.getElementById('reportForm');
        const reportableIdInput = document.getElementById('reportable_id');
        const reportableTypeInput = document.getElementById('reportable_type');
        const reportModal = new bootstrap.Modal(document.getElementById('reportModal'));

        reportButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault(); // Prevenir el comportamiento predeterminado
                reportForm.reset(); // Limpiar el formulario
                const id = this.getAttribute('data-id');
                const type = this.getAttribute('data-type');

                reportableIdInput.value = id;
                reportableTypeInput.value = type;

                reportModal.show();
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const closeButton = document.querySelector('.btn-close');
            const reportModal = document.getElementById('reportModal');

            closeButton.addEventListener('click', function() {
                const modalInstance = bootstrap.Modal.getInstance(reportModal);
                modalInstance.hide();
            });
        });

        reportForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el comportamiento predeterminado del formulario

            const formData = new FormData(this);

            fetch('{{ route("reports.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Reporte enviado exitosamente.');
                        reportModal.hide();
                        reportForm.reset(); // Limpiar el formulario después de enviar
                    } else {
                        alert('Hubo un error al enviar el reporte.');
                    }
                });
        });
    });
</script>
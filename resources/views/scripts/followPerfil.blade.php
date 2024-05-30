<script>
    function confirmUnfollow() {
        if (confirm("¿Seguro que quieres dejar de seguir a {{$usuario->username}}?")) {
            document.getElementById("unfollow-form").submit();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.ajax-form').forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(form);
                const url = form.action;
                const method = form.method;
                const action = form.dataset.action;
                const id = form.dataset.id;
                
                fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const button = form.querySelector('.follow-btn');
                        if (action === 'follow') {
                            button.innerHTML = 'Siguiendo';
                            button.classList.remove('btn-primary');
                            button.classList.add('btn-success');
                            form.dataset.action = 'unfollow';
                            form.action = form.action.replace('follow', 'unfollow');
                        } else {
                            button.innerHTML = 'Seguir';
                            button.classList.remove('btn-success');
                            button.classList.add('btn-primary');
                            form.dataset.action = 'follow';
                            form.action = form.action.replace('unfollow', 'follow');
                        }
                    }
                });
            });
        });
    });
</script>
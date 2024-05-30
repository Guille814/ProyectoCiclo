<script>
    function toggleElementVisibility(element) {
        if (element.style.display === 'none' || element.style.display === '') {
            element.style.display = 'block';
        } else {
            element.style.display = 'none';
        }
    }

    function toggleComments(button) {
        const commentList = button.closest('.comments').querySelector('.comment-list');
        toggleElementVisibility(commentList);
        button.querySelector('img').src = commentList.style.display === 'none' ? '{{ asset('svg/fecha-abajo.png') }}' : '{{ asset('svg/fecha-arriba.png') }}';
    }

    function toggleCommentForm(button) {
        const form = button.closest('.post-card').querySelector('.comment-form');
        form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        button.querySelector('img').src = form.style.display === 'block' ? '{{ asset('svg/equis.png') }}' : '{{ asset('svg/comentario.png') }}';
    }

    function togglePostForm() {
        const formCard = document.getElementById('postFormCard');
        toggleElementVisibility(formCard);
    }

    $(document).ready(function() {
        $('.like-button').click(function(e) {
            e.preventDefault();
            let button = $(this);
            const postId = button.data('post-id');
            const isLiked = button.data('liked');
            const url = isLiked ? `/post/${postId}/unlike` : `/post/${postId}/like`;
            const method = isLiked ? 'DELETE' : 'POST';

            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                data: { _method: method },
                success: function(response) {
                    $('#likes-count-' + postId).text(response.likesCount + ' ' + (response.likesCount === 1 ? 'Me gusta' : 'Me gustas'));
                    const newIcon = !isLiked ? '{{ asset('svg/like.png') }}' : '{{ asset('svg/unlike.png') }}';
                    $('#like-icon-' + postId).attr('src', newIcon);
                    button.data('liked', !isLiked);
                }
            });
        });

        $('.submit-comment').click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            var data = {
                post_id: form.find('input[name="post_id"]').val(),
                user_id: '{{ auth()->id() }}',
                contenido: form.find('textarea[name="contenido"]').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('comment.store') }}',
                method: 'POST',
                data: data,
                success: function(response) {
                    var userId = '{{ auth()->id() }}';
                    var postUserId = form.find('input[name="post_user_id"]').val();
                    var canDelete = response.user_id == userId || postUserId == userId;
                    var deleteHtml = canDelete ? `<a href="#" class="delete-comment btn btn-link" data-comment-id="${response.id}" style="text-decoration: none; color: black;">Eliminar comentario</a>` : '';
                    var newCommentHtml = `<div class="comment mb-3 d-flex justify-content-between" data-comment-id="${response.id}">
                        <div class="d-flex align-items-center">
                            <img src="${response.profile_picture ? '{{ url('/') }}/' + response.profile_picture : '{{ asset('profile_pictures/default_profile_picture.png') }}'}" alt="Perfil" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                            <div>
                                <p class="mb-1"><strong>${response.username}</strong> (${response.created_at})</p>
                                <p class="mb-0">${response.contenido}</p>
                            </div>
                        </div>
                        <div class="comment-actions" style="margin-right: 15px;">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: white;">
                                &#8942;
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                ${deleteHtml}
                                <a class="dropdown-item" href="#">Denunciar comentario</a>
                            </div>
                        </div>
                    </div>`;
                    $(form).closest('.post-card').find('.comment-list').append(newCommentHtml);
                    form.find('textarea[name="contenido"]').val('');
                },
                error: function(xhr) {
                    alert('Error al publicar comentario: ' + xhr.responseText);
                }
            });
        });

        $(document).on('click', '.delete-comment', function(e) {
            e.preventDefault();
            let button = $(this);
            let id = button.data('comment-id');
            let url = `/comment/${id}`;

            if (confirm('¿Estás seguro de que deseas eliminar este comentario?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function(response) {
                        if (response.success) {
                            button.closest('.comment').remove();
                            alert('Comentario eliminado exitosamente');
                        } else {
                            alert('No se pudo eliminar el comentario: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error al eliminar comentario: ' + xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chat de Administradores</div>
                <div class="card-body">
                    <div class="overflow-auto" style="max-height: 400px;">
                        <div id="chat-messages" class="chat-messages">
                            @foreach($messages->reverse() as $message)
                            <div class="chat-message mb-3">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        @if($message->admin)
                                            <img src="{{ $message->admin->imagen_perfil ? asset($message->admin->imagen_perfil) : '/images/logo.png' }}" alt="Perfil" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                                        @else
                                            <img src="{{ asset('profile_pictures/default_profile_picture.png') }}" alt="Perfil default" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                        @endif
                                    </div>
                                    <div class="col">
                                        @if($message->admin)
                                            <div class="user-info">
                                                <span class="font-weight-bold">{{ $message->admin->username }}</span> |
                                                <span style="color:grey;">{{ $message->admin->nombre }} {{ $message->admin->apellido }}</span> |
                                                <span style="color:grey;">{{ $message->admin->email }}</span>
                                            </div>
                                        @else
                                            <div class="user-info">
                                                <span class="font-weight-bold">Admin desconocido</span>
                                            </div>
                                        @endif
                                        <div class="message-content">
                                            <p>{{ $message->message }}</p>
                                            <span class="text-muted small">{{ $message->created_at->format('d/m/Y H:i') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">Enviar Mensaje</div>
                <div class="card-body">
                    <form id="chat-form" method="POST" action="{{ route('admin.chat.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <textarea id="message" class="form-control @error('message') is-invalid @enderror" name="message" required></textarea>
                            @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Enviar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const chatForm = document.getElementById('chat-form');
        const chatMessages = document.getElementById('chat-messages');

        chatForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(chatForm);

            fetch(chatForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const message = data.message;
                const admin = message.admin;

                const imageUrl = admin && admin.imagen_perfil ? `{{ url('') }}/${admin.imagen_perfil}` : `/images/logo.png`;

                const messageElement = document.createElement('div');
                messageElement.classList.add('chat-message', 'mb-3');
                messageElement.innerHTML = `
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img src="${imageUrl}" alt="Perfil" class="rounded-circle me-2" style="width: 50px; height: 50px;">
                        </div>
                        <div class="col">
                            <div class="user-info">
                                <span class="font-weight-bold">${admin ? admin.username : 'Admin desconocido'}</span> |
                                <span style="color:grey;">${admin ? admin.nombre : ''} ${admin ? admin.apellido : ''}</span> |
                                <span style="color:grey;">${admin ? admin.email : ''}</span>
                            </div>
                            <div class="message-content">
                                <p>${message.message}</p>
                                <span class="text-muted small">${new Date(message.created_at).toLocaleString()}</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                `;

                chatMessages.appendChild(messageElement);
                chatForm.reset();
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endsection

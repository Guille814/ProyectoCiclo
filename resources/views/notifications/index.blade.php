@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notificaciones</h1>
    @if($notifications->isEmpty())
        <p>No tienes notificaciones.</p>
    @else
        <ul class="list-group">
            @foreach($notifications as $notification)
                @php
                    $data = json_decode($notification->data);
                @endphp
                <li class="list-group-item {{ $notification->read ? '' : 'list-group-item-info' }}">
                    {{ $data->message }}
                    <span class="float-right">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection

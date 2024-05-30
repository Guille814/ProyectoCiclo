@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">{{ __('Detalle del Reporte') }}</div>
        <div class="card-body">
            <h5>ID del Contenido Reportado: <strong>{{ $reportable->id }}</strong></h5>
            <h5>Tipo de Contenido Reportado: <strong>{{ $reportableType }}</strong></h5>

            @if ($reportable instanceof \App\Models\User)
                @include('admin.reports.partials.user_profile', ['user' => $reportable])
            @elseif ($reportable instanceof \App\Models\Post)
                @include('admin.reports.partials.post_details', ['post' => $reportable])
            @elseif ($reportable instanceof \App\Models\Comment)
                @include('admin.reports.partials.comment_details', ['comment' => $reportable])
            @endif

            <a href="{{ route('admin.reportes') }}" class="btn btn-primary">Volver</a>
            <a href="/perfil/{{ $reportable->username ?? '' }}" target="_blank" class="btn btn-info">Ver Perfil</a>
        </div>
    </div>
</div>
@endsection

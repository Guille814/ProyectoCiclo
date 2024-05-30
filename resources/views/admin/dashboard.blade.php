@extends('layouts.appAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center" style="background-color: #1F3729; color: white;">
                    <h4>{{ __('Panel de Administración') }}</h4>
                </div>

                <div class="card-body" style="background-color: #112827;">
                    <div class="row">
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card-body text-center p-4">
                                <a href="{{ route('admin.users') }}" class="btn btn-primary w-100 p-3" style="background-color: #10b981; border: none;">
                                    <i class="fas fa-users fa-2x mb-2"></i>
                                    <div>Usuarios</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card-body text-center p-4">
                                <a href="{{ route('admin.reportes') }}" class="btn btn-warning w-100 p-3" style="background-color: #f59e0b; border: none;">
                                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                                    <div>Reportes</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card-body text-center p-4">
                                <a href="{{ route('admin.chat') }}" class="btn btn-success w-100 p-3" style="background-color: #3b82f6; border: none;">
                                    <i class="fas fa-comments fa-2x mb-2"></i>
                                    <div>Chat Admins</div>
                                </a>
                            </div>
                        </div>
                        <!-- New buttons -->
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card-body text-center p-4">
                                <a href="{{ route('admin.groups.index') }}" class="btn btn-warning w-100 p-3" style="background-color: #f59e0b; border: none;">
                                    <i class="fas fa-music fa-2x mb-2"></i>
                                    <div>Grupos Musicales</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-12 col-md-4 mb-3">
                            <div class="card-body text-center p-4">
                                <a href="{{ route('admin.events.index') }}" class="btn btn-warning w-100 p-3" style="background-color: #f59e0b; border: none;">
                                    <i class="fas fa-calendar-alt fa-2x mb-2"></i>
                                    <div>Eventos</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
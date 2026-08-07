@extends('adminlte::page')

@section('title', 'Detalles del Usuario')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Usuarios</h1>
            <small class="text-muted">Detalles y expediente del usuario</small>
        </div>
        <div>
            <a href="{{ route('indexUsuario') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm mr-1">
                <i class="fas fa-arrow-left mr-1"></i> Regresar
            </a>
            <a href="{{ route('editUsuario', $usuario->id) }}" class="btn btn-purple font-weight-bold shadow-sm mr-1">
                <i class="fas fa-pen mr-1"></i> Editar
            </a>
            <button class="btn btn-outline-danger font-weight-bold shadow-sm" id="deleteButton" data-id="{{ $usuario->id }}">
                <i class="fas fa-trash mr-1"></i> Eliminar
            </button>
        </div>
    </div>
@stop

@section('content')

<!-- Alertas SweetAlert2 -->
@if(session('update'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Datos actualizados exitosamente!',
            text: "{{ session('update') }}",
            icon: 'success',
            confirmButtonColor: '#6f42c1',
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endif

<div class="card card-outline card-purple shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h3 class="card-title font-weight-bold text-dark mb-0">
            <i class="fas fa-id-card text-purple mr-2"></i> Información Registrada
        </h3>
    </div>

    <div class="card-body p-4">
        <div class="row">
            <!-- Detalles en tabla limpia -->
            <div class="col-md-8">
                <table class="table table-borderless table-striped align-middle rounded border overflow-hidden">
                    <tbody>
                        <tr>
                            <td class="font-weight-bold text-secondary" style="width: 25%;">
                                <i class="fas fa-user text-purple mr-2"></i>Nombre
                            </td>
                            <td class="font-weight-bold text-dark">{{ $usuario->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-secondary">
                                <i class="fas fa-envelope text-purple mr-2"></i>Correo
                            </td>
                            <td>
                                <a href="mailto:{{ $usuario->email }}" class="link-purple text-decoration-none">
                                    {{ $usuario->email }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-secondary">
                                <i class="fas fa-briefcase text-purple mr-2"></i>Cargo
                            </td>
                            <td class="text-dark">{{ $usuario->cargo ?? 'No especificado' }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-secondary">
                                <i class="fas fa-building text-purple mr-2"></i>Área
                            </td>
                            <td class="text-dark">{{ $usuario->id_area_label }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold text-secondary">
                                <i class="fas fa-layer-group text-purple mr-2"></i>Nivel
                            </td>
                            <td>
                                <span class="badge badge-soft-purple px-3 py-1 font-weight-bold">
                                    {{ $usuario->nivel_label }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Panel Vista Previa Firma -->
            <div class="col-md-4 text-center d-flex flex-column align-items-center justify-content-center p-3 bg-light rounded border">
                <label class="font-weight-bold text-secondary mb-3">
                    <i class="fas fa-file-signature text-purple mr-1"></i> Firma Autógrafa Registrada
                </label>
                @if($usuario->firma)
                    <div class="p-2 bg-white rounded border shadow-sm w-100 mb-2">
                        <img src="{{ asset($usuario->firma) }}" alt="Firma Usuario" class="img-fluid" style="max-height: 160px; object-fit: contain;">
                    </div>
                @else
                    <div class="p-4 bg-white rounded border w-100 text-muted">
                        <i class="fas fa-signature fa-2x mb-2 d-block text-secondary"></i>
                        <small>Sin firma adjunta</small>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
<style>
    /* Identidad Morada Institucional */
    .text-purple { color: #6f42c1 !important; }

    .link-purple {
        color: #6f42c1;
        transition: color 0.2s;
    }
    .link-purple:hover {
        color: #5a32a3;
        text-decoration: underline;
    }

    .card-purple.card-outline {
        border-top: 3px solid #6f42c1;
    }

    .btn-purple {
        background-color: #6f42c1;
        color: #ffffff;
        border-color: #6f42c1;
        transition: all 0.2s ease;
    }
    .btn-purple:hover {
        background-color: #5a32a3;
        color: #ffffff;
        border-color: #5a32a3;
        transform: translateY(-1px);
    }

    /* Badge Morado Suave */
    .badge-soft-purple {
        background-color: #f3e8ff;
        color: #6f42c1;
        border: 1px solid #e9d5ff;
    }

    .table td {
        padding: 1rem 0.75rem;
    }
</style>
@stop

@section('js')
<script>
    document.getElementById('deleteButton').addEventListener('click', function () {
        var userId = this.getAttribute('data-id');
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción eliminará el registro de forma permanente.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-check mr-1"></i> Sí, eliminar',
            cancelButtonText: '<i class="fas fa-ban mr-1"></i> Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/admin/deteleUser/' + userId;
            }
        });
    });
</script>
@stop
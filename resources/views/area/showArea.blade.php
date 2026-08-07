@extends('adminlte::page')

@section('title', 'Detalles del Área')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Áreas</h1>
            <small class="text-muted">Consulta de información general del área</small>
        </div>
        <div>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('indexArea') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm mr-1">
                    <i class="fas fa-arrow-left mr-1"></i> Regresar
                </a>
                <a href="{{ route('editArea', $area->id) }}" class="btn btn-purple font-weight-bold shadow-sm mr-1">
                    <i class="fas fa-edit mr-1"></i> Editar
                </a>
                <button class="btn btn-outline-danger font-weight-bold shadow-sm" id="deleteButton" data-id="{{ $area->id }}">
                    <i class="fas fa-trash-alt mr-1"></i> Eliminar
                </button>
            @else
                <a href="{{ route('misAreas') }}" class="btn btn-purple font-weight-bold shadow-sm">
                    <i class="fas fa-th-list mr-1"></i> Mis Áreas
                </a>
            @endif
        </div>
    </div>
@stop

@section('content')

<!-- Alerta de Actualización Exitosa -->
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

<!-- Formulario Oculto para Eliminación Segura (POST/DELETE) -->
<form id="deleteForm" action="{{ route('deleteArea', $area->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<div class="card card-outline card-purple shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
        <h3 class="card-title font-weight-bold text-dark mb-0">
            <i class="fas fa-info-circle text-purple mr-2"></i> Información Institucional
        </h3>
        <span class="badge badge-light border px-3 py-2 text-purple font-weight-bold">
            Siglas: {{ $area->siglas }}
        </span>
    </div>

    <div class="card-body p-4">
        <!-- Ficha Informativa Estructurada -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-light">
                    <label class="text-muted small font-weight-bold text-uppercase d-block mb-1">
                        <i class="fas fa-building text-purple mr-1"></i> Nombre del Área
                    </label>
                    <span class="h5 font-weight-bold text-dark mb-0">{{ $area->nombre }}</span>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-light">
                    <label class="text-muted small font-weight-bold text-uppercase d-block mb-1">
                        <i class="fas fa-user text-purple mr-1"></i> Responsable
                    </label>
                    <span class="h5 font-weight-bold text-dark mb-0">{{ $area->responsable }}</span>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-light">
                    <label class="text-muted small font-weight-bold text-uppercase d-block mb-1">
                        <i class="fas fa-envelope text-purple mr-1"></i> Correo de Notificación
                    </label>
                    <a href="mailto:{{ $area->correo }}" class="h6 font-weight-bold link-purple text-decoration-none mb-0">
                        {{ $area->correo }}
                    </a>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="p-3 border rounded bg-light">
                    <label class="text-muted small font-weight-bold text-uppercase d-block mb-1">
                        <i class="fas fa-phone-alt text-purple mr-1"></i> Extensión
                    </label>
                    <span class="h6 font-weight-bold text-dark mb-0">
                        {{ $area->extension ? $area->extension : 'Sin extensión registrada' }}
                    </span>
                </div>
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
    /* Estilos Generales Morados */
    .text-purple { color: #6f42c1 !important; }

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

    .link-purple {
        color: #6f42c1;
        transition: color 0.2s;
    }
    .link-purple:hover {
        color: #5a32a3;
        text-decoration: underline;
    }
</style>
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteBtn = document.getElementById('deleteButton');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function () {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: 'Esta acción eliminará el registro de forma permanente.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Envío del formulario de eliminación oculto
                        document.getElementById('deleteForm').submit();
                    }
                });
            });
        }
    });
</script>
@stop
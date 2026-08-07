@extends('adminlte::page')

@section('title', 'Editar Directorio')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Directorio</h1>
            <small class="text-muted">Editar información de contacto del área</small>
        </div>
        <div>
            <a href="{{ route('directorioIndex') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Regresar
            </a>
        </div>
    </div>
@stop

@section('content')

<!-- Alerta SweetAlert2 -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Registro completado!',
            text: "{{ session('success') }}",
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
            <i class="fas fa-building text-purple mr-2"></i> Área: {{ $area->nombre }}
        </h3>
    </div>

    <form action="{{ route('directorioUpdate', $area->id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="card-body p-4">
            <div class="row">
                <!-- Responsable -->
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Responsable</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-purple"></i></span>
                        </div>
                        <input type="text" name="responsable" id="responsable" class="form-control @error('responsable') is-invalid @enderror" value="{{ old('responsable', $area->responsable) }}" placeholder="Nombre del responsable">
                        @error('responsable')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Correo Electrónico -->
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-purple"></i></span>
                        </div>
                        <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $area->correo) }}" placeholder="ejemplo@dominio.com">
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Extensión -->
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Extensión</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-phone-alt text-purple"></i></span>
                        </div>
                        <input type="text" name="extension" id="extension" class="form-control @error('extension') is-invalid @enderror" value="{{ old('extension', $area->extension) }}" placeholder="Ej. 104">
                        @error('extension')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light d-flex justify-content-end py-3">
            <button type="submit" class="btn btn-purple font-weight-bold px-4 shadow-sm">
                <i class="fas fa-sync-alt mr-1"></i> Actualizar Datos
            </button>
        </div>
    </form>
</div>
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
<style>
    /* Identidad Morada Institucional */
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

    /* Enfoque para controles del formulario */
    .form-control:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.15);
    }

    /* Ajuste visual para input groups */
    .input-group-text {
        border-right: none;
    }
    .input-group .form-control {
        border-left: none;
    }
    .input-group:focus-within .input-group-text {
        border-color: #6f42c1;
    }
</style>
@stop

@section('js')
<script>
    console.log("Directorio Edit - Loaded");
</script>
@stop
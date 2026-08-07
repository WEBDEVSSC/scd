@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Usuarios</h1>
            <small class="text-muted">Modificación de expediente de usuario</small>
        </div>
        <div>
            <a href="{{ route('indexUsuario') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm mr-1">
                <i class="fas fa-arrow-left mr-1"></i> Regresar
            </a>
            <a href="{{ route('showUsuario', $usuario->id) }}" class="btn btn-outline-purple font-weight-bold shadow-sm">
                <i class="fas fa-id-card mr-1"></i> Detalles
            </a>
        </div>
    </div>
@stop

@section('content')

<div class="card card-outline card-purple shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h3 class="card-title font-weight-bold text-dark mb-0">
            <i class="fas fa-user-edit text-purple mr-2"></i> Formulario de Edición
        </h3>
    </div>

    <form action="{{ route('updateUsuario', $usuario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body p-4">
            <!-- Primera Fila: Nombre, E-mail y Contraseña -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Nombre Completo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-purple"></i></span>
                        </div>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $usuario->name) }}" placeholder="Nombre completo">
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-purple"></i></span>
                        </div>
                        <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $usuario->email) }}" placeholder="ejemplo@dominio.com">
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">
                        Contraseña
                        <i class="fas fa-info-circle text-muted ml-1" data-toggle="tooltip" title="Dejar en blanco para conservar la contraseña actual"></i>
                    </label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-lock text-purple"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Segunda Fila: Cargo, Relación Área, Nivel y Firma -->
            <div class="row mt-2">
                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Cargo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-id-badge text-purple"></i></span>
                        </div>
                        <input type="text" name="cargo" class="form-control @error('cargo') is-invalid @enderror" value="{{ old('cargo', $usuario->cargo) }}" placeholder="Cargo institucional">
                        @error('cargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Relación Área</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-building text-purple"></i></span>
                        </div>
                        <select name="id_area" id="id_area" class="form-control custom-select @error('id_area') is-invalid @enderror">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ old('id_area', $usuario->id_area) == $area->id ? 'selected' : '' }}>
                                    {{ $area->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_area')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Nivel</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-layer-group text-purple"></i></span>
                        </div>
                        <select name="nivel" id="nivel" class="form-control custom-select @error('nivel') is-invalid @enderror">
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ old('nivel', $usuario->nivel) == $nivel->id ? 'selected' : '' }}>
                                    {{ $nivel->nivel }}
                                </option>
                            @endforeach
                        </select>
                        @error('nivel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Firma (Actualizar)</label>
                    <div class="custom-file">
                        <input type="file" name="firma" id="firma" class="custom-file-input @error('firma') is-invalid @enderror" accept="image/*">
                        <label class="custom-file-label text-truncate" for="firma">Seleccionar nuevo archivo</label>
                        @error('firma')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Vista previa de Firma Actual -->
            <div class="row mt-3 justify-content-end">
                <div class="col-md-3 text-center">
                    <label class="font-weight-bold text-secondary d-block mb-2">Firma Actual Registrada</label>
                    @if($usuario->firma)
                        <div class="p-2 bg-light rounded border shadow-sm">
                            <img src="{{ asset($usuario->firma) }}" alt="Firma Actual" class="img-fluid" style="max-height: 120px; object-fit: contain;">
                        </div>
                    @else
                        <div class="p-3 bg-light rounded border text-muted">
                            <small>Sin firma previa</small>
                        </div>
                    @endif
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

    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
        background-color: transparent;
        transition: all 0.2s ease;
    }
    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: #ffffff;
    }

    /* Enfoque para controles del formulario */
    .form-control:focus, .custom-select:focus, .custom-file-input:focus ~ .custom-file-label {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.15);
    }

    /* Ajuste visual para input groups */
    .input-group-text {
        border-right: none;
    }
    .input-group .form-control, .input-group .custom-select {
        border-left: none;
    }
    .input-group:focus-within .input-group-text {
        border-color: #6f42c1;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        // Actualizar nombre del archivo seleccionado en el custom-file-input de Bootstrap
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName || 'Seleccionar nuevo archivo');
        });
    });
</script>
@stop
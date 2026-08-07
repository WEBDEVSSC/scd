@extends('adminlte::page')

@section('title', 'Nueva Área')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Áreas</h1>
            <small class="text-muted">Registro e incorporación de nuevas áreas institucionales</small>
        </div>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary font-weight-bold shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Regresar
        </a>
    </div>
@stop

@section('content')

<div class="card card-outline card-purple shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h3 class="card-title font-weight-bold text-dark mb-0">
            <i class="fas fa-folder-plus text-purple mr-2"></i> Formulario de Nuevo Registro
        </h3>
    </div>

    <form action="{{ route('storeArea') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body p-4">
            <!-- Primera Fila: Datos Principales -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Nombre del Área <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-building text-purple"></i></span>
                        </div>
                        <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" placeholder="Ej. Subdirección de Finanzas" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>            

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Responsable <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-purple"></i></span>
                        </div>
                        <input type="text" name="responsable" class="form-control @error('responsable') is-invalid @enderror" placeholder="Ej. Lic. Juan Pérez" value="{{ old('responsable') }}" required>
                        @error('responsable')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Siglas <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-purple"></i></span>
                        </div>
                        <input type="text" name="siglas" class="form-control @error('siglas') is-invalid @enderror" placeholder="Ej. SDF" value="{{ old('siglas') }}" required>
                        @error('siglas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Segunda Fila: Datos de Contacto y Clasificación -->
            <div class="row mt-2">
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Correo Electrónico <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-purple"></i></span>
                        </div>
                        <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" placeholder="area@dominio.gob.mx" value="{{ old('correo') }}" required>
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>           

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Extensión</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-phone-alt text-purple"></i></span>
                        </div>
                        <input type="text" name="extension" class="form-control @error('extension') is-invalid @enderror" placeholder="Ej. 104" value="{{ old('extension') }}">
                        @error('extension')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Tipo / Nivel <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-layer-group text-purple"></i></span>
                        </div>
                        <select name="tipo" id="tipo" class="form-control custom-select @error('tipo') is-invalid @enderror" required>
                            <option value="">-- Seleccione una opción --</option>
                            @foreach($niveles as $nivel)
                                <option value="{{ $nivel->id }}" {{ old('tipo') == $nivel->id ? 'selected' : '' }}>
                                    {{ $nivel->nivel }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-light d-flex justify-content-between align-items-center py-3">
            <span class="text-muted small"><span class="text-danger">*</span> Campos obligatorios</span>
            <button type="submit" class="btn btn-purple font-weight-bold px-4 shadow-sm">
                <i class="fas fa-check-circle mr-1"></i> Guardar Registro
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
    /* Estilos de la línea institucional y acentos */
    .text-purple { color: #6f42c1 !important; }

    .card-purple.card-outline {
        border-top: 3px solid #6f42c1;
    }

    /* Botón morado institucional */
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

    /* Enfoque en controles del formulario */
    .form-control:focus, .custom-select:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.15);
    }

    /* Ajuste para íconos dentro de inputs */
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
    console.log("Formulario de registro cargado correctamente.");
</script>
@stop
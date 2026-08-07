@extends('adminlte::page')

@section('title', 'Editar Área')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Áreas</h1>
            <small class="text-muted">Modificación de información registrada</small>
        </div>
        <div>
            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('indexArea') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Regresar
                </a>
            @else
                <a href="{{ route('misAreas') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Regresar
                </a>
            @endif
        </div>
    </div>
@stop

@section('content')

<div class="card card-outline card-purple shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h3 class="card-title font-weight-bold text-dark mb-0">
            <i class="fas fa-edit text-purple mr-2"></i> Formulario de Edición
        </h3>
    </div>

    <form action="{{ route('updateArea', $area->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card-body p-4">
            <!-- Primera Fila: Nombre, Responsable y Siglas -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Nombre del Área</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-building text-purple"></i></span>
                        </div>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $area->nombre) }}">
                        @else
                            <input type="text" name="nombre" class="form-control bg-light" value="{{ old('nombre', $area->nombre) }}" readonly>
                        @endif
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>            

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Responsable</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-user text-purple"></i></span>
                        </div>
                        <input type="text" name="responsable" class="form-control @error('responsable') is-invalid @enderror" value="{{ old('responsable', $area->responsable) }}">
                        @error('responsable')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Siglas</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-purple"></i></span>
                        </div>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <input type="text" name="siglas" class="form-control @error('siglas') is-invalid @enderror" value="{{ old('siglas', $area->siglas) }}">
                        @else
                            <input type="text" name="siglas" class="form-control bg-light" value="{{ old('siglas', $area->siglas) }}" readonly>
                        @endif
                        @error('siglas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Segunda Fila: Correo, Extensión y Tipo -->
            <div class="row mt-2">
                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Correo Electrónico</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-envelope text-purple"></i></span>
                        </div>
                        <input type="email" name="correo" id="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo', $area->correo) }}">
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
                        <input type="text" name="extension" id="extension" class="form-control @error('extension') is-invalid @enderror" value="{{ old('extension', $area->extension) }}">
                        @error('extension')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Tipo / Nivel</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-layer-group text-purple"></i></span>
                        </div>
                        @if(auth()->check() && auth()->user()->role === 'admin')
                            <select name="tipo" id="tipo" class="form-control custom-select @error('tipo') is-invalid @enderror">
                                <option value="">-- Seleccione una opción --</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id }}" {{ old('tipo', $area->tipo) == $nivel->id ? 'selected' : '' }}>
                                        {{ $nivel->nivel }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select name="tipo" id="tipo" class="form-control custom-select bg-light" disabled>
                                <option value="">-- Seleccione una opción --</option>
                                @foreach($niveles as $nivel)
                                    <option value="{{ $nivel->id }}" {{ old('tipo', $area->tipo) == $nivel->id ? 'selected' : '' }}>
                                        {{ $nivel->nivel }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Input oculto para conservar el valor al enviar el formulario cuando el select está disabled --}}
                            <input type="hidden" name="tipo" value="{{ $area->tipo }}">
                        @endif
                        @error('tipo')
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
    /* Estilos de Identidad Morada */
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
    .form-control:focus, .custom-select:focus {
        border-color: #6f42c1;
        box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.15);
    }

    /* Ajuste visual para grupos de entrada */
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
    console.log("Vista de edición cargada en tono morado.");
</script>
@stop
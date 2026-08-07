@extends('adminlte::page')

@section('title', 'Documentos Recibidos | Nuevo Registro')

@section('plugins.Select2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Registro de correspondencia e información entrante</small>
        </div>
        <div>
            <a href="{{ route('documentosRecibidos') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> Regresar
            </a>
        </div>
    </div>
@stop

@section('content')

<form action="{{ route('documentosRecibidosStore') }}" method="POST">
    @csrf

    <div class="card card-outline card-purple shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h3 class="card-title font-weight-bold text-dark mb-0">
                <i class="fas fa-inbox text-purple mr-2"></i> Formulario de Recepción de Documentos
            </h3>
        </div>

        <div class="card-body p-4">
            <!-- Primera Fila: Emisor, Tipo, Folio, Fecha del documento -->
            <div class="row">
                <!-- Emisor con Select2 Ajustado -->
                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Emisor</label>
                    <div class="select2-icon-wrapper">
                        <i class="fas fa-paper-plane select2-left-icon text-purple"></i>
                        <select name="emisor" id="emisor" class="form-control select2 @error('emisor') is-invalid @enderror">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ old('emisor') == $area->id ? 'selected' : '' }}>
                                    {{ $area->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('emisor')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Tipo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-file-alt text-purple"></i></span>
                        </div>
                        <select name="tipo" id="tipo" class="form-control custom-select @error('tipo') is-invalid @enderror">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="OF" {{ old('tipo') == 'OF' ? 'selected' : '' }}>OFICIO</option>
                            <option value="MEM" {{ old('tipo') == 'MEM' ? 'selected' : '' }}>MEMORANDUM</option>
                            <option value="TI" {{ old('tipo') == 'TI' ? 'selected' : '' }}>TARJETA INFORMATIVA</option>
                            <option value="CIR" {{ old('tipo') == 'CIR' ? 'selected' : '' }}>CIRCULAR</option>
                            <option value="EM" {{ old('tipo') == 'EM' ? 'selected' : '' }}>E-MAIL</option>
                        </select>
                        @error('tipo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Folio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-purple"></i></span>
                        </div>
                        <input type="text" name="folio" class="form-control @error('folio') is-invalid @enderror" value="{{ old('folio') }}" placeholder="Ej. OF-2026-001">
                        @error('folio')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Fecha del documento</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-purple"></i></span>
                        </div>
                        <input type="date" name="fecha_documento" class="form-control @error('fecha_documento') is-invalid @enderror" value="{{ old('fecha_documento') }}">
                        @error('fecha_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Segunda Fila: Fecha y hora de recepción, Fecha límite, Asunto -->
            <div class="row mt-2">
                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Fecha y hora de recepción</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-clock text-purple"></i></span>
                        </div>
                        <input type="datetime-local" name="fecha_recepcion" class="form-control @error('fecha_recepcion') is-invalid @enderror" value="{{ old('fecha_recepcion') }}">
                        @error('fecha_recepcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Fecha límite de respuesta</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-calendar-check text-purple"></i></span>
                        </div>
                        <input type="date" name="fecha_limite" class="form-control @error('fecha_limite') is-invalid @enderror" value="{{ old('fecha_limite') }}">
                        @error('fecha_limite')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Asunto</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-heading text-purple"></i></span>
                        </div>
                        <input type="text" name="asunto" class="form-control @error('asunto') is-invalid @enderror" value="{{ old('asunto') }}" placeholder="Asunto o síntesis del documento">
                        @error('asunto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Tercera Fila: Incluye anexo y Descripción del anexo -->
            <div class="row mt-2">
                <div class="col-md-3 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Incluye anexo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-paperclip text-purple"></i></span>
                        </div>
                        <select name="anexo" id="anexo" class="form-control custom-select @error('anexo') is-invalid @enderror">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('anexo') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('anexo') == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>
                        @error('anexo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-9 mb-3">
                    <label class="form-label font-weight-bold text-secondary">Descripción del anexo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light"><i class="fas fa-align-left text-purple"></i></span>
                        </div>
                        <input type="text" name="anexo_descripcion" class="form-control @error('anexo_descripcion') is-invalid @enderror" value="{{ old('anexo_descripcion') }}" placeholder="Detalles de los anexos (ej. CD, carpeta física, planos)">
                        @error('anexo_descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Cuarta Fila: Observaciones (Summernote) -->
            <div class="row mt-2">
                <div class="col-md-12 mb-3">
                    <label class="form-label font-weight-bold text-secondary">
                        <i class="fas fa-comment-alt text-purple mr-1"></i> Observaciones
                    </label>
                    <textarea name="contenido" id="contenido" class="form-control @error('contenido') is-invalid @enderror" rows="10">{{ old('contenido') }}</textarea>
                    @error('contenido')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="card-footer bg-light d-flex justify-content-end py-3">
            <button type="submit" class="btn btn-purple font-weight-bold px-4 shadow-sm">
                <i class="fas fa-check-circle mr-1"></i> Registrar Documento
            </button>
        </div>
    </div>
</form>

@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

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
        .form-control:focus, .custom-select:focus {
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

        /* Integración Limpia de Icono en Select2 */
        .select2-icon-wrapper {
            position: relative;
            width: 100%;
        }

        .select2-left-icon {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            z-index: 10;
            pointer-events: none;
        }

        .select2-container--default .select2-selection--single {
            height: calc(2.25rem + 2px) !important;
            border-radius: 0.25rem !important;
            border: 1px solid #ced4da !important;
            padding-left: 28px !important;
            background-color: #fff;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: calc(2.25rem - 2px) !important;
            padding-left: 5px !important;
            color: #495057;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: calc(2.25rem + 2px) !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #6f42c1 !important;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.15);
        }

        /* Estilos Summernote */
        .note-editor.note-frame {
            border-radius: 0.25rem;
            border-color: #ced4da;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-es-ES.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#emisor').select2({
                placeholder: "-- Selecciona una opción --",
                allowClear: true,
                width: '100%'
            });

            $('#contenido').summernote({
                height: 200,
                lang: 'es-ES',
                toolbar: [
                    ['font', ['bold', 'italic', 'underline']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']]
                ]
            });
        });
    </script> 
@stop
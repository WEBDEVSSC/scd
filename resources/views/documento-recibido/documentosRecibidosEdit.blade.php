@extends('adminlte::page')

@section('title', 'Editar Documento | Panel de Control')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Editar Registro</small>
        </div>
        <div>
            <a href="{{ route('documentosRecibidosIndex') }}" class="btn btn-outline-secondary font-weight-bold shadow-sm">
                <i class="fas fa-arrow-left mr-1"></i> REGRESAR
            </a>
        </div>
    </div>
@stop

@section('content')

    <!-- Alertas SweetAlert2 -->
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

    <form action="{{ route('documentosRecibidosUpdate', $documento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card card-outline card-purple shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark mb-0">
                    <i class="fas fa-edit text-purple mr-2"></i> Formulario de Edición de Documento
                </h3>
            </div>

            <div class="card-body p-4">
                
                {{-- FILA 1: Emisor, Tipo, Folio, Fecha del Documento --}}
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="emisor" class="font-weight-bold text-dark">Emisor</label>
                        <select name="emisor" id="emisor" class="form-control @error('emisor') is-invalid @enderror">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ old('emisor', $documento->emisor_id) == $area->id ? 'selected' : '' }}>
                                    {{ $area->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('emisor')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="tipo" class="font-weight-bold text-dark">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="OF" {{ old('tipo', $documento->tipo) == 'OF' ? 'selected' : '' }}>OFICIO</option>
                            <option value="MEM" {{ old('tipo', $documento->tipo) == 'MEM' ? 'selected' : '' }}>MEMORANDUM</option>
                            <option value="TI" {{ old('tipo', $documento->tipo) == 'TI' ? 'selected' : '' }}>TARJETA INFORMATIVA</option>
                            <option value="CIR" {{ old('tipo', $documento->tipo) == 'CIR' ? 'selected' : '' }}>CIRCULAR</option>
                            <option value="EM" {{ old('tipo', $documento->tipo) == 'EM' ? 'selected' : '' }}>E-MAIL</option>
                        </select>
                        @error('tipo')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="folio" class="font-weight-bold text-dark">Folio</label>
                        <input type="text" name="folio" id="folio" class="form-control @error('folio') is-invalid @enderror" value="{{ old('folio', $documento->folio) }}" placeholder="Ingrese el folio">
                        @error('folio')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="fecha_documento" class="font-weight-bold text-dark">Fecha del Documento</label>
                        <input type="date" name="fecha_documento" id="fecha_documento" class="form-control @error('fecha_documento') is-invalid @enderror" value="{{ old('fecha_documento', $documento->fecha_documento) }}">
                        @error('fecha_documento')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FILA 2: Fecha Recepción, Fecha Límite, Asunto --}}
                <div class="row mt-2">
                    <div class="col-md-3 form-group">
                        <label for="fecha_recepcion" class="font-weight-bold text-dark">Fecha y Hora de Recepción</label>
                        <input type="datetime-local" name="fecha_recepcion" id="fecha_recepcion" class="form-control @error('fecha_recepcion') is-invalid @enderror" value="{{ old('fecha_recepcion', $documento->fecha_recepcion) }}">
                        @error('fecha_recepcion')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-3 form-group">
                        <label for="fecha_limite" class="font-weight-bold text-dark">Fecha Límite de Respuesta</label>
                        <input type="date" name="fecha_limite" id="fecha_limite" class="form-control @error('fecha_limite') is-invalid @enderror" value="{{ old('fecha_limite', $documento->fecha_limite) }}">
                        @error('fecha_limite')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="asunto" class="font-weight-bold text-dark">Asunto</label>
                        <input type="text" name="asunto" id="asunto" class="form-control @error('asunto') is-invalid @enderror" value="{{ old('asunto', $documento->asunto) }}" placeholder="Ingrese el asunto principal">
                        @error('asunto')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FILA 3: Anexo y Descripción --}}
                <div class="row mt-2">
                    <div class="col-md-3 form-group">
                        <label for="anexo" class="font-weight-bold text-dark">Incluye Anexo</label>
                        <select name="anexo" id="anexo" class="form-control @error('anexo') is-invalid @enderror">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="SI" {{ old('anexo', $documento->anexo) == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('anexo', $documento->anexo) == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>
                        @error('anexo')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-9 form-group">
                        <label for="anexo_descripcion" class="font-weight-bold text-dark">Descripción del Anexo</label>
                        <input type="text" name="anexo_descripcion" id="anexo_descripcion" class="form-control @error('anexo_descripcion') is-invalid @enderror" value="{{ old('anexo_descripcion', $documento->anexo_descripcion) }}" placeholder="Detalle los documentos o elementos adjuntos">
                        @error('anexo_descripcion')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FILA 4: Observaciones --}}
                <div class="row mt-2">
                    <div class="col-md-12 form-group">
                        <label for="contenido" class="font-weight-bold text-dark">Observaciones</label>
                        <textarea name="contenido" id="contenido" class="form-control @error('contenido') is-invalid @enderror" rows="5">{{ old('contenido', $documento->contenido) }}</textarea>
                        @error('contenido')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

            </div>

            <div class="card-footer bg-white text-right py-3">
                <button type="submit" class="btn btn-purple font-weight-bold px-4 shadow-sm">
                    <i class="fas fa-check-circle mr-1"></i> ACTUALIZAR DOCUMENTO
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
            border-color: #6f42c1;
            color: #ffffff;
        }

        .btn-purple:hover {
            background-color: #5a32a3;
            border-color: #5a32a3;
            color: #ffffff;
        }

        /* Estilos Summernote integrados */
        .note-editor.note-frame {
            border-color: #ced4da;
            border-radius: 0.25rem;
        }

        .note-editor.note-frame:focus-within {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-es-ES.min.js"></script>

    <script>
        $(document).ready(function() {
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
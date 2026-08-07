@extends('adminlte::page')

@section('title', 'Turnar Documento | Panel de Control')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Turnar Documento</small>
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

    <form action="{{ route('documentosRecibidosTurnarStore', $documento->id) }}" method="POST">
        @csrf

        <div class="card card-outline card-purple shadow-sm border-0">

            <div class="card-header bg-white py-3">
                <h3 class="card-title font-weight-bold text-dark mb-0">
                    <i class="fas fa-share-alt text-purple mr-2"></i> Formulario para Turnar Documento
                </h3>
            </div>

            <div class="card-body p-4">

                {{-- Resumen de datos del documento --}}
                <div class="bg-light p-3 rounded mb-4 border">
                    <div class="row">
                        <div class="col-md-3 mb-2 mb-md-0">
                            <strong>Folio:</strong> 
                            <span class="text-purple font-weight-bold">{{ $documento->folio }}</span>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <strong>Fecha:</strong> 
                            <span class="text-secondary">{{ \Carbon\Carbon::parse($documento->fecha_documento)->format('d-m-Y') }}</span>
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <strong>Emisor:</strong> 
                            <span class="text-secondary">{{ $documento->emisor }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Asunto:</strong> 
                            <span class="text-secondary">{{ $documento->asunto }}</span>
                        </div>
                    </div>

                    @if (is_null($documento->documento))
                        <div class="alert alert-danger mt-3 mb-0">
                            <i class="fas fa-exclamation-triangle mr-1"></i>
                            <strong>El registro no tiene el documento escaneado en formato PDF</strong>
                        </div>
                    @endif
                </div>

                {{-- Selección de Departamento --}}
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="departamento_id" class="font-weight-bold text-dark">Departamento a Turnar</label>
                        <select name="departamento_id"
                                id="departamento_id"
                                class="form-control @error('departamento_id') is-invalid @enderror">
                            <option value="">-- Seleccione una opción --</option>

                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id }}"
                                    {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                                    {{ $departamento->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('departamento_id')
                            <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- Observaciones --}}
                <div class="row mt-2">
                    <div class="col-md-12 form-group">
                        <label for="contenido" class="font-weight-bold text-dark">Observaciones / Instrucciones</label>
                        <textarea name="contenido" 
                                  id="contenido" 
                                  class="form-control @error('contenido') is-invalid @enderror" 
                                  rows="10">{{ old('contenido') }}</textarea>

                        @error('contenido')
                            <span class="invalid-feedback d-block mt-1">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3 mb-0">
                        <ul class="mb-0 pl-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>

            <div class="card-footer bg-white text-right py-3">
                <button type="submit" class="btn btn-purple font-weight-bold px-4 shadow-sm">
                    <i class="fas fa-check-circle mr-1"></i> TURNAR DOCUMENTO
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
            // Inicialización del editor Summernote
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
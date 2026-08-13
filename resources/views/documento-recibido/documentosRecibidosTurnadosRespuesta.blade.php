@extends('adminlte::page')

@section('title', 'Cargar Documento | Panel de Control')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Respuesta</small>
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

    <div class="row">

        {{-- ======================= CARGA DE DOCUMENTO ======================= --}}
        <div class="col-md-6">

            <form action="{{ route('documentosRecibidosTurnadosRespuestaStore', $documento->id) }}" 
                  method="POST" 
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card card-outline card-purple shadow-sm border-0">

                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark mb-0">
                            <i class="fas fa-reply text-purple mr-2"></i> Registrar Respuesta
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        <div class="bg-light p-3 rounded mb-4 border">
                            <p class="mb-2"><strong>Folio:</strong> <span class="text-purple font-weight-bold">{{ $documento->folio }}</span></p>
                            <p class="mb-2"><strong>Emisor:</strong> {{ $documento->emisor }}</p>
                            <p class="mb-0"><strong>Asunto:</strong> {{ $documento->asunto }}</p>
                        </div>

                        <div class="form-group mb-4">
                            <label for="contenido" class="font-weight-bold text-dark">Respuesta</label>
                            <textarea name="contenido" 
                                      id="contenido" 
                                      class="form-control @error('contenido') is-invalid @enderror" 
                                      rows="10">{{ old('contenido') }}</textarea>

                            @error('contenido')
                                <span class="invalid-feedback d-block mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="documento" class="font-weight-bold text-dark">Selecciona documento en PDF</label>
                            
                            <!-- INPUT ADAPTADO PARA FILEPOND -->
                            <input type="file"
                                   name="documento"
                                   id="documento"
                                   accept="application/pdf"
                                   required>

                            @error('documento')
                                <span class="invalid-feedback d-block mt-2">{{ $message }}</span>
                            @enderror
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
                            <i class="fas fa-check-circle mr-1"></i> REGISTRAR RESPUESTA
                        </button>
                    </div>

                </div>
            </form>
        </div>

        {{-- ======================= VISTA PREVIA ======================= --}}
        <div class="col-md-6">

            <div class="card card-outline card-purple shadow-sm border-0">

                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-file-pdf text-purple mr-2"></i> Vista Previa del Documento
                    </h3>
                </div>

                <div class="card-body p-0">

                    @if ($documento->documento)
                        <iframe
                            src="{{ route('verDocumento', $documento->id) }}"
                            width="100%"
                            height="600"
                            style="border: none;">
                        </iframe>
                    @else
                        <div class="p-5 text-center text-muted">
                            <i class="fas fa-file-pdf fa-4x text-purple mb-3 opacity-50"></i>
                            <p class="h6 text-secondary mb-0">No hay documento cargado actualmente.</p>
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
    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    
    <!-- FilePond CSS -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.css" rel="stylesheet">

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

        /* Estilos Summernote */
        .note-editor.note-frame {
            border-color: #ced4da;
            border-radius: 0.25rem;
        }

        .note-editor.note-frame:focus-within {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }

        /* Estilos personalizados para FilePond */
        .filepond--root {
            font-family: inherit;
        }
        .filepond--panel-root {
            background-color: #f8f9fa;
            border: 2px dashed #6f42c1;
            border-radius: 8px;
        }
        .filepond--drop-label {
            color: #495057;
        }
        .filepond--label-action {
            text-decoration-color: #6f42c1;
            color: #6f42c1;
            font-weight: bold;
        }
        .filepond--item-panel {
            background-color: #6f42c1;
        }
    </style>
@stop

@section('js')
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-es-ES.min.js"></script>

    <!-- FilePond Core JS -->
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <!-- FilePond Plugins -->
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-pdf-preview/dist/filepond-plugin-pdf-preview.min.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Inicialización de Summernote
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

            // 2. Inicialización de FilePond
            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginFileValidateSize,
                FilePondPluginPdfPreview
            );

            const inputElement = document.querySelector('input[id="documento"]');

            const pond = FilePond.create(inputElement, {
                storeAsFile: true, // Envía el archivo adjunto dentro del submit del formulario
                allowMultiple: false,
                maxFileSize: '10MB',
                acceptedFileTypes: ['application/pdf'],
                labelIdle: 'Arrastra tu archivo PDF o <span class="filepond--label-action">Examinar</span>',
                labelFileTypeNotAllowed: 'Archivo no válido. Solo se permiten PDF.',
                fileValidateTypeLabelExpectedTypes: 'Se espera {allTypes}',
                allowPdfPreview: true,
                pdfPreviewHeight: 220,
                pdfComponentExtraParams: 'toolbar=0&navpanes=0&scrollbar=0'
            });
        });
    </script>
@stop
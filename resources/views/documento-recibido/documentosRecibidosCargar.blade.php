@extends('adminlte::page')

@section('title', 'Cargar Documento | Panel de Control')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Cargar PDF</small>
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

            <form action="{{ route('documentosRecibidosCargarStore', $documento->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="card card-outline card-purple shadow-sm border-0">

                    <div class="card-header bg-white py-3">
                        <h3 class="card-title font-weight-bold text-dark mb-0">
                            <i class="fas fa-file-upload text-purple mr-2"></i> Información y Carga
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        <div class="bg-light p-3 rounded mb-4 border">
                            <p class="mb-2"><strong>Folio:</strong> <span class="text-purple font-weight-bold">{{ $documento->folio }}</span></p>
                            <p class="mb-2"><strong>Emisor:</strong> {{ $documento->emisor }}</p>
                            <p class="mb-0"><strong>Asunto:</strong> {{ $documento->asunto }}</p>
                        </div>

                        <div class="form-group mb-3">
                            <label for="documento" class="font-weight-bold text-dark">Selecciona documento en PDF</label>
                            <div class="custom-file">
                                <input type="file"
                                       name="documento"
                                       id="documento"
                                       class="custom-file-input @error('documento') is-invalid @enderror"
                                       accept="application/pdf"
                                       required>
                                <label class="custom-file-label" for="documento" data-browse="Buscar">Elegir archivo PDF...</label>
                            </div>

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
                            <i class="fas fa-check-circle mr-1"></i> REGISTRAR DOCUMENTO
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

        .custom-file-input:focus ~ .custom-file-label {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }

        .custom-file-label::after {
            background-color: #6f42c1;
            color: #ffffff;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            // Mostrar el nombre del archivo seleccionado en el input de BS4
            $('.custom-file-input').on('change', function () {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        });
    </script>
@stop
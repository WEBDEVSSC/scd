@extends('adminlte::page')

@section('title', 'Detalles del Documento | Panel de Control')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Detalles</small>
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
        {{-- ======================= DATOS GENERALES ======================= --}}
        <div class="col-md-6">
            <div class="card card-outline card-purple shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-info-circle text-purple mr-2"></i> Datos Generales
                    </h3>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-2 col-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">STATUS</label>
                            @if($documento->status == 'NUEVO')
                                <span class="badge badge-purple px-2 py-1">NUEVO</span>
                            @elseif($documento->status == 'TURNADO A AREA')
                                <span class="badge badge-warning px-2 py-1 text-dark">TURNADO A ÁREA</span>
                            @elseif($documento->status == 'ATENDIDO')
                                <span class="badge badge-success px-2 py-1">ATENDIDO</span>
                            @else
                                <span class="badge badge-secondary px-2 py-1">{{ $documento->status }}</span>
                            @endif
                        </div>

                        <div class="col-md-2 col-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">FOLIO</label>
                            <span class="text-secondary">{{ $documento->folio }}</span>
                        </div>

                        <div class="col-md-2 col-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">AÑO</label>
                            <span class="text-secondary">{{ $documento->anio }}</span>
                        </div>

                        <div class="col-md-2 col-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">FECHA DOC.</label>
                            <span class="text-secondary">{{ \Carbon\Carbon::parse($documento->fecha_documento)->format('d-m-Y') }}</span>
                        </div>

                        <div class="col-md-2 col-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">RECEPCIÓN</label>
                            <span class="text-secondary">{{ \Carbon\Carbon::parse($documento->fecha_recepcion)->format('d-m-Y') }}</span>
                        </div>

                        <div class="col-md-2 col-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">FECHA LÍMITE</label>
                            <span class="text-secondary">{{ \Carbon\Carbon::parse($documento->fecha_limite)->format('d-m-Y') }}</span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">ASUNTO</label>
                            <p class="text-secondary mb-0">{{ $documento->asunto }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">ANEXOS</label>
                            <p class="text-secondary mb-0">{{ $documento->anexo }} - {{ $documento->anexo_descripcion }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">CONTENIDO / OBSERVACIONES</label>
                            <div class="text-secondary bg-light p-3 rounded border">
                                {!! $documento->contenido !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="font-weight-bold text-dark d-block mb-2">DOCUMENTO ESCANEADO</label>

                            @if (is_null($documento->documento))
                                <div class="alert alert-danger mb-0">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <strong>El registro no tiene el documento escaneado en formato PDF</strong>
                                </div>
                            @else
                                <button type="button" 
                                        class="btn btn-purple btn-sm font-weight-bold shadow-sm"
                                        data-toggle="modal"
                                        data-target="#modalDocumento">
                                    <i class="fas fa-file-pdf mr-1"></i> VER DOCUMENTO
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======================= ÁREA TURNADA ======================= --}}
        <div class="col-md-6">
            <div class="card card-outline card-purple shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h3 class="card-title font-weight-bold text-dark mb-0">
                        <i class="fas fa-share-alt text-purple mr-2"></i> Área Turnada
                    </h3>
                </div>

                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">TURNADO A</label>
                            <span class="text-secondary">{{ $documento->turnado_area_label }}</span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">FECHA</label>
                            <span class="text-secondary">
                                {{ $documento->turnado_area_fecha ? \Carbon\Carbon::parse($documento->turnado_area_fecha)->format('d-m-Y') : 'N/A' }}
                            </span>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">RESPUESTA</label>
                            <span class="text-secondary">
                                {{ $documento->turnado_area_respuesta_fecha ? \Carbon\Carbon::parse($documento->turnado_area_respuesta_fecha)->format('d-m-Y') : 'N/A' }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">OBSERVACIONES DEL TURNADO</label>
                            <div class="text-secondary bg-light p-3 rounded border">
                                {!! $documento->turnado_area_observaciones !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="font-weight-bold text-dark d-block mb-1">RESPUESTA EMITIDA</label>
                            <div class="text-secondary bg-light p-3 rounded border">
                                {!! $documento->turnado_area_respuesta !!}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="font-weight-bold text-dark d-block mb-2">DOCUMENTO DE RESPALDO</label>

                            @if (is_null($documento->turnado_area_respuesta_documento))
                                <div class="alert alert-danger mb-0">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    <strong>El registro no tiene el documento escaneado en formato PDF</strong>
                                </div>
                            @else
                                <button type="button" 
                                        class="btn btn-purple btn-sm font-weight-bold shadow-sm"
                                        data-toggle="modal"
                                        data-target="#modalDocumentoRespuesta">
                                    <i class="fas fa-file-pdf mr-1"></i> VER DOCUMENTO
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ======================= MODALES ======================= --}}
    <div class="modal fade" id="modalDocumento" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white py-3">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-file-pdf mr-2"></i> Documento PDF
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <iframe src="{{ route('verDocumento', $documento->id) }}"
                            width="100%"
                            height="800px"
                            style="border:none;">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalDocumentoRespuesta" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white py-3">
                    <h5 class="modal-title font-weight-bold">
                        <i class="fas fa-file-pdf mr-2"></i> Documento de Respaldo PDF
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <iframe src="{{ route('verDocumentoRespuesta', $documento->id) }}"
                            width="100%"
                            height="800px"
                            style="border:none;">
                    </iframe>
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
        .bg-purple { background-color: #6f42c1 !important; }

        .card-purple.card-outline {
            border-top: 3px solid #6f42c1;
        }

        .badge-purple {
            background-color: #6f42c1;
            color: #ffffff;
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
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Script de inicialización genérico
        });
    </script>
@stop
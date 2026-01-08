@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1><strong>Documentos Recibidos</strong><small> Detalles</small></h1>
@stop

@section('content')

<!-- ---------------------------------------------------------------- -->

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Registro completado! ',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    });
</script>
@endif

<!-- ---------------------------------------------------------------- -->

<div class="row">
    <div class="col-md-6">

        <div class="card card-info card-outline">
            <div class="card-header">
                <strong>DATOS GENERALES</strong>
            </div>

            <div class="card-body">
                <div class="row">
            <div class="col-md-2">
                <p><strong>STATUS</strong></p>
                <p>{{ $documento->status }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FOLIO</strong></p>
                <p>{{ $documento->folio }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>AÑO</strong></p>
                <p>{{ $documento->anio }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FECHA DEL DOCUMENTO</strong></p>
                <p>{{ \Carbon\Carbon::parse($documento->fecha_documento)->format('d-m-Y') }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FECHA DEL RECEPCIÓN</strong></p>
                <p>{{ \Carbon\Carbon::parse($documento->fecha_recepcion)->format('d-m-Y') }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FECHA LÍMITE</strong></p>
                <p>{{ \Carbon\Carbon::parse($documento->fecha_limite)->format('d-m-Y') }}</p>
            </div>
            
            
        </div>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>ASUNTO</strong></p>
                <p>{{ $documento->asunto }}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>ANEXOS</strong></p>
                <p>{{ $documento->anexo }} - {{ $documento->anexo_descripcion }}</p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>CONTENIDO</strong></p>
                <p>{!! $documento->contenido !!}</p>
            </div>
        </div>

        <div class="row mt-3">
                        <div class="col-md-12">
                            <p><strong>DOCUMENTO ESCANEADO</strong></p>

                            @if (is_null($documento->documento))
                                <p class="text-white bg-danger p-2">
                                    <strong><u>El registro no tiene el documento escaneado en formato PDF</u></strong>
                                </p>
                            @else
                                <a href="#"
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalDocumento">
                                    VER DOCUMENTO
                                </a>
                            @endif   
                            
                            
                        </div>
                    </div>

            </div>

            <div class="card-footer">

            </div>
        </div>        

    </div>

    <div class="col-md-6">
        <div class="card-md-6">
            <div class="card card-secondary card-outline">
            
                <div class="card-header"><strong>ÁREA TURNADA</strong></div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>TURNADO A</strong></p>
                            <p>{{ $documento->turnado_area_label }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>FECHA</strong></p>
                            <p>{{ \Carbon\Carbon::parse($documento->turnado_area_fecha)->format('d-m-Y') }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>RESPUESTA</strong></p> 
                            <p>{{ \Carbon\Carbon::parse($documento->turnado_area_respuesta_fecha)->format('d-m-Y') }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p><strong>OBSERVACIONES</strong></p>
                            <p>{!! $documento->turnado_area_observaciones !!}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p><strong>RESPUESTA</strong></p>
                            <p>{!! $documento->turnado_area_respuesta !!}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <p><strong>DOCUMENTO DE RESPALDO</strong></p>

                            @if (is_null($documento->turnado_area_respuesta_documento))
                                <p class="text-white bg-danger p-2">
                                    <strong><u>El registro no tiene el documento escaneado en formato PDF</u></strong>
                                </p>
                            @else

                                <a href="#"
                                    class="btn btn-info btn-sm"
                                    data-toggle="modal"
                                    data-target="#modalDocumentoRespuesta">
                                    VER DOCUMENTO
                                </a>
                            
                            @endif
                        </div>
                    </div>

                </div>
                <div class="card-footer"></div>
                
            </div>
        </div>
    </div>

</div>

<!-- ---------------------------------------------------------------- -->

<div class="modal fade" id="modalDocumento" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Documento PDF</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body p-0">
                <iframe
                    src="{{ route('verDocumento', $documento->id) }}"
                    width="100%"
                    height="800px"
                    style="border:none;">
                </iframe>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modalDocumentoRespuesta" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Documento PDF</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body p-0">
                <iframe
                    src="{{ route('verDocumentoRespuesta', $documento->id) }}"
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

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

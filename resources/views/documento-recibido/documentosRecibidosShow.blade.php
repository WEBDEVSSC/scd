@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1><strong>Documento</strong><small> Detalles</small></h1>
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

<div class="card card-info card-outline">
    <div class="card-title">

        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('indexDocumento') }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            {{-- <a href="{{ route('pdfDocumento',$documento->id) }}" class="btn btn-info ml-2" target="_blank">
                <i class="fa fa-file" aria-hidden="true"></i> PDF
            </a> 
            <a href="{{ route('pdfDocumento',$documento->id) }}" class="btn btn-info ml-2" target="_blank">
                <i class="fa fa-file" aria-hidden="true"></i> TURNAR
            </a>--}}
        </div>

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
                <p>{{ $documento->fecha_documento }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FECHA DEL RECEPCIÓN</strong></p>
                <p>{{ $documento->fecha_recepcion }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FECHA LÍMITE</strong></p>
                <p>{{ $documento->fecha_limite }}</p>
            </div>
            
            
        </div>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-4">
                <p><strong>TURNADO A</strong></p>
                <p>{{ $documento->turnado_area_label }} - {{ $documento->turnado_area_encargado }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FECHA</strong></p>
                <p>{{ $documento->turnado_area_fecha }}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-4">
                <p><strong>OBSERVACIONES</strong></p>
                <p>{!! $documento->turnado_area_observaciones !!}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        
        
        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>ASUNTO</strong></p>
                <p>{{ $documento->asunto }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>ANEXOS</strong></p>
                <p>{{ $documento->anexo }} - {{ $documento->anexo_descripcion }}</p>
            </div>
        </div>


        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>CONTENIDO</strong></p>
                <p>{!! $documento->contenido !!}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-12">
                @if ($documento->documento)
                    <iframe
                        src="{{ route('verDocumento', $documento->id) }}"
                        width="100%"
                        height="600"
                        style="border: none;">
                    </iframe>
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fa fa-file-pdf fa-3x mb-2"></i>
                        <p>No hay documento cargado.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- ------------------------------------------------- -->
        
    </div>
    <div class="card-footer">



       
        
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

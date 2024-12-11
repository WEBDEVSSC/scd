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

<div class="card card-primary card-outline">
    <div class="card-title">

        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('indexDocumento') }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            <a href="{{ route('pdfDocumento',$documento->id) }}" class="btn btn-info ml-2" target="_blank">
                <i class="fa fa-file" aria-hidden="true"></i> PDF
            </a>
        </div>

    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-md-1">
                <p><strong>STATUS</strong></p>
                <p>{{ $documento->status_label }}</p>
            </div>
            <div class="col-md-2">
                <p><strong>FOLIO</strong></p>
                <p>{{ $documento->siglas }}/{{ $documento->tipo }}/{{ $documento->consecutivo }}/{{ $documento->created_at->format('Y') }}</p>
            </div>
            <div class="col-md-3">
                <p><strong>EMISOR</strong></p>
                <p>{{ $documento->area_responsable }} <br> <small><strong>{{ $documento->area_label}}</strong></small></p>
                <center><img src="{{ asset($capturo->firma) }}" width="100px" height="100px" alt="Firma del usuario"></center>
            </div>
            <div class="col-md-3">
                <p><strong>RECEPTOR</strong></p>
                <p>{{ $documento->para_label }} <br> <small><strong>{{ $documento->para_area}}</strong></small></p>
                <center><img src="{{ asset($capturo->firma) }}" width="100px" height="100px" alt="Firma del usuario"></center>
            </div>
            <div class="col-md-3">
                <p><strong>FIRMA</strong></p>
                <p>{{ $documento->firma_label }} <br> <small><strong>{{ $documento->firma_area }}</strong></small></p>
                <center><img src="{{ asset($capturo->firma) }}" width="100px" height="100px" alt="Firma del usuario"></center>
            </div>
            
        </div>

        <!-- ------------------------------------------------- -->

        <hr>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">

            <div class="col-md-3">
                <p><strong>Asunto</strong></p>
                <p>{{ $documento->asunto }}</p>
            </div>

            <div class="col-md-3">
                <p><strong>Anexos</strong></p>
                <p>{{ $documento->anexo }}</p>
            </div>

            <div class="col-md-6">
                <p><strong>Descripción</strong></p>
                <p>{{ $documento->anexo_descripcion }}</p>
            </div>
            
        </div>

        <!-- ------------------------------------------------- -->

        <hr>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-12">
                <p><strong>Contenido</strong></p>
                <p>{!! $documento->contenido !!}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        <hr>

        <!-- ------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Fecha de creación</strong></p>
                <p>{{ $documento->created_at }}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        
    </div>
    <div class="card-footer">

        <!-- VALIDAMOS EL STATUS DEL DOCUMENTO  -->
        @if ($documento->status_firma == 0)

            <!-- VALIDAMOS QUE EL USUARIO TENGA QUE FIRMAR -->
            @if ($documento->firma==$user->id_area)

                <form action="{{ route('firmarDocumento', $documento->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    <button type="submit" class="btn btn-info float-right"><i class="fa-solid fa-file-pen" aria-hidden="true"></i> FIRMAR DOCUMENTO</button>            

                </form>

            @endif
            
        @endif
        
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

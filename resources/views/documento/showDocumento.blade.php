@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><strong>Documento</strong><small> Detalles</small></h1>
@stop

@section('content')

<div class="card card-primary card-outline">
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
            </div>
            <div class="col-md-3">
                <p><strong>RECEPTOR</strong></p>
                <p>{{ $documento->para_label }} <br> <small><strong>{{ $documento->para_area}}</strong></small></p>
            </div>
            <div class="col-md-3">
                <p><strong>FIRMA</strong></p>
                <p>{{ $documento->firma_label }} <br> <small><strong>{{ $documento->firma_area }}</strong></small></p>
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
            <div class="col-md-3">
                <p><strong>Registrado por</strong></p>
                <p>{{ $capturo->name }}</p>
            </div>
        </div>

        <!-- ------------------------------------------------- -->

        
    </div>
    <div class="card-footer">
        
        @if ($documento->firma==$user->id_area)
        
            <div class="btn btn-info btn-sm">FIRMAR</div>
          
        @endif
        

    </div>
</div>
    
@stop

@section('css')

@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Areas <small>Detalles</small></strong></h1>
@stop

@section('content')

<!-- ---------------------------------------------------------------- -->

@if(session('update'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Datos actualizados exitosamente! ',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    });
</script>
@endif

<!-- ---------------------------------------------------------------- -->

    <div class="card card-primary card-outline">

        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('indexArea') }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            <a href="{{ route('editArea',$area->id) }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-pen" aria-hidden="true"></i> EDITAR
            </a>
            <button class="btn btn-info ml-2" id="deleteButton" data-id="{{ $area->id }}">
                <i class="fa-solid fa-trash" aria-hidden="true"></i> ELIMINAR
            </button>
        </div>

        
        <div class="card-body">

            <table class="table table-striped">
                <tr>
                    <td style="width: 10%"><strong>Nombre : </strong></td>
                    <td>{{ $area->nombre }}</td>
                </tr>
                <tr>
                    <td><strong>Responsable : </strong></td>
                    <td>{{ $area->responsable }}</td>
                </tr>
                <tr>
                    <td><strong>Siglas : </strong></td>
                    <td>{{ $area->siglas }}</td>
                </tr>
                <tr>
                    <td><strong>Correo de notificación : </strong></td>
                    <td>{{ $area->correo }}</td>
                </tr>
                <tr>
                    <td><strong>Extesión : </strong></td>
                    <td>{{ $area->extension }}</td>
                </tr>
                <tr>
                    <td><strong>Firma : </strong></td>
                    <td><img src="{{ asset($area->firma) }}" width="300px"></td>
                </tr>

            </table>
    
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
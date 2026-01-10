@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1><strong>Configuración</strong><small> Mis Áreas</small></h1>
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
    <div class="card-body">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>RESPONSABLE</th>
                    <th>SIGLAS</th>
                    <th>CORREO</th>
                    <th>EXTENSIÓN</th> 
                    <th>TIPO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                    <tr>
                        <td>{{ $area->id }}</td>
                        <td>{{ $area->nombre }}</td>
                        <td>{{ $area->responsable }}</td>
                        <td>{{ $area->siglas }}</td>
                        <td>{{ $area->correo }}</td>
                        <td>{{ $area->extension }}</td>
                        <td>
                        <!-- DESPACHO -->
                        @if($area->tipo == 1)
                            <button class="btn btn-sx btn-primary btn-sm btn-block">SECRETARIO DE SALUD</button>
                        <!-- SUBSECRETARIA -->
                        @elseif($area->tipo == 2)
                            <button class="btn btn-sx btn-secondary btn-sm btn-block">SUBSECRETARIA</button>
                        <!-- SUBDIRECCION -->
                        @elseif($area->tipo == 3)
                            <button class="btn btn-sx btn-success btn-sm btn-block">SUBDIRECCIÓN</button>
                        <!-- JEFATURA -->
                        @elseif($area->tipo == 4)
                            <button class="btn btn-sx btn-info btn-sm btn-block">JEFATURA</button>
                        <!-- AREA / PROGRAMA -->
                        @elseif($area->tipo == 5)
                            <button class="btn btn-sx btn-dark btn-sm btn-block">PROGRAMA / AREA</button>
                        <!-- UNIDAD -->
                        @elseif($area->tipo == 6)
                            <button class="btn btn-sx btn-warning btn-sm btn-block">UNIDAD</button>
                        @else
                            <button class="btn btn-sx btn-danger btn-block">ERROR : SIN TIPO </button>
                        @endif
                    </td>
                        <td>

                            <a href="{{ route('editArea', $area->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Actualizar Registro"><i class="fa-solid fa-pen-to-square"></i></a>

                        </td> 
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
    
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>

    <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>
@stop
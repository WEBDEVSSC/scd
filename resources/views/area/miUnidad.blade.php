@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Mi Unidad</strong><small> Dashboard</small></h1>
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
        <div class="card-header">
                
        </div> 
        <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Área</th>
                    <th>Correo notificación</th>
                    <th>Responsable</th>
                    <th>Siglas</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jefaturas as $jefatura)
                <tr>
                    <td>{{ $jefatura->id }}</td>
                    <td>{{ $jefatura->nombre }}</td>
                    <td>{{ $jefatura->correo }}</td>
                    <td>{{ $jefatura->responsable }}</td>
                    <td>{{ $jefatura->siglas }}</td>
                    <td>
                        <!-- DESPACHO -->
                        @if($jefatura->tipo == 1)
                            <button class="btn btn-sx btn-primary btn-block">SECRETARIO DE SALUD</button>
                        <!-- SUBSECRETARIA -->
                        @elseif($jefatura->tipo == 2)
                            <button class="btn btn-sx btn-secondary btn-block">SUBSECRETARIA</button>
                        <!-- SUBDIRECCION -->
                        @elseif($jefatura->tipo == 3)
                            <button class="btn btn-sx btn-success btn-block">SUBDIRECCIÓN</button>
                        <!-- JEFATURA -->
                        @elseif($jefatura->tipo == 4)
                            <button class="btn btn-sx btn-info btn-block">JEFATURA</button>
                        <!-- AREA / PROGRAMA -->
                        @elseif($jefatura->tipo == 5)
                            <button class="btn btn-sx btn-dark btn-block">PROGRAMA / AREA</button>
                        <!-- UNIDAD -->
                        @elseif($jefatura->tipo == 6)
                            <button class="btn btn-sx btn-warning btn-block">UNIDAD</button>
                        @else
                            <button class="btn btn-sx btn-danger btn-block">ERROR : SIN TIPO </button>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('showArea', $jefatura->id) }}" class="btn btn-info"><i class="fa-solid fa-gear"></i></a>
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
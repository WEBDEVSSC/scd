@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Areas</strong><small> Dashboard</small></h1>
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
        <div class="card-header">
            <a href="{{ route('createArea') }}" class="btn btn-info float-right"><i class="fa-solid fa-plus" aria-hidden="true"></i> NUEVO REGISTRO</a>     
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
                @foreach ($areas as $area)
                <tr>
                    <td>{{ $area->id }}</td>
                    <td>{{ $area->nombre }}</td>
                    <td>{{ $area->correo }}</td>
                    <td>{{ $area->responsable }}</td>
                    <td>{{ $area->siglas }}</td>
                    <td>
                        @if($area->tipo == 1)
                            <button class="btn btn-sx btn-primary btn-block">Secretarío de Salud</button>
                        @elseif($area->tipo == 2)
                        <button class="btn btn-sx btn-secondary btn-block">Unidad</button>
                        @elseif($area->tipo == 3)
                        <button class="btn btn-sx btn-success btn-block">Subdirección</button>
                        @elseif($area->tipo == 4)
                        <button class="btn btn-sx btn-info btn-block">Jefatura</button>
                        @elseif($area->tipo == 5)
                        <button class="btn btn-sx btn-dark btn-block">Programa / Área</button>
                        @elseif($area->tipo == 6)
                        <button class="btn btn-sx btn-secondary btn-block">Subsecretaría</button>
                        @else
                        <button class="btn btn-sx btn-danger btn-block">ERROR : SIN TIPO </button>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('showArea', $area->id) }}" class="btn btn-info"><i class="fa-solid fa-gear"></i></a>
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
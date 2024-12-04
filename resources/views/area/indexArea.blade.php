@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Area :: Dashboard</strong></h1>
@stop

@section('content')
    <a href="{{ route('createArea') }}" class="btn btn-success">Nuevo registro</a>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><strong>Lista de registros</strong></h3>
        </div> 
        <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Área</th>
                    <th>Correo Not.</th>
                    <th>Responsable</th>
                    <th>Siglas</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
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
                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
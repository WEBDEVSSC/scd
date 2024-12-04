@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Usuarios :: Dashboard</strong></h1>
@stop

@section('content')
    <a href="{{ route('createUsuario') }}" class="btn btn-success">Nuevo registro</a>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><strong>Lista de registros</strong></h3>
        </div> 
        <div class="card-body">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Área</th>
                    <th>Nivel</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->id_area_label }}</td>
                    <td>{{ $usuario->nivel_label }}</td>
                    <td><a href="{{ route('showUsuario', $usuario->id) }}" class="btn btn-info">Ver Detalles</a></td>
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
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Usuarios <small>Dashboard</small></strong></h1>
@stop

@section('content')

<!-- ---------------------------------------------------------------- -->

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Datos guardados exitosamente!', 
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    });
</script>
@endif

@if(session('delete'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Datos eliminados exitosamente!', 
            icon: 'success',
            confirmButtonText: 'Ok'
        });
    });
</script>
@endif

<!-- ---------------------------------------------------------------- -->
  

    <div class="card card-info card-outline">
        <div class="card-header">

            <a href="{{ route('createUsuario') }}" class="btn btn-info float-right"><i class="fa-solid fa-plus" aria-hidden="true"></i> NUEVO REGISTRO</a>        

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
                    <td>
                        <a href="{{ route('showUsuario', $usuario->id) }}" class="btn btn-info"><i class="fa-solid fa-gear"></i></a>
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
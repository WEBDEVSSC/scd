@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
    <h1><strong>Usuarios <small>Detalles</small></strong></h1>
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
            <a href="{{ route('indexUsuario') }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            <a href="{{ route('editUsuario',$usuario->id) }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-pen" aria-hidden="true"></i> EDITAR
            </a>
            <button class="btn btn-info ml-2" id="deleteButton" data-id="{{ $usuario->id }}">
                <i class="fa-solid fa-trash" aria-hidden="true"></i> ELIMINAR
            </button>
        </div>
        
        <div class="card-body">

            <table class="table table-striped">
                <tr>
                    <td style="width: 10%"><strong>Nombre : </strong></td>
                    <td>{{ $usuario->name }}</td>
                </tr>
                <tr>
                    <td><strong>E-mail : </strong></td>
                    <td>{{ $usuario->email }}</td>
                </tr>
                <tr>
                    <td><strong>Cargo : </strong></td>
                    <td>{{ $usuario->cargo }}</td>
                </tr>
                <tr>
                    <td><strong>Área : </strong></td>
                    <td>{{ $usuario->id_area_label }}</td>
                </tr>
                <tr>
                    <td><strong>Nivel : </strong></td>
                    <td>{{ $usuario->nivel_label }}</td>
                </tr>
                <tr>
                    <td><strong>Firma : </strong></td>
                    <td><img src="{{ asset($usuario->firma) }}" width="300px"></td>
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
    <script>
        // Escuchar el click del botón de eliminar
        document.getElementById('deleteButton').addEventListener('click', function (e) {
            // Obtener el ID del usuario
            var userId = this.getAttribute('data-id');
            
            // Mostrar la alerta de confirmación con SweetAlert2
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="fa fa-check" aria-hidden="true"></i> ELIMINAR',
                cancelButtonText: '<i class="fa fa-ban" aria-hidden="true"></i> CANCELAR'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si se confirma, se hace la solicitud de eliminación
                    // Redirigimos a la ruta de eliminación con el ID del usuario
                    window.location.href = '/admin/deteleUser/' + userId; // Ajuste según tu ruta
                }
            });
        });
    </script> 
@stop
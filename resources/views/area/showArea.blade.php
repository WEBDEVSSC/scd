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

        @if(auth()->check() && auth()->user()->role === 'admin')
        
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('indexArea') }}" class="btn btn-info ml-2 btn-sm">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            <a href="{{ route('editArea',$area->id) }}" class="btn btn-info ml-2 btn-sm">
                <i class="fa-solid fa-pen" aria-hidden="true"></i> EDITAR
            </a>
            <button class="btn btn-info ml-2 btn-sm" id="deleteButton" data-id="{{ $area->id }}">
                <i class="fa-solid fa-trash" aria-hidden="true"></i> ELIMINAR
            </button>
        </div>

        @else

        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('misAreas') }}" class="btn btn-info ml-2 btn-sm">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> MIS ÁREAS
            </a>
        </div>

        @endif

        
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
            var areaId = this.getAttribute('data-id');
            
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
                    window.location.href = '/admin/deleteArea/' + areaId; // Ajuste según tu ruta
                }
            });
        });
    </script>
@stop
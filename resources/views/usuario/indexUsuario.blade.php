@extends('adminlte::page')

@section('title', 'Usuarios | Dashboard')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Usuarios</h1>
            <small class="text-muted">Gestión y administración de cuentas de usuario</small>
        </div>
        <a href="{{ route('createUsuario') }}" class="btn btn-purple shadow-sm font-weight-bold px-3">
            <i class="fas fa-plus mr-1"></i> NUEVO REGISTRO
        </a>
    </div>
@stop

@section('content')

<!-- Alertas SweetAlert2 -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Datos guardados exitosamente!', 
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#6f42c1',
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endif

@if(session('delete'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Datos eliminados exitosamente!', 
            text: "{{ session('delete') }}",
            icon: 'success',
            confirmButtonColor: '#6f42c1',
            confirmButtonText: 'Aceptar'
        });
    });
</script>
@endif

<div class="card card-outline card-purple shadow-sm border-0">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table id="usuariosTable" class="table table-hover align-middle w-100">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="text-center" style="width: 5%">ID</th>
                        <th style="width: 25%">Nombre</th>
                        <th style="width: 25%">Correo</th>
                        <th style="width: 25%">Área</th>
                        <th class="text-center" style="width: 15%">Nivel</th>
                        <th class="text-center" style="width: 5%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                    <tr>
                        <td class="text-center align-middle font-weight-bold text-muted">{{ $usuario->id }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $usuario->name }}</td>
                        <td class="align-middle">
                            <a href="mailto:{{ $usuario->email }}" class="link-purple text-decoration-none">
                                <i class="far fa-envelope mr-1 text-purple"></i>{{ $usuario->email }}
                            </a>
                        </td>
                        <td class="align-middle text-secondary">{{ $usuario->id_area_label }}</td>
                        <td class="text-center align-middle">
                            <span class="badge badge-soft-purple w-100 py-2">{{ $usuario->nivel_label }}</span>
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('showUsuario', $usuario->id) }}" class="btn btn-sm btn-light text-purple border" data-toggle="tooltip" title="Configurar usuario">
                                <i class="fas fa-cog"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
<style>
    /* Identidad Morada Institucional */
    .text-purple { color: #6f42c1 !important; }

    .link-purple {
        color: #6f42c1;
        transition: color 0.2s;
    }
    .link-purple:hover {
        color: #5a32a3;
        text-decoration: underline;
    }

    /* Botón Principal Morado */
    .btn-purple {
        background-color: #6f42c1;
        color: #ffffff;
        border-color: #6f42c1;
        transition: all 0.2s ease;
    }
    .btn-purple:hover {
        background-color: #5a32a3;
        color: #ffffff;
        border-color: #5a32a3;
        transform: translateY(-1px);
    }

    /* Borde Superior de la Tarjeta */
    .card-purple.card-outline {
        border-top: 3px solid #6f42c1;
    }

    /* Badge Morado Suave */
    .badge-soft-purple {
        background-color: #f3e8ff;
        color: #6f42c1;
        font-weight: 700;
    }

    /* Ajustes generales de la Tabla */
    #usuariosTable thead th {
        border-bottom: 2px solid #e2e8f0;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    #usuariosTable tbody td {
        vertical-align: middle !important;
        font-size: 0.92rem;
    }
    .table-hover tbody tr:hover {
        background-color: #faf5ff;
    }

    /* Paginación DataTables Morada */
    .page-item.active .page-link {
        background-color: #6f42c1 !important;
        border-color: #6f42c1 !important;
    }
    .page-link {
        color: #6f42c1;
    }
    .page-link:hover {
        color: #5a32a3;
    }
</style>
@stop

@section('js')
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        $('#usuariosTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando _START_ al _END_ de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando 0 al 0 de 0 registros",
                "sInfoFiltered":   "(filtrado de _MAX_ registros)",
                "sSearch":         "Buscar:",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                }
            }
        });
    });
</script>
@stop
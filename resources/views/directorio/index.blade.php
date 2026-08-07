@extends('adminlte::page')

@section('title', 'Directorio | Panel de Control')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Directorio</h1>
            <small class="text-muted">Panel de control y consulta de información de contacto</small>
        </div>
    </div>
@stop

@section('content')

<!-- Alerta SweetAlert2 -->
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            title: '¡Registro completado!',
            text: "{{ session('success') }}",
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
            <table id="directorioTable" class="table table-hover align-middle w-100">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="text-center" style="width: 5%">ID</th>
                        <th style="width: 30%">Área</th>
                        <th style="width: 25%">Responsable</th>
                        <th style="width: 25%">Correo</th>
                        <th class="text-center" style="width: 10%">Extensión</th>
                        <th class="text-center" style="width: 5%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($areas as $area)
                    <tr>
                        <td class="text-center align-middle font-weight-bold text-muted">{{ $area->id }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $area->nombre }}</td>
                        <td class="align-middle text-secondary">{{ $area->responsable }}</td>
                        <td class="align-middle">
                            <a href="mailto:{{ $area->correo }}" class="link-purple text-decoration-none">
                                <i class="far fa-envelope mr-1 text-purple"></i>{{ $area->correo }}
                            </a>
                        </td>
                        <td class="text-center align-middle">
                            <span class="badge badge-light border px-2 py-1 text-purple font-weight-bold">
                                <i class="fas fa-phone-alt mr-1"></i>{{ $area->extension }}
                            </span>
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('directorioEdit', $area->id) }}" class="btn btn-sm btn-light text-purple border" data-toggle="tooltip" title="Editar contacto">
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

    .card-purple.card-outline {
        border-top: 3px solid #6f42c1;
    }

    /* Estilos de Tabla */
    #directorioTable thead th {
        border-bottom: 2px solid #e2e8f0;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    #directorioTable tbody td {
        vertical-align: middle !important;
        font-size: 0.92rem;
    }
    .table-hover tbody tr:hover {
        background-color: #faf5ff;
    }

    /* DataTables Paginación Morada */
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

        $('#directorioTable').DataTable({
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
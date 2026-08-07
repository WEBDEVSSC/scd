@extends('adminlte::page')

@section('title', 'Áreas | Dashboard')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Áreas</h1>
            <small class="text-muted">Gestión y administración de áreas institucionales</small>
        </div>
        <a href="{{ route('createArea') }}" class="btn btn-purple shadow-sm font-weight-bold px-3">
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
            title: '¡Registro completado!',
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
            <table id="areaTable" class="table table-hover align-middle w-100">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="text-center" style="width: 5%">ID</th>
                        <th style="width: 25%">Área</th>
                        <th style="width: 20%">Correo notificación</th>
                        <th style="width: 20%">Responsable</th>
                        <th class="text-center" style="width: 10%">Siglas</th>
                        <th class="text-center" style="width: 15%">Tipo</th>
                        <th class="text-center" style="width: 5%">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                    <tr>
                        <td class="text-center align-middle font-weight-bold text-muted">{{ $area->id }}</td>
                        <td class="align-middle font-weight-bold text-dark">{{ $area->nombre }}</td>
                        <td class="align-middle">
                            <a href="mailto:{{ $area->correo }}" class="link-purple text-decoration-none">
                                <i class="far fa-envelope mr-1 text-purple"></i>{{ $area->correo }}
                            </a>
                        </td>
                        <td class="align-middle text-secondary">{{ $area->responsable }}</td>
                        <td class="text-center align-middle">
                            <span class="badge badge-light border px-2 py-1 text-purple font-weight-bold">{{ $area->siglas }}</span>
                        </td>
                        <td class="text-center align-middle">
                            @switch($area->tipo)
                                @case(1)
                                    <span class="badge badge-soft-purple w-100 py-2">SECRETARIO DE SALUD</span>
                                    @break
                                @case(2)
                                    <span class="badge badge-soft-secondary w-100 py-2">SUBSECRETARÍA</span>
                                    @break
                                @case(3)
                                    <span class="badge badge-soft-success w-100 py-2">SUBDIRECCIÓN</span>
                                    @break
                                @case(4)
                                    <span class="badge badge-soft-info w-100 py-2">JEFATURA</span>
                                    @break
                                @case(5)
                                    <span class="badge badge-soft-dark w-100 py-2">PROGRAMA / ÁREA</span>
                                    @break
                                @case(6)
                                    <span class="badge badge-soft-warning w-100 py-2">UNIDAD</span>
                                    @break
                                @default
                                    <span class="badge badge-soft-danger w-100 py-2">SIN TIPO</span>
                            @endswitch
                        </td>
                        <td class="text-center align-middle">
                            <a href="{{ route('showArea', $area->id) }}" class="btn btn-sm btn-light text-purple border" data-toggle="tooltip" title="Configurar área">
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
    /* Estilos Generales para la Identidad Morada */
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
    }
    .btn-purple:hover {
        background-color: #5a32a3;
        color: #ffffff;
        border-color: #5a32a3;
    }

    /* Borde Superior de la Tarjeta */
    .card-purple.card-outline {
        border-top: 3px solid #6f42c1;
    }

    /* Badges Suaves */
    .badge-soft-purple { background-color: #f3e8ff; color: #6f42c1; font-weight: 700; }
    .badge-soft-secondary { background-color: #f1f5f9; color: #475569; font-weight: 600; }
    .badge-soft-success { background-color: #dcfce7; color: #166534; font-weight: 600; }
    .badge-soft-info { background-color: #e0f2fe; color: #075985; font-weight: 600; }
    .badge-soft-dark { background-color: #f3f4f6; color: #1f2937; font-weight: 600; }
    .badge-soft-warning { background-color: #fef3c7; color: #92400e; font-weight: 600; }
    .badge-soft-danger { background-color: #fee2e2; color: #991b1b; font-weight: 600; }

    /* Ajustes generales de la Tabla */
    #areaTable thead th {
        border-bottom: 2px solid #e2e8f0;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    #areaTable tbody td {
        vertical-align: middle !important;
        font-size: 0.92rem;
    }
    .table-hover tbody tr:hover {
        background-color: #faf5ff; /* Resaltado sutil en morado claro al pasar el mouse */
    }

    /* Paginación de DataTables en Morado */
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

        $('#areaTable').DataTable({
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
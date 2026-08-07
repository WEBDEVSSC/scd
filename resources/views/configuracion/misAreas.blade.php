@extends('adminlte::page')

@section('title', 'Mis Áreas | Panel de Control')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Configuración</h1>
            <small class="text-muted">Mis Áreas</small>
        </div>
        <div>
            <a href="{{ route('createArea') }}" class="btn btn-purple font-weight-bold shadow-sm">
                <i class="fas fa-plus-circle mr-1"></i> NUEVA ÁREA
            </a>
        </div>
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

    <div class="card card-outline card-purple shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h3 class="card-title font-weight-bold text-dark mb-0">
                <i class="fas fa-sitemap text-purple mr-2"></i> Listado de Áreas Registradas
            </h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tabla-areas" class="table table-hover table-striped align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">ID</th>
                            <th>NOMBRE</th>
                            <th>RESPONSABLE</th>
                            <th>SIGLAS</th>
                            <th>CORREO</th>
                            <th>EXTENSIÓN</th> 
                            <th class="text-center" style="width: 160px;">TIPO</th>
                            <th class="text-center" style="width: 80px;">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($areas as $area)
                            <tr>
                                <td class="text-center font-weight-bold text-secondary">{{ $area->id }}</td>
                                <td class="font-weight-bold text-dark">{{ $area->nombre }}</td>
                                <td class="text-secondary">{{ $area->responsable }}</td>
                                <td>
                                    <span class="badge badge-light border text-dark font-weight-bold">{{ $area->siglas }}</span>
                                </td>
                                <td class="text-secondary">{{ $area->correo }}</td>
                                <td class="text-secondary">{{ $area->extension }}</td>
                                <td class="text-center">
                                    @if($area->tipo == 1)
                                        <span class="badge badge-purple px-2 py-1 d-block">SECRETARIO DE SALUD</span>
                                    @elseif($area->tipo == 2)
                                        <span class="badge badge-secondary px-2 py-1 d-block">SUBSECRETARÍA</span>
                                    @elseif($area->tipo == 3)
                                        <span class="badge badge-success px-2 py-1 d-block">SUBDIRECCIÓN</span>
                                    @elseif($area->tipo == 4)
                                        <span class="badge badge-info px-2 py-1 d-block">JEFATURA</span>
                                    @elseif($area->tipo == 5)
                                        <span class="badge badge-dark px-2 py-1 d-block">PROGRAMA / ÁREA</span>
                                    @elseif($area->tipo == 6)
                                        <span class="badge badge-warning px-2 py-1 d-block text-dark">UNIDAD</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1 d-block">SIN TIPO</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('editArea', $area->id) }}" 
                                       class="btn btn-outline-purple btn-sm shadow-sm" 
                                       data-toggle="tooltip" 
                                       data-placement="top" 
                                       title="Editar Registro">
                                        <i class="fas fa-pen"></i>
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
        .bg-purple { background-color: #6f42c1 !important; }

        .card-purple.card-outline {
            border-top: 3px solid #6f42c1;
        }

        .badge-purple {
            background-color: #6f42c1;
            color: #ffffff;
        }

        .btn-purple {
            background-color: #6f42c1;
            border-color: #6f42c1;
            color: #ffffff;
        }

        .btn-purple:hover {
            background-color: #5a32a3;
            border-color: #5a32a3;
            color: #ffffff;
        }

        .btn-outline-purple {
            color: #6f42c1;
            border-color: #6f42c1;
            background-color: transparent;
        }

        .btn-outline-purple:hover {
            background-color: #6f42c1;
            color: #ffffff;
        }

        /* Estilos DataTables */
        .page-item.active .page-link {
            background-color: #6f42c1 !important;
            border-color: #6f42c1 !important;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function () {
            // Inicialización de Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Inicialización de DataTables
            $('#tabla-areas').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                },
                "responsive": true,
                "autoWidth": false,
                "pageLength": 10,
                "order": [[ 0, "desc" ]]
            });
        });
    </script>
@stop
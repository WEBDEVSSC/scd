@extends('adminlte::page')

@section('title', 'Documentos Recibidos | Panel de Control')

@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div>
            <h1 class="m-0 text-dark font-weight-bold">Documentos Recibidos</h1>
            <small class="text-muted">Nuevos</small>
        </div>
        <div>
            <a href="{{ route('documentosRecibidosExport') }}" class="btn btn-success font-weight-bold shadow-sm">
                <i class="fas fa-file-excel mr-1"></i> EXPORTAR EXCEL
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

    @if (session('delete'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Eliminado',
                    text: "{{ session('delete') }}",
                    confirmButtonColor: '#6f42c1',
                    confirmButtonText: 'Aceptar'
                });
            });
        </script>
    @endif

    <div class="card card-outline card-purple shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h3 class="card-title font-weight-bold text-dark mb-0">
                <i class="fas fa-list text-purple mr-2"></i> Listado de Documentos Recibidos
            </h3>
        </div>
        
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="table" class="table table-hover table-striped align-middle w-100">
                    <thead class="bg-light">
                        <tr>
                            <th class="text-center" style="width: 50px;">CONS</th>
                            <th class="text-center" style="width: 100px;">STATUS</th>
                            <th style="width: 120px;">FOLIO</th>
                            <th>EMISOR</th>
                            <th>TURNADO</th>
                            <th>ASUNTO</th>
                            <th class="text-center" style="width: 110px;">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documentos as $documento)
                            <tr>
                                <td class="text-center font-weight-bold text-secondary">{{ $documento->consecutivo }}</td>
                                <td class="text-center">
                                    @if($documento->status == 'NUEVO')
                                        <span class="badge badge-purple px-2 py-1">NUEVO</span>
                                    @elseif($documento->status == 'TURNADO A AREA')
                                        <span class="badge badge-warning px-2 py-1 text-dark">TURNADO A ÁREA</span>
                                    @elseif($documento->status == 'ATENDIDO')
                                        <span class="badge badge-success px-2 py-1">ATENDIDO</span>
                                    @else
                                        <span class="badge badge-secondary px-2 py-1">
                                            {{ $documento->status }}
                                        </span>
                                    @endif
                                </td>
                                <td><span class="font-weight-bold text-dark">{{ $documento->folio }}</span></td>
                                <td>{{ $documento->emisor }}</td>
                                <td>{{ $documento->turnado_area_label }}</td>
                                <td>{{ Str::limit($documento->asunto, 150) }}</td>
                                <td class="text-center">
                                    <div class="btn-grid-actions">
                                        <!-- FILA 1 -->
                                        <div class="btn-group-row">
                                            {{-- VER DETALLES --}}
                                            <a href="{{ route('documentosRecibidosShow', $documento->id) }}" 
                                               class="btn btn-outline-purple btn-action"
                                               data-toggle="tooltip" title="Ver Detalles">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            {{-- EDITAR --}}
                                            <a href="{{ route('documentosRecibidosEdit', $documento->id) }}" 
                                               class="btn btn-outline-warning btn-action"
                                               data-toggle="tooltip" title="Actualizar Registro">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            {{-- SUBIR / ACTUALIZAR PDF --}}
                                            @if($documento->documento)
                                                <a href="{{ route('documentosRecibidosCargar', $documento->id) }}" 
                                                   class="btn btn-outline-success btn-action"
                                                   data-toggle="tooltip" title="Actualizar PDF">
                                                    <i class="fas fa-file-upload"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('documentosRecibidosCargar', $documento->id) }}" 
                                                   class="btn btn-outline-danger btn-action"
                                                   data-toggle="tooltip" title="Subir PDF">
                                                    <i class="fas fa-file-upload"></i>
                                                </a>
                                            @endif
                                        </div>

                                        <!-- FILA 2 -->
                                        <div class="btn-group-row">
                                            {{-- TURNAR --}}
                                            <a href="{{ route('documentosRecibidosTurnar', $documento->id) }}" 
                                               class="btn btn-outline-info btn-action"
                                               data-toggle="tooltip" title="Turnar a Área">
                                                <i class="fas fa-share-square"></i>
                                            </a>

                                            {{-- FICHA TÉCNICA PDF --}}
                                            <a href="{{ route('fichaTecnicaPDF', $documento->id) }}" 
                                               target="_blank"
                                               class="btn btn-outline-dark btn-action"
                                               data-toggle="tooltip" title="Ficha Técnica">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>

                                            {{-- ELIMINAR --}}
                                            <form action="{{ route('documentosRecibidosDestroy', $documento->id) }}" 
                                                  method="POST" class="form-eliminar d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-outline-danger btn-action"
                                                        data-toggle="tooltip" title="Eliminar Registro">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
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

        .card-purple.card-outline {
            border-top: 3px solid #6f42c1;
        }

        .badge-purple {
            background-color: #6f42c1;
            color: #ffffff;
        }

        /* Estilos de botones de acción */
        .btn-grid-actions {
            display: flex;
            flex-direction: column;
            gap: 4px;
            width: 102px;
            margin: 0 auto;
        }

        .btn-group-row {
            display: flex;
            gap: 4px;
            justify-content: center;
        }

        .btn-action {
            width: 30px;
            height: 30px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            border-radius: 0.25rem;
            transition: all 0.2s ease;
        }

        .btn-outline-purple {
            color: #6f42c1;
            border-color: #6f42c1;
        }
        .btn-outline-purple:hover {
            background-color: #6f42c1;
            color: #ffffff;
        }

        /* Modificaciones DataTables */
        table.dataTable tbody td {
            vertical-align: middle !important;
        }

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
            // Inicializar Tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Configuración DataTables
            $('#table').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sSearch":         "Buscar:",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": activar para ordenar la columna ascendente",
                        "sSortDescending": ": activar para ordenar la columna descendente"
                    }
                },
                "pageLength": 10,
                "responsive": true,
                "autoWidth": false
            });

            // Confirmación de eliminación con SweetAlert2
            $(document).on('submit', '.form-eliminar', function(e) {
                e.preventDefault();
                var form = this;

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Este registro se eliminará permanentemente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop
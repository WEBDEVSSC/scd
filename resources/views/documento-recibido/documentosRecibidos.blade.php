@extends('adminlte::page')

@section('title', 'Documentos Recibidos')

@section('plugins.Sweetalert2', true)

@section('plugins.Datatables', true)

@section('content_header')
<h1>
    <strong>Documentos Recibidos</strong>
    <small class="text-muted">Nuevos</small>
</h1>
@stop

@section('content')

<!-- ---------------------------------------------------------------- -->

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Registro completado! ',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonText: 'Ok'
                });
            });
        </script>
    @endif

<!-- ---------------------------------------------------------------- -->

<div class="card card-info card-outline">
    
    <div class="card-body">

        <table id="table" class="table table-striped">
            <thead>
                <tr>
                    <th>CONS</th>
                    <th>FOLIO</th>
                    <th>EMISOR</th>
                    <th>ASUNTO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentos as $documento)
                    <tr>
                        <td>{{ $documento->consecutivo }}</td>
                        <td>{{ $documento->folio}}</td>
                        <td>{{ $documento->emisor }}</td>
                        <td>{{ $documento->asunto }}</td>     
                        
                        <td>
                            
                            <div style="display: flex; flex-direction: column; gap: 5px;">

                                <!-- FILA 1 -->
                                <div style="display: flex; gap: 5px;">
                                    
                                    {{-- VER DETALLES--}}
                                    <a href="{{ route('documentosRecibidosShow', $documento->id) }}" 
                                    class="btn btn-primary btn-sm flex-fill text-center"
                                    data-toggle="tooltip" title="Ver Detalles">
                                    <i class="fa-solid fa-file"></i>
                                    </a>

                                    {{-- EDITAR --}}
                                    <a href="{{ route('documentosRecibidosEdit', $documento->id) }}" 
                                    class="btn btn-warning btn-sm flex-fill text-center"
                                    data-toggle="tooltip" title="Actualizar Registro">
                                        
                                        <i class="fa-solid fa-pen-to-square text-white"></i>
                                    </a>

                                    {{-- SUBIR / ACTUALIZAR PDF --}}
                                    @if($documento->documento)
                                        <a href="{{ route('documentosRecibidosCargar', $documento->id) }}" 
                                        class="btn btn-success btn-sm flex-fill text-center"
                                        data-toggle="tooltip" title="Actualizar PDF">
                                        <i class="fa-solid fa-file-arrow-up"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('documentosRecibidosCargar', $documento->id) }}" 
                                        class="btn btn-danger btn-sm flex-fill text-center"
                                        data-toggle="tooltip" title="Subir PDF">
                                        <i class="fa-solid fa-file-arrow-up"></i>
                                        </a>
                                    @endif

                                </div>

                                <!-- FILA 2 -->
                                <div style="display: flex; gap: 5px;">

                                    {{-- TURNAR --}}
                                    <a href="{{ route('documentosRecibidosTurnar', $documento->id) }}" 
                                    class="btn btn-info btn-sm flex-fill text-center"
                                    data-toggle="tooltip" title="Turnar a Área">
                                    <i class="fa-solid fa-file-export"></i>
                                    </a>

                                    {{-- PDF --}}
                                    <a href="{{ route('fichaTecnicaPDF', $documento->id) }}" 
                                    target="_blank"
                                    class="btn btn-dark btn-sm flex-fill text-center"
                                    data-toggle="tooltip" title="Ficha Técnica">
                                    <i class="fa-solid fa-file-pdf"></i>
                                    </a>

                                    {{-- ELIMINAR --}}
                                    <form action="{{ route('documentosRecibidosDestroy', $documento->id) }}" 
                                        method="POST" class="form-eliminar flex-fill">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm w-100"
                                                data-toggle="tooltip" title="Eliminar Registro">
                                            <i class="fa-solid fa-trash-can"></i>
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
    
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <link rel="stylesheet" href="/css/admin_custom.css"> 
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
    
    <script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    </script>

    <script>$(document).ready( function () {
        $(document).ready(function() {
        $('#table').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": activar para ordenar la columna de manera descendente"
                }
            }
        });
    });
    } );
    </script>
@stop
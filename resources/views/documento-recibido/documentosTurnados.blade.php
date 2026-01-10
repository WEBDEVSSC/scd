@extends('adminlte::page')

@section('title', 'Documentos Recibidos')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1>
    <strong>Documentos Recibidos</strong>
    <small class="text-muted">Turnados a Área</small>
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

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>STATUS</th>
                    <th>FOLIO</th>
                    <th>EMISOR</th>
                    <th>ASUNTO</th>
                    <th>TURNADO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentos as $documento)
                    <tr>
                        <td>{{ $documento->id }}</td>
                        <td>{{ $documento->status }}</td>
                        <td>{{ $documento->folio}}</td>
                        <td>{{ $documento->emisor }}</td>
                        <td>{{ $documento->asunto }}</td>                        
                        <td>{{ $documento->turnado_area_label }}</td>                        
                        <td>
                            <a href="{{ route('documentosRecibidosShow', $documento->id) }}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Ver documento"><i class="fa-solid fa-file"></i></a>
                            
                            {{-- Mostramos este boton solo si tiene el nivel de subdireccion --}}
                            @if (auth()->user()->nivel == 3)

                                @if($documento->documento)
                                    {{-- sí hay documento --}}
                                    <a href="{{ route('documentosRecibidosCargar', $documento->id) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Actualizar PDF"><i class="fa-solid fa-file-arrow-up"></i></a>
                                @else
                                    {{-- no hay documento --}}
                                    <a href="{{ route('documentosRecibidosCargar', $documento->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Subir PDF"><i class="fa-solid fa-file-arrow-up"></i></a>
                                @endif

                            @endif

                            @if (auth()->user()->nivel == 4)

                                {{-- Si es nivel Jefe de Departamento le mostramos el boton de respuesta --}}

                                <a href="{{ route('documentosRecibidosTurnadosRespuestaCreate', $documento->id) }}" class="btn btn-info btn-sm"  data-toggle="tooltip" data-placement="top" title="Dar respuesta"><i class="fa-solid fa-file-circle-plus"></i></a>

                            @endif
                            
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
@stop
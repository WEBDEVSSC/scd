@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1><strong>Documentos</strong><small> Pendientes de firma</small></h1>
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

<div class="card card-purple card-outline">
    <div class="card-body">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>STATUS</th>
                    <th>FOLIO</th>
                    <th>EMISOR</th>
                    <th>RECEPTOR</th>
                    <th>FIRMA</th>
                    <th>ASUNTO</th>
                    
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($documentos as $documento)
                    <tr>
                        <td>{{ $documento->id }}</td>
                        <td>{{ $documento->status_label }}</td>
                        <td>{{ $documento->siglas }}/{{ $documento->tipo }}/{{ $documento->consecutivo }}/{{ $documento->created_at->format('Y') }}</td>
                        <td>{{ $documento->area_responsable }} <br> <small><strong>{{ $documento->area_label }}</strong></small></td>
                        <td>{{ $documento->para_label }} <br> <small><strong>{{ $documento->para_area }}</strong></small></strong></td>
                        <td>{{ $documento->firma_label }} <br> <small><strong>{{ $documento->firma_area }}</strong></small></strong></td>
                        <td>{{ $documento->asunto }}</td>
                        
                        <td><a href="{{ route('showDocumento', $documento->id) }}" class="btn btn-info">DETALLES</a></td>
                        <td><a href="{{ route('pdfDocumento', $documento->id) }}" class="btn btn-danger" target="_blank">PDF</a></td>
                          
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
    
@stop

@section('footer')
<p>Copyright © <?php echo date('Y') ?> <strong>Servicios de Salud de Coahuila de Zaragoza</strong></p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
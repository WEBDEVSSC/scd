@extends('adminlte::page')

@section('title', 'Documentos Recibidos')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1>
    <strong>Documentos Recibidos</strong>
    <small class="text-muted">Atendidos</small>
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
                            <a href="{{ route('documentosRecibidosShow', $documento->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-file"></i></a>
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
@stop
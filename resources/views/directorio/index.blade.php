@extends('adminlte::page')

@section('title', 'Dashboard')

@section('plugins.Sweetalert2', true)

@section('content_header')
<h1><strong>Directorio </strong><small class="text-muted"> Panel de Control</small></h1>
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
                    <th>AREA</th>
                    <th>RESPONSABLE</th>
                    <th>CORREO</th>
                    <th>EXTENSIÓN</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($areas as $area)
                    <tr>
                        <td>{{ $area->id }}</td>
                        <td>{{ $area->nombre }}</td>                                           
                        <td>{{ $area->responsable }}</td>
                        <td>{{ $area->correo }}</td>
                        <td>{{ $area->extension }}</td>
                        <td>
                            <a href="{{ route('directorioEdit', $area->id) }}" class="btn btn-info btn-sm"><i class="fa-solid fa-gear"></i></a>
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
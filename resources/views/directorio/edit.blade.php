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
    <div class="card-header">
        <strong>Area : </strong>{{ $area->nombre }}
    </div>

    <form action="{{ route('directorioUpdate', $area->id)}}" method="POST">

    @csrf

    @method('PUT')

    <div class="card-body">

        <div class="row">
            <div class="col-md-3">
                <p><strong>Responsable</strong></p>
                <input type="text" name="responsable" id="responsable" class="form-control" value="{{ old('responsable', $area->responsable) }}">

                @error('responsable')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3">
                <p><strong>E-mail</strong></p>
                <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo', $area->correo) }}">

                @error('correo')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="col-md-3">
                <p><strong>Extensión</strong></p>
                <input type="text" name="extension" id="extension" class="form-control" value="{{ old('extension', $area->extension) }}">

                @error('extension')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

    </div>

    <div class="card-footer">
            <button type="submit" class="btn btn-success btn-sm">REGISTRAR DATOS</button>
        </form>
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
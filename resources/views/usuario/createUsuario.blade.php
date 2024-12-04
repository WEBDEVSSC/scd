@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Area :: Nuevo registro</strong></h1>
@stop

@section('content')
    <form action="{{ route('storeUsuario') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <!-- ---------------------------------------------------------------------- -->

        <div class="row">
            <div class="col-md-6">
                <p><strong>Nombre</strong></p>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                @error('nombre')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>    
            <div class="col-md-3">
                <p><strong>E-mail</strong></p>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}">
                @error('correo')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>        
            <div class="col-md-3">
                <p><strong>Contraseña</strong></p>
                <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                @error('password')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- ---------------------------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-3">
                <p><strong>Cargo</strong></p>
                <input type="text" name="cargo" class="form-control" value="{{ old('cargo') }}">
                @error('cargo')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3">
                <p><strong>Relación Área</strong></p>
                <select name="id_area" id="id_area" class="form-control">
                    @foreach($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <p><strong>Nivel</strong></p>
                <select name="nivel" id="nivel" class="form-control">
                    @foreach($niveles as $nivel)
                        <option value="{{ $nivel->id }}">{{ $nivel->nivel }}</option>
                    @endforeach
                </select>
            </div>
                    
            <div class="col-md-3">
                <p><strong>Firma</strong></p>
                <input type="file" name="firma" id="firma" class="form-control">
            </div>
        </div>

        <!-- ---------------------------------------------------------------------- -->

        <div class="row mt-3">
            <div class="col-md-12">

                <center>
                    <button type="submit" class="btn btn-success">Registrar datos</button>
                </center>

            </div>  
        </div>

    </form>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
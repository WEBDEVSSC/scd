@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Area</strong> <small>Nuevo registro</small></h1>
@stop

@section('content')

<div class="card card-info card-outline">
    <div class="card-header"></div>
    <div class="card-body">

        <form action="{{ route('storeArea') }}" method="POST" enctype="multipart/form-data">

            @csrf
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row">
                <div class="col-md-3">
                    <p><strong>Nombre</strong></p>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                    @error('nombre')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>            
                <div class="col-md-3">
                    <p><strong>Responsable</strong></p>
                    <input type="text" name="responsable" class="form-control" value="{{ old('responsable') }}">
                    @error('responsable')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p><strong>Siglas</strong></p>
                    <input type="text" name="siglas" class="form-control" value="{{ old('siglas') }}">
                    @error('siglas')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row mt-3">
                
                <div class="col-md-3">
                    <p><strong>E-mail</strong></p>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo') }}">
                    @error('correo')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>           
                <div class="col-md-3">
                    <p><strong>Extensión</strong></p>
                    <input type="text" name="extension" class="form-control" value="{{ old('extension') }}">
                    @error('extension')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p><strong>Tipo</strong></p>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="">-- SELECCIONE UNA OPCION --</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id }}" 
                                {{ old('tipo') == $nivel->id ? 'selected' : '' }}>
                                {{ $nivel->nivel }}
                            </option>
                        @endforeach
                    </select>
                    @error('tipo')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <!-- ---------------------------------------------------------------------- -->
    
        

    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info float-right"><i class="fa fa-check-circle" aria-hidden="true"></i> REGISTRAR USUARIO</button> 
    </div>
</div>
</form>
    
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
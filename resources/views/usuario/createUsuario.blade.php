@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Usuarios <small>Nuevo registro</small> </strong></h1>
@stop

@section('content')

<div class="card card-info card-outline">
    <div class="card-header">

        <a href="{{ route('indexUsuario') }}" class="btn btn-info float-right"><i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD</a> 

    </div>
    <div class="card-body">

        <!-- ------------------------------------------------- -->

        <form action="{{ route('storeUsuario') }}" method="POST" enctype="multipart/form-data">

            @csrf
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre</strong></p>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
                    @error('nombre')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>    
                <div class="col-md-3">
                    <p><strong>E-mail</strong></p>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo') }}">
                    @error('correo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>        
                <div class="col-md-3">
                    <p><strong>Contraseña</strong></p>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row mt-3">
                <div class="col-md-3">
                    <p><strong>Cargo</strong></p>
                    <input type="text" name="cargo" class="form-control" value="{{ old('cargo') }}">
                    @error('cargo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p><strong>Relación Área</strong></p>
                    <select name="id_area" id="id_area" class="form-control">
                        <option value="">-- SELECCIONE UNA OPCIÓN --</option>
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}"
                                {{ old('id_area') == $area->id ? 'selected' : '' }}>
                                {{ $area->nombre }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_area')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p><strong>Nivel</strong></p>
                    <select name="nivel" id="nivel" class="form-control">
                        <option value="">-- SELECCIONE UNA OPCIÓN --</option>
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id }}"
                                {{ old('nivel') == $nivel->id ? 'selected' : '' }}>
                                {{ $nivel->nivel }}
                            </option>
                        @endforeach
                    </select>

                    @error('nivel')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                        
                <div class="col-md-3">
                    <p><strong>Firma</strong></p>
                    <input type="file" name="firma" id="firma" class="form-control">
                    @error('firma')
                        <small class="text-danger">{{ $message }}</small>
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
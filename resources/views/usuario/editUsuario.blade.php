@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Usuarios <small>Editar datos</small></strong></h1>
@stop

@section('content')

<div class="card card-info card-outline">
    <div class="card-title">

        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('indexUsuario') }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            <a href="{{ route('showUsuario',$usuario->id) }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DETALLES
            </a>
        </div>

    </div>
    <div class="card-body">

        <!-- ----------------------------------------------------------------- -->

        <form action="{{ route('updateUsuario',$usuario->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre</strong></p>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre',$usuario->name) }}">
                    @error('nombre')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>    
                <div class="col-md-3">
                    <p><strong>E-mail</strong></p>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo',$usuario->email) }}">
                    @error('correo')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>        
                <div class="col-md-3">
                    <p><strong>Contraseña</strong><small> Por seguridad no se muestra el dato</small></p>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row mt-3">
                <div class="col-md-3">
                    <p><strong>Cargo</strong></p>
                    <input type="text" name="cargo" class="form-control" value="{{ old('cargo',$usuario->cargo) }}">
                    @error('cargo')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <p><strong>Relación Área</strong></p>
                    <select name="id_area" id="id_area" class="form-control">
                        @foreach($areas as $area)
                            <option value="{{ $area->id }}" 
                                @if (old('id_area', $usuario->id_area) == $area->id) selected @endif>
                                {{ $area->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <p><strong>Nivel</strong></p>
                    <select name="nivel" id="nivel" class="form-control">
                        @foreach($niveles as $nivel)
                            <option value="{{ $nivel->id }}" 
                                @if (old('nivel', $usuario->nivel) == $nivel->id) selected @endif>
                                {{ $nivel->nivel }}
                            </option>
                        @endforeach
                    </select>
                </div>
                        
                <div class="col-md-3">
                    <p><strong>Firma</strong></p>
                    <input type="file" name="firma" id="firma" class="form-control">
                    @error('firma')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row mt-3 float-right">
                <div class="col-md-12">
                    <td><img src="{{ asset($usuario->firma) }}" width="300px"></td>
                    
                </div>
            </div>
    
      

        <!-- ----------------------------------------------------------------- -->

    </div>
    <div class="card-footer">

        <button type="submit" class="btn btn-info float-right"><i class="fa fa-check-circle" aria-hidden="true"></i> ACTUALIZAR DATOS</button>  
        
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
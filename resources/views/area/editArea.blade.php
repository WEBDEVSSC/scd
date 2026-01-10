@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1><strong>Area <small>Editar datos</small></strong></h1>
@stop

@section('content')

<div class="card card-info card-outline">
    <div class="card-title">

        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('indexArea') }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DASHBOARD
            </a>
            <a href="{{ route('showArea',$area->id) }}" class="btn btn-info ml-2">
                <i class="fa-solid fa-sliders" aria-hidden="true"></i> DETALLES
            </a>
        </div>

    </div>
    <div class="card-body">

        <!-- ----------------------------------------------------------------- -->

        <form action="{{ route('updateArea',$area->id) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row">
                <div class="col-md-3">
                    <p><strong>Nombre</strong></p>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre',$area->nombre) }}">
                    @error('nombre')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>    
                <div class="col-md-3">
                    <p><strong>Responsable</strong></p>
                    <input type="text" name="responsable" class="form-control" value="{{ old('responsable',$area->responsable) }}">
                    @error('responsable')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>        
                <div class="col-md-3">
                    <p><strong>Siglas</strong></p>
                    <input type="text" name="siglas" class="form-control" value="{{ old('siglas',$area->siglas) }}">
                    @error('siglas')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
    
            <!-- ---------------------------------------------------------------------- -->
    
            <div class="row mt-3">
                
                        
                <div class="col-md-3">
                    <p><strong>E-mail</strong></p>
                    <input type="email" name="correo" id="correo" class="form-control" value="{{ old('correo',$area->correo) }}">
                    @error('correo')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-3">
                    <p><strong>Extensión</strong></p>
                    <input type="text" name="extension" id="extension" class="form-control" value="{{ old('extension',$area->extension) }}">
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
                                {{ old('tipo', $area->tipo) == $nivel->id ? 'selected' : '' }}>
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

            <div class="row mt-3">
                <div class="col-md-12">
                    <p><strong>Firma actual</strong></p>
                    <td><img src="{{ asset($area->firma) }}" width="300px"></td>
                    {{$area->firma}}
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
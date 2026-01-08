@extends('adminlte::page')

@section('title', 'Documentos Recibidos')

@section('content_header')
<h1>
    <strong>Documentos Recibidos</strong>
    <small class="text-muted">Nuevo registro</small>
</h1>
@stop

@section('content')

<form action="{{ route('documentosRecibidosUpdate', $documento->id) }}" method="POST">
    @csrf

    @method('PUT')

    <div class="card card-info card-outline">
        <div class="card-body">

                <div class="row">

                    <div class="col-md-3">
                        <p><strong>Emisor</strong></p>
                        <select name="emisor" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ old('para',$documento->emisor_id) == $area->id ? 'selected' : '' }}>
                                    {{ $area->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('para')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Tipo</strong></p>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            <option value="OF" {{ old('tipo',$documento->tipo) == 'OF' ? 'selected' : '' }}>OFICIO</option>
                            <option value="MEM" {{ old('tipo',$documento->tipo) == 'MEM' ? 'selected' : '' }}>MEMORANDUM</option>
                            <option value="TI" {{ old('tipo',$documento->tipo) == 'TI' ? 'selected' : '' }}>TARJETA INFORMATIVA</option>
                            <option value="CIR" {{ old('tipo',$documento->tipo) == 'CIR' ? 'selected' : '' }}>CIRCULAR</option>
                            <option value="EM" {{ old('tipo',$documento->tipo) == 'EM' ? 'selected' : '' }}>E-MAIL</option>
                        </select>

                        @error('tipo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Folio</strong></p>
                        <input type="text" name="folio" class="form-control" value="{{ old('folio',$documento->folio) }}">
                    
                        @error('folio')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Fecha del documento</strong></p>
                        <input type="date" name="fecha_documento" class="form-control" value="{{ old('fecha_documento',$documento->fecha_documento) }}">
                    
                        @error('fecha_documento')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">

                    <div class="col-md-3">
                        <p><strong>Fecha y hora de recepción</strong></p>
                        <input type="datetime-local" name="fecha_recepcion" class="form-control" value="{{ old('fecha_recepcion',$documento->fecha_recepcion) }}">
                    
                        @error('fecha_recepcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-3">
                        <p><strong>Fecha límite de respuesta</strong></p>
                        <input type="date" name="fecha_limite" class="form-control" value="{{ old('fecha_limite',$documento->fecha_limite) }}">
                    
                        @error('fecha_limite')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <p><strong>Asunto</strong></p>
                        <input type="text" name="asunto" class="form-control" value="{{ old('asunto',$documento->asunto) }}">

                        @error('asunto')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-3">
                        <p><strong>Incluye anexo</strong></p>
                        <select name="anexo" id="anexo" class="form-control">
                            <option value="">-- Seleccione una opción --</option>
                            <option value="SI" {{ old('anexo',$documento->anexo) == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('anexo',$documento->anexo) == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>

                        @error('anexo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-9">
                        <p><strong>Descripción del anexo</strong></p>
                        <input type="text" name="anexo_descripcion" class="form-control" value="{{ old('anexo_descripcion',$documento->anexo_descripcion) }}">
                    
                        @error('anexo_descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">

                    

                    

                    
                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>Observaciones</strong></p>

                        <textarea name="contenido" id="contenido" class="form-control" rows="10">{{ old('contenido',$documento->contenido) }}</textarea>
                        
                        @error('contenido')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                

        </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-info float-right"><i class="fa fa-check-circle" aria-hidden="true"></i> ACTUALIZAR DOCUMENTO</button>   

            </div>

    </div>

</form>
    
@stop

@section('footer')
    @include('partials.footer')
@stop

@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/lang/summernote-es-ES.min.js"></script>


    <script>
    $(document).ready(function() {

        $('#contenido').summernote({
            height: 200,
            lang: 'es-ES',
            toolbar: [
                ['font', ['bold', 'italic', 'underline']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']]
            ]
        });

    });
    </script>

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

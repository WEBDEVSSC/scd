@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1><strong>Documentos</strong><small> Nuevo registro</small></h1>
@stop

@section('content')

<form action="{{ route('storeDocumento') }}" method="POST">
    @csrf

    <div class="card card-info card-outline">
        <div class="card-body">

            {{ $user->nivel }}

                <div class="row">

                    <div class="col-md-3">
                        <p><strong>Para</strong></p>
                        <select name="para" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ old('para') == $area->id ? 'selected' : '' }}>
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
                            <option value="OF" {{ old('tipo') == 'OF' ? 'selected' : '' }}>OFICIO</option>
                            <option value="MEM" {{ old('tipo') == 'MEM' ? 'selected' : '' }}>MEMORANDUM</option>
                            <option value="TI" {{ old('tipo') == 'TI' ? 'selected' : '' }}>TARJETA INFORMATIVA</option>
                        </select>

                        @error('tipo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <p><strong>Asunto</strong></p>
                        <input type="text" name="asunto" class="form-control" value="{{ old('asunto') }}">

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
                            <option value="SI" {{ old('anexo') == 'SI' ? 'selected' : '' }}>SI</option>
                            <option value="NO" {{ old('anexo') == 'NO' ? 'selected' : '' }}>NO</option>
                        </select>

                        @error('anexo')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-9">
                        <p><strong>Descripción</strong></p>
                        <input type="text" name="anexo_descripcion" class="form-control" value="{{ old('anexo_descripcion') }}">
                    
                        @error('anexo_descripcion')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-12">
                        <p><strong>Contenido</strong></p>

                        <textarea name="contenido" id="contenido" class="form-control" rows="10">{{ old('contenido') }}</textarea>
                        
                        @error('contenido')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><strong>Firma</strong></p>
                        <select name="firma" id="firma" class="form-control">
                            <option value="">-- Selecciona una opción --</option>
                            @foreach($listaFirmas as $firma)
                                <option value="{{ $firma->id }}" {{ old('firma') == $firma->id ? 'selected' : '' }}>
                                    {{ $firma->responsable }} - {{ $firma->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('firma')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

        </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-info float-right"><i class="fa fa-check-circle" aria-hidden="true"></i> REGISTRAR DOCUMENTO</button>            

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
<script>
    $(document).ready(function() {
        $('#contenido').summernote();
    });
</script>

<script>
$(document).ready(function() {
    // Inicialización básica de Summernote para los campos
    $('#descripcion').summernote({
        height: 200, // Altura del editor
        lang: 'es-ES', // Idioma español
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link', 'picture']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
});
</script>

    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

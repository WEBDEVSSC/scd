@extends('adminlte::page')

@section('title', 'Número de Folio')

@section('content_header')
<h1><strong>Documentos Recibidos</strong><small> Turnar</small></h1>
@stop

@section('content')

<form action="{{ route('documentosRecibidosTurnarStore', $documento->id) }}" method="POST">
    @csrf

    <div class="card card-info card-outline">

        <div class="card-header">
            {{$documento->folio}}
        </div>

        <div class="card-body">

                <!-- ------------------------------------------------------------------------------------- -->

                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><strong>Departamento</strong></p>

                        <select name="departamento_id"
                                class="form-control @error('departamento_id') is-invalid @enderror">
                            <option value="">-- Seleccione Una Opción --</option>

                            @foreach($listaDepartamentos as $departamento)
                                <option value="{{ $departamento->id }}"
                                    {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                                    {{ $departamento->nombre }}
                                </option>
                            @endforeach
                        </select>

                        @error('departamento_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                <div class="row mt-3">

                    <div class="col-md-12">
                        <p><strong>Observaciones</strong></p>

                        <textarea name="contenido" id="contenido" class="form-control" rows="10">{{ old('contenido') }}</textarea>
                        
                        @error('contenido')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                    </div>
                </div>

                <!-- ------------------------------------------------------------------------------------- -->

                

        </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-info float-right"><i class="fa fa-check-circle" aria-hidden="true"></i> REGISTRAR DOCUMENTO</button>   
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

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

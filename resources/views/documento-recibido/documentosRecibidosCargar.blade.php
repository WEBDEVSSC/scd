@extends('adminlte::page')

@section('title', 'Cargar Documento')

@section('content_header')
    <h1>
        <strong>Documentos Recibidos</strong>
        <small class="text-muted">Cargar</small>
    </h1>
@stop

@section('content')

<div class="row">

    {{-- ======================= CARGA DE DOCUMENTO ======================= --}}
    <div class="col-md-6">

        <form action="{{ route('documentosRecibidosCargarStore', $documento->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="card card-info card-outline">

                <div class="card-header">
                    <p class="mb-1"><strong>Folio:</strong> {{ $documento->folio }}</p>
                    <p class="mb-1"><strong>Emisor:</strong> {{ $documento->emisor }}</p>
                    <p class="mb-0"><strong>Asunto:</strong> {{ $documento->asunto }}</p>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <label for="documento">Selecciona documento en PDF</label>
                        <input type="file"
                               name="documento"
                               id="documento"
                               class="form-control-file"
                               accept="application/pdf"
                               required>

                        @error('documento')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-2">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-info">
                        <i class="fa fa-check-circle"></i> REGISTRAR DOCUMENTO
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- ======================= VISTA PREVIA ======================= --}}
    <div class="col-md-6">

        <div class="card card-secondary card-outline">

            <div class="card-header">
                <strong>Vista previa del documento</strong>
            </div>

            <div class="card-body p-0">

                @if ($documento->documento)
                    <iframe
                        src="{{ route('verDocumento', $documento->id) }}"
                        width="100%"
                        height="600"
                        style="border: none;">
                    </iframe>
                @else
                    <div class="p-4 text-center text-muted">
                        <i class="fa fa-file-pdf fa-3x mb-2"></i>
                        <p>No hay documento cargado.</p>
                    </div>
                @endif

            </div>

        </div>
    </div>

</div>

@stop

@section('footer')
    @include('partials.footer')
@stop

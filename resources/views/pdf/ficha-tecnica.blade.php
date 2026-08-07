<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ficha Técnica - SISDOC</title>

    <style>
        @page {
            margin: 25px 35px 40px 35px;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 9px;
            color: #000000;
            line-height: 1.4;
        }

        /* Encabezado */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            border-bottom: 2px solid #000000;
            padding-bottom: 8px;
        }

        .header-table td {
            border: none;
            padding: 0;
            vertical-align: middle;
        }

        .brand-title {
            font-size: 16px;
            font-weight: bold;
            color: #000000;
            margin: 0;
            letter-spacing: 1px;
        }

        .brand-subtitle {
            font-size: 9px;
            color: #333333;
            margin-top: 2px;
        }

        .doc-type {
            text-align: right;
            font-size: 12px;
            font-weight: bold;
            color: #000000;
            text-transform: uppercase;
        }

        /* Secciones y Subtítulos */
        .subtitulo {
            font-size: 10px;
            font-weight: bold;
            color: #ffffff;
            background-color: #333333;
            padding: 4px 8px;
            margin-top: 12px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Tablas */
        table.data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            table-layout: fixed;
        }

        table.data-table th {
            background-color: #f2f2f2;
            color: #000000;
            text-align: left;
            font-weight: bold;
            font-size: 8.5px;
            padding: 5px 6px;
            border: 1px solid #777777;
            text-transform: uppercase;
        }

        table.data-table td {
            padding: 5px 6px;
            border: 1px solid #777777;
            vertical-align: top;
            word-wrap: break-word;
        }

        /* Badges / Etiquetas de Estatus */
        .badge-bw {
            display: inline-block;
            padding: 2px 6px;
            font-size: 8px;
            font-weight: bold;
            color: #ffffff;
            background-color: #555555;
            text-align: center;
        }

        /* Helpers de Texto */
        .font-weight-bold { font-weight: bold; }
        .text-muted { color: #555555; }
        .text-center { text-align: center; }

        /* Pie de página */
        .footer {
            position: fixed;
            bottom: -20px;
            left: 0;
            right: 0;
            height: 20px;
            font-size: 8px;
            text-align: center;
            color: #555555;
            border-top: 1px solid #777777;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    <!-- ENCABEZADO INSTITUCIONAL -->
    <table class="header-table">
        <tr>
            <td style="width: 60%;">
                <div class="brand-title">SISDOC</div>
                <div class="brand-subtitle">Sistema de Documentación y Control | Servicios de Salud de Coahuila</div>
            </td>
            <td style="width: 40%;" class="doc-type">
                Ficha Técnica de Documento
            </td>
        </tr>
    </table>

    <!-- DATOS GENERALES -->
    <div class="subtitulo">Datos Generales</div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 18%;">FOLIO</th>
                <th style="width: 14%;">ESTATUS</th>
                <th style="width: 14%;">CONSECUTIVO</th>
                <th style="width: 18%;">FECHA DOC.</th>
                <th style="width: 18%;">FECHA RECEPCIÓN</th>
                <th style="width: 18%;">TIPO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="font-weight-bold">{{ $documentoRecibido->folio }}</td>
                <td>
                    <span class="badge-bw">{{ strtoupper($documentoRecibido->status ?? 'REGISTRADO') }}</span>
                </td>
                <td>{{ $documentoRecibido->consecutivo }}</td>
                <td>{{ $documentoRecibido->fecha_documento ? \Carbon\Carbon::parse($documentoRecibido->fecha_documento)->format('d/m/Y') : 'N/A' }}</td>
                <td>{{ $documentoRecibido->fecha_recepcion ? \Carbon\Carbon::parse($documentoRecibido->fecha_recepcion)->format('d/m/Y H:i') : 'N/A' }}</td>
                <td>{{ $documentoRecibido->tipo }}</td>
            </tr>
        </tbody>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 30%;">FECHA LÍMITE DE ATENCIÓN</th>
                <th style="width: 70%;">ANEXOS</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="font-weight-bold">
                    {{ $documentoRecibido->fecha_limite ? \Carbon\Carbon::parse($documentoRecibido->fecha_limite)->format('d/m/Y') : 'Sin fecha límite' }}
                </td>
                <td>
                    @if($documentoRecibido->anexo)
                        {{ $documentoRecibido->anexo }} {{ $documentoRecibido->anexo_descripcion ? ' - ' . $documentoRecibido->anexo_descripcion : '' }}
                    @else
                        <span class="text-muted">Sin anexos registrados</span>
                    @endif
                </td>
            </tr>
        </tbody>
    </table>

    <!-- EMISOR -->
    <div class="subtitulo">Información del Emisor</div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 50%;">INSTITUCIÓN / DEPENDENCIA EMISORA</th>
                <th style="width: 50%;">SERVIDOR PÚBLICO / ENCARGADO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="font-weight-bold">{{ $documentoRecibido->emisor }}</td>
                <td>{{ $documentoRecibido->emisor_encargado ?? 'No especificado' }}</td>
            </tr>
        </tbody>
    </table>

    <!-- ASUNTO -->
    <div class="subtitulo">Asunto del Documento</div>

    <table class="data-table">
        <tbody>
            <tr>
                <td style="padding: 8px;">
                    {{ $documentoRecibido->asunto }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- OBSERVACIONES GENERALES DE CAPTURA -->
    @if($documentoRecibido->contenido)
    <div class="subtitulo">Observaciones de Recepción</div>

    <table class="data-table">
        <tbody>
            <tr>
                <td style="padding: 8px;">
                    {!! $documentoRecibido->contenido !!}
                </td>
            </tr>
        </tbody>
    </table>
    @endif

    <!-- SEGUIMIENTO Y TURNADO -->
    <div class="subtitulo">Seguimiento y Atención</div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 70%;">ÁREA / DEPARTAMENTO TURNADO</th>
                <th style="width: 30%;">FECHA DE TURNADO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <strong>{{ $documentoRecibido->turnado_area_label ?? 'Sin turnar' }}</strong>
                    @if($documentoRecibido->turnado_area_encargado)
                        <br><span class="text-muted">Atención: {{ $documentoRecibido->turnado_area_encargado }}</span>
                    @endif
                </td>
                <td>{{ $documentoRecibido->turnado_area_fecha ? \Carbon\Carbon::parse($documentoRecibido->turnado_area_fecha)->format('d/m/Y H:i') : 'N/A' }}</td>
            </tr>
        </tbody>
    </table>

    @if($documentoRecibido->turnado_area_observaciones)
    <table class="data-table">
        <thead>
            <tr>
                <th>INSTRUCCIONES / OBSERVACIONES DE TURNADO</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! $documentoRecibido->turnado_area_observaciones !!}</td>
            </tr>
        </tbody>
    </table>
    @endif

    @if($documentoRecibido->turnado_area_respuesta)
    <table class="data-table">
        <thead>
            <tr>
                <th>RESPUESTA / ESTATUS DE ATENCIÓN</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{!! $documentoRecibido->turnado_area_respuesta !!}</td>
            </tr>
        </tbody>
    </table>
    @endif

    <!-- PIE DE PÁGINA -->
    <div class="footer">
        SISDOC — Documento impreso automáticamente el {{ now()->format('d/m/Y \a \l\a\s H:i') }} hrs.
    </div>

</body>
</html>
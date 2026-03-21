<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ficha Técnica</title>

    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #333;
            margin: 30px;
        }

        .titulo {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .subtitulo {
            font-size: 13px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 5px;
            border-bottom: 1px solid #999;
            padding-bottom: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
            padding: 6px;
            border: 1px solid #ccc;
        }

        td {
            padding: 6px;
            border: 1px solid #ccc;
        }

        .sin-borde td {
            border: none;
            padding: 3px 0;
        }

        .label {
            font-weight: bold;
            width: 30%;
        }

        .valor {
            width: 70%;
        }

        .footer {
            margin-top: 30px;
            font-size: 9px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

    <div class="titulo">S.I.S.D.O.C.</div>

    <!-- DATOS GENERALES -->
    <div class="subtitulo">DATOS GENERALES</div>

    <table>
        <tr>
            <th>FOLIO</th>
            <th>STATUS</th>
            <th>CONSECUTIVO</th>
            <th>FECHA DOCUMENTO</th>
            <th>FECHA RECEPCION</th>
            <th>TIPO</th>
        </tr>
        <tr>
            <td>{{ $documentoRecibido->folio }}</td>
            <td>{{ $documentoRecibido->status }}</td>
            <td>{{ $documentoRecibido->consecutivo }}</td>
            <td>{{ $documentoRecibido->fecha_documento ? \Carbon\Carbon::parse($documentoRecibido->fecha_documento)->format('d-m-Y') : 'N/A' }}</td>
            <td>{{ $documentoRecibido->fecha_recepcion ? \Carbon\Carbon::parse($documentoRecibido->fecha_recepcion)->format('d-m-Y H:i') : 'N/A' }}</td>
            <td>{{ $documentoRecibido->tipo }}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>FECHA LIMITE</th>
            <th>ANEXOS</th>
        </tr>
        <tr>
            <td>{{ $documentoRecibido->fecha_limite }}</td>
            <td>{{ $documentoRecibido->anexo }} - {{ $documentoRecibido->anexo_descripcion }}</td>
        </tr>
    </table>

    <!-- EMISOR -->
    <div class="subtitulo">EMISOR</div>

    <table>
        <tr>
            <td>{{ $documentoRecibido->emisor }} - {{ $documentoRecibido->emisor_encargado }}</td>
        </tr>
    </table>

    <!-- SEGUIMIENTO -->
    <div class="subtitulo">SEGUIMIENTO</div>

    <table>
        <tr>
            <th>TURNADO A</th>
            <th>FECHA</th>
        </tr>
        <tr>
            <td>{{ $documentoRecibido->turnado_area_label }} <strong>{{ $documentoRecibido->turnado_area_encargado }}</strong></td>
            <td>{{ $documentoRecibido->turnado_area_fecha }}</td>
            
        </tr>
    </table>

    <table>
        <tr>
            <th>OBSERVACIONES</th>
        </tr>
        <tr>
            <td>{!! $documentoRecibido->turnado_area_observaciones !!}</td>
        </tr>
    </table>

    <table>
        <tr>
            <th>RESPUESTA</th>
        </tr>
        <tr>
            <td>{!! $documentoRecibido->turnado_area_respuesta !!}</td>
        </tr>
    </table>

    <div class="subtitulo">ASUNTO</div>

    <table>
        <tr>
            <td>{{ $documentoRecibido->asunto }}</td>
        </tr>
    </table>

    

    <!-- CONTENIDO -->
    <div class="subtitulo">OBSERVACIONES</div>

    <table>
        <tr>
            <td>{!! $documentoRecibido->contenido !!}</td>
        </tr>
    </table>

    
    <!-- FOOTER -->
    <div class="footer">
        Documento generado automáticamente - {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
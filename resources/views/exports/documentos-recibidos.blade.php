<table>
    <thead>
        <tr>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">CONSECUTIVO</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">FOLIO</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">AÑO</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">STATUS</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">FECHA DEL DOCUMENTO</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">FECHA DE RECEPCIÓN</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">FECHA LÍMITE</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">ASUNTO</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">TURNADO A</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">RESPONSABLE</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">FECHA DE TURNADO</th>
            <th style="background-color: #6f42c1; color: #ffffff; font-weight: bold; text-align: center; vertical-align: middle;">OBSERVACIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documentos as $doc)
            <tr>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->consecutivo }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->folio }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->anio }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->status }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->fecha_documento }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->fecha_recepcion }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->fecha_limite }}</td>
                <td style="vertical-align: middle;">{{ $doc->asunto }}</td>
                <td style="vertical-align: middle;">{{ $doc->turnado_area_label }}</td>
                <td style="vertical-align: middle;">{{ $doc->turnado_area_encargado }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->turnado_area_fecha }}</td>
                <td style="vertical-align: middle;">{{ strip_tags($doc->turnado_area_observaciones) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
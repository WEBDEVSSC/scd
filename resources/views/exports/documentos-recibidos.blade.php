<table>
    <thead>
        <tr>
            <th>CONSECUTIVO</th>
            <th>FOLIO</th>
            <th>AÑO</th>
            <th>STATUS</th>
            <th>FECHA DEL DOCUMENTO</th>
            <th>FECHA DE RECEPCIÓN</th>
            <th>FECHA LÍMITE</th>
            <th>ASUNTO</th>
            <th>TURNADO A</th>
            <th>RESPONSABLE</th>
            <th>FECHA DE TURNADO</th>
            <th>OBSERVACIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($documentos as $doc)
            <tr>
                <td>{{ $doc->consecutivo }}</td>
                <td>{{ $doc->folio }}</td>
                <td>{{ $doc->anio }}</td>
                <td>{{ $doc->status }}</td>
                <td>{{ $doc->fecha_documento }}</td>
                <td>{{ $doc->fecha_recepcion }}</td>
                <td>{{ $doc->fecha_limite }}</td>
                <td>{{ $doc->asunto }}</td>
                <td>{{ $doc->turnado_area_label }}</td>
                <td>{{ $doc->turnado_area_encargado }}</td>
                <td>{{ $doc->turnado_area_fecha }}</td>
                <td>{{ strip_tags($doc->turnado_area_observaciones) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

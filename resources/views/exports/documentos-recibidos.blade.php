
<table>
    <thead>
        {{-- Encabezado Institucional --}}
        <tr>
            <th colspan="12" style="background-color: #4a154b; color: #ffffff; font-size: 16px; font-weight: bold; text-align: center; vertical-align: middle; padding: 12px;">
                SECRETARÍA DE SALUD DE COAHUILA
            </th>
        </tr>
        <tr>
            <th colspan="12" style="background-color: #5c2c5c; color: #ffffff; font-size: 13px; font-weight: bold; text-align: center; vertical-align: middle; padding: 8px;">
                SUBDIRECCIÓN: {{ $user->id_area_label ?? '' }}
            </th>
        </tr>
        <tr>
            <th colspan="12" style="background-color: #f8f9fa; color: #495057; font-size: 11px; text-align: right; vertical-align: middle; padding: 6px; border-bottom: 2px solid #6f42c1;">
                <strong>FECHA DE CREACIÓN:</strong> {{ now()->format('d/m/Y H:i') }}
            </th>
        </tr>
        <tr>
            <th colspan="12" style="height: 10px; background-color: #ffffff;"></th>
        </tr>

        {{-- Encabezado de Columnas --}}
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
                <td style="text-align: center; vertical-align: middle;">{{ $doc->fecha_documento->format('d-m-Y') }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->fecha_recepcion->format('d-m-Y H:i') }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->fecha_limite?->format('d-m-Y') }}</td>
                <td style="vertical-align: middle;">{{ $doc->asunto }}</td>
                <td style="vertical-align: middle;">{{ $doc->turnado_area_label }}</td>
                <td style="vertical-align: middle;">{{ $doc->turnado_area_encargado }}</td>
                <td style="text-align: center; vertical-align: middle;">{{ $doc->turnado_area_fecha?->format('d-m-Y') }}</td>
                <td style="vertical-align: middle;">{{ strip_tags($doc->turnado_area_observaciones) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
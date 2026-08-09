<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoRecibido extends Model
{
    //
    protected $table = 'documentos_recibidos';

    protected $fillable = [
        'folio',
        'anio',
        'status',
        'consecutivo',
        'fecha_documento',
        'fecha_recepcion',
        'fecha_limite',
        'turnado_area_id',
        'turnado_area_label',
        'turnado_area_fecha',
        'turnado_area_encargado',
        'turnado_area_observaciones',
        'turnado_area_respuesta',
        'turnado_area_respuesta_fecha',
        'turnado_area_respuesta_documento',
        'emisor_id',
        'emisor',
        'emisor_encargado',
        'tipo',
        'asunto',
        'anexo',
        'anexo_descripcion',
        'contenido',
        'documento',
        'subdireccion_id',
        'subdireccion',
        'titular_id',
        'titular',
    ];

    protected $casts = [
        'fecha_documento' => 'date',
        'fecha_recepcion' => 'datetime',
        'fecha_limite' => 'date',
        'turnado_area_fecha' => 'date',
        'turnado_area_respuesta_fecha' => 'date',
    ];
}

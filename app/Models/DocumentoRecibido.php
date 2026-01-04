<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentoRecibido extends Model
{
    //
    protected $table = 'documentos_recibidos';

    protected $fillable = [
        'folio',
        'consecutivo',
        'anio',
        'status',
        'fecha_documento',
        'fecha_recepcion',
        'emisor_id',
        'emisor',
        'tipo',
        'asunto',
        'anexo',
        'anexo_descripcion',
        'contenido',
        'subdireccion_id',
        'subdireccion',
    ];
}

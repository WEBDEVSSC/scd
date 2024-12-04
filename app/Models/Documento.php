<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

     // Si la tabla se llama 'documento' en lugar de 'documentos', especifica el nombre de la tabla
     protected $table = 'documento';
}

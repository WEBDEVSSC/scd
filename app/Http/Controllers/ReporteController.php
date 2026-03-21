<?php

namespace App\Http\Controllers;

use App\Models\DocumentoRecibido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    //
    public function fichaTecnicaPDF($id)
    {
        $documentoRecibido = DocumentoRecibido::findOrFail($id);

        $pdf = Pdf::loadView('pdf.ficha-tecnica', compact('documentoRecibido'));

        return $pdf->stream('ficha-tecnica-'.$id.'.pdf');
    }
}

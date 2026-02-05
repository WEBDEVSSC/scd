<?php

namespace App\Exports;

use App\Models\DocumentoRecibido;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class DocumentosRecibidosExport implements FromView
{
    public function view(): View
    {
        $user = Auth::user();

        if ($user->role == 'subdirector') {
            $documentos = DocumentoRecibido::where('subdireccion_id', $user->id_area)
                ->select(
                    'consecutivo',
                    'folio',
                    'anio',
                    'status',
                    'fecha_documento',
                    'fecha_recepcion',
                    'fecha_limite',
                    'turnado_area_label',
                    'turnado_area_encargado',
                    'turnado_area_fecha',
                    'turnado_area_observaciones'
                )
                ->get();
        } else {
            $documentos = DocumentoRecibido::all();
        }

        return view('exports.documentos-recibidos', compact('documentos'));
    }
}
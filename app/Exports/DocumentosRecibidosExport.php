<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DocumentosRecibidosExport implements FromView
{
    protected $documentos;
    protected $user;

    public function __construct($documentos, $user)
    {
        $this->documentos = $documentos;
        $this->user = $user;
    }

    public function view(): View
    {
        return view('exports.documentos-recibidos', [
            'documentos' => $this->documentos,
            'user' => $this->user,
        ]);
    }
}
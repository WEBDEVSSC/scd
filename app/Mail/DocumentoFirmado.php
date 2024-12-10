<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentoFirmado extends Mailable
{
    use Queueable, SerializesModels;

    public $documento;
    
    public function __construct($documento)
    {
        $this->documento = $documento;
    }

    
    public function build()
    {
        return $this->markdown('emails.documento-firmado') 
                    ->subject('Documento firmado')
                    ->from('soportewebssc@gmail.com', 'S.I.S.D.O.C.'); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\DocumentoFirmado;
use App\Mail\DocumentoParaFirma;
use App\Models\Area;
use App\Models\Documento;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class DocumentoController extends Controller
{
    
    public function generarQr()
    {
        
    }
    
    /**
     * 
     * 
     * METODO PARA MOSTRAR EL INDEX DE LOS DOCUMENTOS POR EL NIVEL DE USUARIO
     * 
     * 
     */
    public function index()
    {
        // Consultamos el nivel del usuario autenticado
        $user = Auth::user();

        // Nivel del usuario
        $userNivel = $user->nivel;

        // ID del area del usuario
        $userIdArea = $user->id_area;

        // ID del usuario para tomar el origen
        $userOrigen = $user ->id;

        // Generamos la consulta dependiendo del nivel del usuario

        // Nivel 1 - DESPACHO
        if($userNivel == 1)
        {
            $documentos = Documento::all();
        }

        // Nivel 2 - SUBSECRETARIA
        elseif($userNivel == 2)
        {
            $documentos = Documento::where('origen_subsecretaria',$userIdArea)
                ->orderBy('created_at','desc')
                ->get();
        }

        // Nivel 3 - SUBDIRECTORES
        elseif($userNivel == 3)
        {
            $documentos = Documento::where('area',$userIdArea)
                ->orderBy('created_at','desc')
                ->get();
        }

        // Nivel 4 - Jefatura de departamento
        elseif($userNivel == 4)
        {
            $documentos = Documento::where('firma',$userIdArea)
                ->orderBy('created_at','desc')
                ->get();
        }

        // Nivel 5 - ÁREA - PROGRÁMA

        elseif($userNivel == 5)
        {
            $documentos = Documento::where('origen',$userOrigen)
                ->orderBy('created_at','desc')
                ->get();
        }

        // Nivel 6 - Titular de Unidad
        elseif($userNivel == 6)
        {   
            $documentos = Documento::where('para',$userOrigen)
                ->orderBy('created_at','desc')
                ->get();
        }


        /*$documentos = Documento::where('area',$userIdArea)
                ->orderBy('created_at','desc')
                ->get();*/
        

        // Redireccionamos con el array de documentos

        return view('documento.indexDocumento',[
            'documentos'=>$documentos,
        ]);
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR EL FORMULARIO DE REGISTRO DE NUEVO DOCUMENTO, LAS FIRMAS SE MUESTRAN POR NIVEL DE USUARIO
     * 
     * 
     */
    public function create()
    {
        // Seleccionamos las areas para mostrar EN EL SELECT
        $areas = Area::all();    

        // Consultamos el usuario que esta logeado
        $user = Auth::user();

        // Consultamos el ID al area que pertenece el usuario
        $userIdArea = $user->id_area;

        // Con el ID del area consultamos los campos del Area en la tabla Areas
        $areaCampos = Area::where('id', $userIdArea)->first();

        // Sacamos el tipo de area
        $areaTipo = $areaCampos->tipo;

        // Connsultamos la lista de firmas segun el nivel del usuario

        // Operativo == Solo le firma su jefe directo
        if($user->nivel == 5)
        {
            // Consultamos jefatura
            $jefatura = Area::where('id',$userIdArea)->first();
            
            $listaFirmas = Area::where('id',$jefatura->jefatura)->get();
        }

        // Jefe de Departamento == Solo le firma su Subdirector o Jefaturas hermanas
        elseif($user->nivel == 4)
        {
            $subdireccion = Area::where('id',$userIdArea)->first();

            $listaFirmas = Area::where('subdireccion',$subdireccion->subdireccion)->get();

        }

        // Titular de Unidad
        elseif($user->nivel == 6)
        {
            $titular = Area::where('id',$userIdArea)->first(); 

            $listaFirmas = Area::where('despacho',$titular->despacho)->get();
        }

        //

        // Consulta para Subsecretarias

        /*

        if($areaTipo == 1)
        {
            $idUnidad = $areaCampos ->subsecretaria;

            $listaFirmas = Area::where('id', $userIdArea)
                               ->orWhere('id',$idUnidad)
                               ->get();  
        }
        

        // Consulta para Subdirecciones
        elseif($areaTipo == 2)
        {
            $idDespacho = $areaCampos->despacho;

            $listaFirmas = Area::where('id', $userIdArea)
                               ->orWhere('id',$idDespacho)
                               ->get();    
        }

        // Consulta para Subdirecciones
        elseif($areaTipo == 3)
        {
            $idUnidad = $areaCampos ->subsecretaria;

            $listaFirmas = Area::where('id', $userIdArea)
                               ->orWhere('id',$idUnidad)
                               ->get();    
        }

        // Jefafura de Departamento (Firma el mismo y el subdirector)
        elseif($areaTipo == 4)
        {
            $idUnidad = $areaCampos ->unidad;
            $idSubsecretaria = $areaCampos ->subsecretaria;

            $listaFirmas = Area::where('id', $userIdArea)
                               ->orWhere('id',$idSubsecretaria)
                               ->get();   
        }

        // Area o Programa (Firma jefe inmediato o Subdirector)
        elseif($areaTipo == 5)
        {
            $idUnidad = $areaCampos ->unidad;
            $idJefatura = $areaCampos ->jefatura;

            $listaFirmas = Area::where('id', $idJefatura)
                               ->orWhere('id',$idUnidad)
                               ->get();   
        }
        
        // LISTA DE FIRMAS PARA UNIDAD
        elseif($areaTipo == 6)
        {
            $idDespacho = $areaCampos->despacho;
            $idUnidad = $areaCampos->id;

            $listaFirmas = Area::where('id',$idDespacho)
                                ->orWhere('id',$idUnidad)
                                ->get();
        }*/

        //Seleccionamos las firmas
        return view('documento.createDocumento',[
            'areas'=>$areas,
            'listaFirmas'=>$listaFirmas
        ]);
    }

    /**
     * 
     * 
     * METODO PARA GUARDAR LOS DATOS REGISTRADOS EN LA BASE DE DATOS
     * 
     * 
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'para' => 'required', 
            'tipo' => 'required', 
            'asunto' => 'required|string',
            'anexo' => 'required|string',
            'anexo_descripcion' => 'required_if:anexo,SI', 
            'contenido' => 'required|string',
            'firma' => 'required', 
        ], [
            'para.required' => 'El campo es obligatorio.', 
            'tipo.required' => 'El campo es obligatorio.', 
            'asunto.required' => 'El campo es obligatorio.', 
            'contenido.required' => 'El campo es obligatorio.', 
            'firma.required' => 'El campo es obligatorio.', 
            'anexo.required' => 'El campo es obligatorio',
            'anexo_descripcion.required_if' => 'El campo es obligatorio',
        ]);

        // Consultamos los datos del usuario logeado
        $user = Auth::user();

        // Campo origen de quien capturo
        $origen = $user->id;

        // Campo para el id del area
        $idArea = $user->id_area;

        // Campo para sacar el responsable del area
        $responsableArea = Area::where('id',$idArea)->first();

        // Campo para el label del id area
        $idAreaLabel = $user->id_area_label;

        // Consultamos el label de la firma
        $datosFirma = Area::where('id',$request->firma)->first();
        $nombreFirma = $datosFirma->responsable;
        $siglasFirma = $datosFirma->siglas;
        $areaFirma = $datosFirma->nombre;
        $correoFirma = $datosFirma->correo;
        $firmaFirma = $datosFirma->firma;

        // Consultamos el para label
        $paraLabel = Area::where('id',$request->para)->first();

        // Consultamos la subsecretaria de origen
        $subsecretaria = Area::where('id',$idArea)->first();
        $subsecretariaOrigen = $subsecretaria->subsecretaria;
        
        // Consultamos los datos de la subsecretaria
        $subsecretariaLabel = Area::where('id',$subsecretariaOrigen)->first();  
        $subSecretariaLabelFinal = $subsecretariaLabel->nombre;

        // Filtramos por el tipo de documento

        if ($request->tipo == "MEM") 
        {
            $ultimoArea = Documento::where('siglas',$siglasFirma)
                                   ->where('tipo','MEM')
                                   ->orderBy('created_at','desc')
                                   ->first();

            $ultimoNumero = $ultimoArea ? $ultimoArea->consecutivo : 0; // Asigna 0 si no hay último documento

            $consecutivo = $ultimoNumero + 1; // Incrementa el consecutivo
        } 
        elseif ($request->tipo == "OF") 
        {
            $ultimoArea = Documento::where('siglas',$siglasFirma)
                                   ->where('tipo','OF')
                                   ->orderBy('created_at','desc')
                                   ->first();

            $ultimoNumero = $ultimoArea ? $ultimoArea->consecutivo : 0; // Asigna 0 si no hay último documento

            $consecutivo = $ultimoNumero + 1; // Incrementa el consecutivo
        } 
        elseif ($request->tipo == "TI") 
        {
            $ultimoArea = Documento::where('siglas',$siglasFirma)
                                   ->where('tipo','TI')
                                   ->orderBy('created_at','desc')
                                   ->first();

            $ultimoNumero = $ultimoArea ? $ultimoArea->consecutivo : 0; // Asigna 0 si no hay último documento

            $consecutivo = $ultimoNumero + 1; // Incrementa el consecutivo
        }
        else 
        {
            $ultimo = 1; // Valor por defecto si no coincide con ningún tipo
        }

        // Generamos el nuevo objeto para guardar los datos
        $documento = new Documento();

        $documento->para = $request->para;
        $documento->para_label = $paraLabel->responsable;
        $documento->para_area = $paraLabel->nombre;
        $documento->tipo = $request->tipo;
        $documento->consecutivo = $consecutivo;
        $documento->asunto = $request->asunto;
        $documento->anexo = $request->anexo;
        $documento->anexo_descripcion = $request->anexo_descripcion;
        $documento->contenido = $request->contenido;
        $documento->origen = $origen;
        $documento->origen_subsecretaria = $subsecretariaOrigen;
        $documento->origen_subsecretaria_label = $subSecretariaLabelFinal;
        $documento->area = $idArea;
        $documento->area_responsable = $responsableArea->responsable;
        $documento->area_label = $idAreaLabel;
        $documento->firma = $request->firma;
        $documento->firma_label = $nombreFirma;
        $documento->firma_area = $areaFirma;
        $documento->firma_ruta = $firmaFirma;
        $documento->siglas = $siglasFirma;
        $documento->status = 1;
        $documento->status_label = "NUEVO";
        $documento->status_firma = 0;
        //$documento->qr = 'storage/qrcodes/' . $qrCodeFileName;

        $documento->save();

        // Enviamos el correo de alerta sobre el nuevo evento
        Mail::to($correoFirma)->send(new DocumentoParaFirma($documento));

        return redirect()->route('indexDocumento')->with('success', 'Folio asignado : ' . $documento->siglas . '/' . $documento->tipo . '/' . $documento->consecutivo . '/' . $documento->created_at->format('Y'));
        
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DETALLES DEL REGISTRO DEL DOCUMENTO
     * 
     * 
     */
    public function show($id)
    {
        // Buscamos el registro con el ID
        $documento = Documento::find($id);

        // Cargamos los datos del usuario que esta en sesion
        $user = Auth::user();

        // Cargamos los datos del usuario que capturo
        $capturo = User::where('id', $documento->origen)->first();

        // Mandamos los datos a la vista
        return view('documento.showDocumento',[
            'documento'=>$documento,
            'user'=>$user,
            'capturo'=>$capturo
        ]);
    }

    /**
     * 
     * 
     * METODO PARA GENERAR EL PDF
     * 
     * 
     *//*
    public function pdf($id)
    {
        // Realizamos la consulta a la tabla Documento
        $documento = Documento::find($id);

        // Consultamos la firma del usuario asignado
        $usuario = User::find($documento->firma);

        // Generamos el documento
        $pdf = PDF::loadView('documento.pdf', compact('documento','usuario'));

        // Retornamos la vista con los elementos
        return $pdf->stream('documento_' . $documento->id . '.pdf');
    }*/

    public function pdf($id)
{
    // Realizamos la consulta a la tabla Documento
    $documento = Documento::find($id);

    // Verificamos si el documento existe
    if (!$documento) {
        return response()->json(['error' => 'Documento no encontrado'], 404);
    }

    // Verificamos si el campo 'firma' tiene un valor válido
    if (!$documento->firma_ruta) {
        return response()->json(['error' => 'No se encuentra un usuario asignado para la firma'], 404);
    }

    // Consultamos la firma del usuario asignado
    $usuario = Area::find($documento->firma);

    // Verificamos si se encontró el usuario
    if (!$usuario) {
        return response()->json(['error' => 'Usuario de la firma no encontrado'], 404);
    }

    // Generamos el documento PDF
    $pdf = PDF::loadView('documento.pdf', compact('documento', 'usuario'));

    // Retornamos la vista con los elementos
    return $pdf->stream('documento_' . $documento->id . '.pdf');
}

    
    /**
     * 
     * 
     * METODO PARA FIRMAR EL DOCUMENTO
     * 
     * 
     */
    public function firmar(Request $request, $id)
    {
        // Buscamos en la tabla de documento con el id
        $documento = Documento::findOrFail($id);

        // Actualizamos el campo de status
        $documento->status = '2';
        $documento->status_label = 'FIRMADO';
        $documento->status_firma = 1;

        // Consultamos el correo del remitente
        $remitente = User::find($documento->origen);

        // Enviamos el correo al remitente
         Mail::to($remitente->email)->send(new DocumentoFirmado($documento));

        // Guardamos el registro
        $documento->save();

        // Regresamos al panel
        return redirect()->route('indexDocumento', ['id' => $documento->id])
            ->with('success', 'El documento ha sido firmado correctamente.');    
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DOCUMENTOS PENDIENTES PARA FIRMAR
     * 
     * 
     */
    public function pendientesFirmar()
    {
        // Capturamos los datos del usuario que inicio sesion
        $user = Auth::user();

        // Consultamos los documentos asociados con el usuario que inicio sesion
        $documentos = Documento::where('firma',$user->id_area)
                    ->where('status_firma',0)
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Retornamos la vista con todos los valores
        return view('documento.pendientesFirmarDocumento', compact('documentos'));

    }
 
    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DOCUMENTOS QUE EL USUARIO LOGEADO REDACTO
     * 
     * 
     */
    public function misDocumentos()
    {
        // Capturamos los datos del usuario que inicio sesion
        $user = Auth::user();

        // Consultamos los documentos del usuario que conicidan el ID con el campo ORIGEN
        $documentos = Documento::where('origen',$user->id)
                    ->orderBy('created_at', 'desc')     
                    ->get();

        // Retornamos la vista con el objeto documentos
        return view('documento.misDocumentos', compact('documentos'));
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DOCUMENTOS TURNADOS (YA FIRMADOS)
     * 
     * 
     */
    public function documentosRecibidos()
    {
        // Capturamos los datos del usuario que inicio sesion
        $user = Auth::user();

        // Consultamos los documentos asignados para el usuario ya firmados
        $documentos = Documento::where('para',$user->id)
                    ->where('status',2)
                    ->orderBy('created_at', 'desc')
                    ->get();

        // Retornamos la vista con el objeto documentos
        return view('documento.documentosRecibidos', compact('documentos'));
    }
}

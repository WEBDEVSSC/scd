<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Documento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
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

        // Nivel 2 - SUBSECRETARIA / UNIDAD
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
        // Seleccionamos las areas para mostrar
        $areas = Area::all();    

        // Consultamos el usuario que esta logeado
        $user = Auth::user();

        // Consultamos el ID al area que pertenece el usuario
        $userIdArea = $user->id_area;

        // Con el ID del area consultamos los campos del Area en la tabla Areas
        $areaCampos = Area::where('id', $userIdArea)->first();

        // Sacamos el tipo de area
        $areaTipo = $areaCampos->tipo;

        // Consulta para Subsecretarias / Unidades

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
        $documento->siglas = $siglasFirma;
        $documento->status = 1;
        $documento->status_label = "NUEVO";

        $documento->save();

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

    
}

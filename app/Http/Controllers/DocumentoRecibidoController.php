<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DocumentoRecibido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentoRecibidoController extends Controller
{
    //
    public function documentosRecibidosShow($id)
    {
        // Cargamos el documento
        $documento = DocumentoRecibido::findOrFail($id);

        // Regresamos la vista con el arreglo
        return view('documento-recibido.documentosRecibidosShow', compact('documento'));
    }

    public function documentosRecibidos()
    {
        // Capturamos los datos del usuario que inicio sesion
        $user = Auth::user();

       // Filtramos el index por nivel
       if($user->nivel == 3)
       {
            $documentos = DocumentoRecibido::where('subdireccion_id', $user->id_area)
                ->orderBy('id','DESC')
                ->get();
       }

        // Retornamos la vista con el objeto documentos
        return view('documento-recibido.documentosRecibidos', compact('documentos','user'));
    }

    public function documentosRecibidosCreate()
    {
         // Seleccionamos las areas para mostrar EN EL SELECT
        $areas = Area::all();    

        return view('documento-recibido.documentosRecibidosCreate', compact('areas'));
    }

    public function documentosRecibidosStore(Request $request)
    {        

        $request->validate([
            'emisor' => 'required',
            'tipo' => 'required',
            'folio' => 'required',
            'fecha_documento' => 'required|date',

            'fecha_recepcion' => 'required|date|after_or_equal:fecha_documento',
            'fecha_limite' => 'required|date|after_or_equal:fecha_documento',
            'asunto' => 'required',
            
            'anexo' => 'required|in:SI,NO',
            'anexo_descripcion' => 'required_if:anexo,SI',
            'contenido' => 'required',
            
            
        ],[
            'emisor.required' => 'El campo emisor es obligatorio.',

            'tipo.required' => 'Debe seleccionar un tipo de documento.',

            'asunto.required' => 'El asunto del documento es obligatorio.',

            'anexo.required' => 'Debe indicar si el documento contiene anexo.',
            'anexo.in'       => 'El valor del campo anexo no es válido.',

            'anexo_descripcion.required_if' => 'Debe especificar la descripción del anexo cuando selecciona que el documento contiene anexo.',

            'fecha_documento.required' => 'La fecha del documento es obligatoria',
            'fecha_documento.date' => 'La fecha del documento no es válida',

            'fecha_recepcion.required' => 'La fecha y hora de recepción es obligatoria',
            'fecha_recepcion.date' => 'La fecha y hora de recepción no es válida',
            'fecha_recepcion.after_or_equal' => 'La fecha de recepción no puede ser menor a la fecha del documento',
        ]);

        // Consultamos los valores con sus id
        $emisor = Area::findOrFail($request->emisor);

        // Consultamos el id del usuario
        $user = Auth::user();

        // Asignamos el anio
        $anio = Carbon::now()->year;

        if($user->nivel == 3)
        {
            // Comsultamos la subdireccion
            $subdireccion = $user->id_area;

            $subdireccionLabel = Area::findOrFail($subdireccion);
        }

        $documentoRecibido = new DocumentoRecibido();

        $documentoRecibido->folio = $request->folio;
        $documentoRecibido->anio = $anio;
        $documentoRecibido->status = "NUEVO";
        $documentoRecibido->fecha_documento = $request->fecha_documento;
        $documentoRecibido->fecha_recepcion = $request->fecha_recepcion;
        $documentoRecibido->fecha_limite = $request->fecha_limite;
        $documentoRecibido->emisor_id = $request->emisor;
        $documentoRecibido->emisor = $emisor->nombre;
        $documentoRecibido->tipo = $request->tipo;
        $documentoRecibido->asunto = $request->asunto;
        $documentoRecibido->anexo = $request->anexo;
        $documentoRecibido->anexo_descripcion = $request->anexo_descripcion;
        $documentoRecibido->contenido = $request->contenido;
        $documentoRecibido->subdireccion_id = $subdireccion;
        $documentoRecibido->subdireccion = $subdireccionLabel->nombre;

        $documentoRecibido->save();

        // Regresamos al panel
        return redirect()->route('documentosRecibidos')->with('success', 'El documento se registro correctamente.');    
        

    }

    public function documentosRecibidosTurnar($id)
    {
        // Consultamos el documento
        $documento = DocumentoRecibido::findOrFail($id);
        
        // Consultamos el id del usuario
        $user = Auth::user();

        if($user->nivel == 3)
        {            
            $listaDepartamentos = Area::where('subdireccion',$user->id_area)->get();
        }

        return view('documento-recibido.documentosRecibidosTurnar', compact('listaDepartamentos','documento'));
    }

    public function documentosRecibidosTurnarStore(Request $request, $id)
    {
        // Validamos los datos
        $request->validate([
            'departamento_id' => 'required',
            'contenido' => 'required',
        ],[

        ]);

        // Consultamos el departamento
        $departamento = Area::findOrFail($request->departamento_id);

        // Cargamos la fecha del sistema
        $fecha_turnado = Carbon::now();
        
        // Consultamos el documento
        $documento = DocumentoRecibido::findOrFail($id);

        if (empty($documento->turnado_area_id)) 
        {
            $documento->status = "TURNADO A AREA";   

            $documento->turnado_area_id = $departamento->id;    
            $documento->turnado_area_label = $departamento->nombre; 
            
            $documento->turnado_area_fecha = $fecha_turnado;
            $documento->turnado_area_encargado = $departamento->responsable;
            $documento->turnado_area_observaciones = $request->contenido;

            $documento->save();
                
        }
        else
        {
            $nuevoDocumento = $documento->replicate();

            $nuevoDocumento->status = "TURNADO A AREA";   
            
            $nuevoDocumento->turnado_area_id = $departamento->id;    
            $nuevoDocumento->turnado_area_label = $departamento->nombre; 
            $nuevoDocumento->turnado_area_fecha = $fecha_turnado; 
            $nuevoDocumento->turnado_area_encargado = $departamento->responsable;
            $nuevoDocumento->turnado_area_observaciones = $request->contenido;

            $nuevoDocumento->save();
        }

        
        return redirect()->route('documentosRecibidos')->with('success', 'El documento se turno correctamente al area');    
    }

    public function documentosRecibidosCargar($id)
    {
        // Cargamos los datos del documento
        $documento = DocumentoRecibido::findOrFail($id);
        
        return view('documento-recibido.documentosRecibidosCargar', compact('documento'));
    }

    public function documentosRecibidosCargarStore(Request $request, $id)
    {
        $request->validate([
            'documento' => 'required|file|mimes:pdf|max:10240'
        ], [
            'documento.required' => 'Debe adjuntar un documento.',
            'documento.mimes'    => 'El documento debe ser un archivo PDF.',
            'documento.max'      => 'El documento no debe exceder los 10 MB.'
        ]);

        // Buscamos el registro a editar
        $documento = DocumentoRecibido::findOrFail($id);

        // Fecha y hora actual
        $fechaHora = Carbon::now()->format('Y-m-d_H-i-s');


        // 📤 Guardar archivo en PRIVATE
        if ($request->hasFile('documento')) {

            $archivo = $request->file('documento');

            // Nombre seguro
            $nombreArchivo = $fechaHora . '.' . $archivo->getClientOriginalExtension();

            // Ruta privada
            $ruta = $archivo->storeAs('documentos',$nombreArchivo);

            // Guardar ruta en BD
            $documento->documento = $nombreArchivo;
            $documento->save();
        }

        return redirect()->route('documentosRecibidos')->with('success', 'El documento se subio correctamente.');    
    }

    public function verDocumento($id)
    {
        $documento = DocumentoRecibido::findOrFail($id);

        $ruta = 'documentos/' . $documento->documento;

        /*dd([
            'ruta' => $ruta,
            'existe' => Storage::disk('private')->exists($ruta),
            'ruta_fisica' => storage_path('app/private/' . $ruta),
        ]);*/

        // Verifica que exista
        if (!Storage::disk('private')->exists($ruta)) {
            abort(404, 'Documento no encontrado');
        }

        // Mostrar PDF en el navegador
        return response()->file(
            storage_path('app/private/documentos/' . $documento->documento),
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . $documento->documento . '"'
            ]
        );
    }
}

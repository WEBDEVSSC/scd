<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreasNivel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        return view('area.indexArea', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hacemos la lista de los niveles de areas
        $niveles = AreasNivel::all();

        // Mandamos la vista con las variables
        return view('area.createArea',compact('niveles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del request
        $validateData = $request->validate([
            'nombre' => 'required|string',
            'responsable' => 'required|string',
            'siglas' => 'required|string',
            'correo' => 'required|email|unique:areas,correo', // Validación del correo
            'extension' => 'required|string',
            'tipo' => 'required|integer',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'responsable.required' => 'El campo responsable es obligatorio',
            'siglas.required' => 'El campo siglas es obligatorio',
            'correo.required' => 'El campo correo es obligatorio', // Corregido: 'email' a 'correo'
            'correo.email' => 'El formato del correo electrónico es inválido', // Mensaje adicional
            'correo.unique' => 'El correo electrónico ya está registrado en otra área', // Mensaje adicional
            'extension.required' => 'El campo extensión es obligatorio',
            'tipo.required' => 'El campo tipo es obligatorio',
        ]);

        // Crear una nueva instancia del modelo Area
        $area = new Area();

        // Asignar los valores a los atributos del modelo
        $area->nombre = $request->nombre;
        $area->responsable = $request->responsable;
        $area->siglas = $request->siglas;
        $area->correo = $request->correo; // Cambiado a $request->correo
        $area->extension = $request->extension;
        $area->tipo = $request->tipo;

        // Guardar el modelo en la base de datos
        $area->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('indexArea')->with('success', 'Los datos se registrarón correctamente');
    }


    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DATOS DEL AREA
     * 
     * 
     */
    public function show($id)
    {
        // Buscamos el registro en la Base de Datos
        $area = Area::findOrFail($id);

        // Retornamos la vista con el objeto
        return view('area.showArea',['area'=>$area]);
    }

    /**
     * 
     * 
     * METODO PARA EDITAR LOS DATOS DEL AREA
     * 
     * 
     */

     public function edit($id)
     {
        // Buscamos el registro con el ID 
        $area = Area::findOrFail($id);

        // Hacemos la lista de los niveles de areas
        $niveles = AreasNivel::all();

        // Mandamos la vista con las variables
        return view('area.editArea',compact('area','niveles'));
     }

     /**
     * 
     * 
     * METODO PARA EDITAR LOS DATOS DEL AREA
     * 
     * 
     */

     public function update(Request $request,$id)
     {
        // Validar los datos del request
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'responsable' => 'required|string',
            'siglas' => 'required|string',
            'correo' => ['required','email',Rule::unique('areas', 'correo')->ignore($id),],
            'extension' => 'required|string',
            'tipo' => 'required|integer',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'responsable.required' => 'El campo responsable es obligatorio',
            'siglas.required' => 'El campo siglas es obligatorio',
            'correo.required' => 'El campo correo es obligatorio',
            'correo.email' => 'El formato del correo electrónico es inválido', 
            'correo.unique' => 'El correo electrónico ya está registrado en otra área', 
            'tipo.required' => 'El campo tipo es obligatorio',            
        ]);

        
        // Buscamos el registro a actualizar
        $area = Area::findOrFail($id);

        // Asignamos los valores al registro
        $area->nombre = $validatedData['nombre'];
        $area->responsable = $validatedData['responsable'];
        $area->siglas = $validatedData['siglas'];
        $area->correo = $validatedData['correo'];
        $area->extension = $validatedData['extension'];
        $area->tipo = $validatedData['tipo'];

        // Guardar los cambios en la base de datos
        $area->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('showArea',compact('id'))->with('update', 'El registro se actualizó correctamente.');
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LAS ELIMINAR AREA
     * 
     * 
     */

     public function delete($id)
    {
        // Buscar el usuario por su ID
        $area = Area::findOrFail($id);

        // Eliminar el usuario
        $area->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('indexArea')->with('delete', 'Datos eliminados exitosamente.');
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LAS JEFATURAS A CARGO DE LA UNIDAD
     * 
     * 
     */
    public function miUnidad()
    {
        // Consultamos el usuario que esta logeado
        $user = Auth::user();

        $jefaturas = Area::where('unidad',$user->id_area)
                        ->where('tipo',4)
                        ->get();
        
        // Retornamos la vista con el objeto
        return view('area.miUnidad',['jefaturas'=>$jefaturas]);
    }

    /***************************************************************************************************************************************************
     * 
     * 
     * METODO PARA MOSTRAR MIS AREAS RESPONSABLES CON SUS DATOS
     * 
     * 
     **************************************************************************************************************************************************/

    public function misAreas()
    {
        // Consultamos el usuario logeado
        $user = Auth::user();

        // Hacemos el filtro por nivel de usuario

        // Subdirecciones
        if($user->nivel == 3)
        {
            $areas = Area::where('subdireccion',$user->id_area)
                ->get();
        }

        // Regresamos la vista con el arreglo
        return view('configuracion.misAreas', compact('areas'));
    }
}

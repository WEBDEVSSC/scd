<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\AreasNivel;
use Illuminate\Http\Request;

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
            'firma' => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ], [
            'nombre.required' => 'El campo nombre es obligatorio',
            'responsable.required' => 'El campo responsable es obligatorio',
            'siglas.required' => 'El campo siglas es obligatorio',
            'correo.required' => 'El campo correo es obligatorio', // Corregido: 'email' a 'correo'
            'correo.email' => 'El formato del correo electrónico es inválido', // Mensaje adicional
            'correo.unique' => 'El correo electrónico ya está registrado en otra área', // Mensaje adicional
            'extension.required' => 'El campo extensión es obligatorio',
            'tipo.required' => 'El campo tipo es obligatorio',
            'firma.required'=>'El campo es requerido',
            'firma.mimes'=>'El formato soportado es JPG, PG ,JPEG',
            'firma.max'=>'El tamaño maximo es de 2 MB',
        ]);

        // Verificar si el campo firma tiene un archivo
        if ($request->hasFile('firma')) {
            // Obtener el archivo de la firma
            $image = $request->file('firma');

            // Generar un nombre único para la imagen (basado en el tiempo actual)
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Almacenar la imagen en la carpeta 'public/images' (esto la mueve a storage/app/public/images)
            $imagePath = $image->storeAs('images/areas', $imageName, 'public');
        }

        // Crear una nueva instancia del modelo Area
        $area = new Area();

        // Asignar los valores a los atributos del modelo
        $area->nombre = $request->nombre;
        $area->responsable = $request->responsable;
        $area->siglas = $request->siglas;
        $area->correo = $request->correo; // Cambiado a $request->correo
        $area->extension = $request->extension;
        $area->tipo = $request->tipo;
        $area->firma = 'storage/' . $imagePath;

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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

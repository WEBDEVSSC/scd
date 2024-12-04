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
        return redirect()->route('indexArea')->with('success', 'La unidad se registró correctamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

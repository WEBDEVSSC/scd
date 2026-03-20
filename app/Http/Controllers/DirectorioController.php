<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class DirectorioController extends Controller
{
    //
    public function directorioIndex()
    {
        $areas = Area::orderBy('nombre', 'asc')->get();

        return view('directorio.index', compact('areas'));
    }

    public function directorioEdit($id)
    {
        $area = Area::findOrFail($id);

        return view('directorio.edit', compact('area'));
    }

    public function directorioUpdate(Request $request, $id)
    {
        $request->validate([
            'responsable' => 'required|string|max:255',
            'correo' => 'required|email|max:255',
            'extension' => 'required|numeric|digits_between:1,4'
        ], [
            'responsable.required' => 'El responsable es obligatorio.',
            'responsable.string' => 'El responsable debe ser texto.',
            'responsable.max' => 'El responsable no debe exceder 255 caracteres.',

            'correo.required' => 'El email es obligatorio.',
            'correo.email' => 'Debe ser un correo válido.',
            'correo.max' => 'El email no debe exceder 255 caracteres.',

            'extension.required' => 'La extensión es obligatoria.',
            'extension.numeric' => 'La extensión debe ser numérica.',
            'extension.digits_between' => 'La extensión debe tener máximo 4 dígitos.',
        ]);

        $area = Area::findOrFail($id);

        $area->responsable = $request->responsable;
        $area->correo = $request->correo;
        $area->extension = $request->extension;

        $area->save();

        return redirect()->route('directorioIndex')->with('success', 'Datos actualizados correctamente.');    
    }
}

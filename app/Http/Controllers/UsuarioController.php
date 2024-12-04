<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\UsersNivel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = User::all();
        return view('usuario.indexUsuario', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Hacemos la lista de las areas
        $areas = Area::all();

        // Hacemos la lista de los niveles de usuario
        $niveles = UsersNivel::all();

        return view('usuario.createUsuario',[
            'areas'=>$areas,
            'niveles'=>$niveles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nombre'=>'required',
            'correo'=>'required | email',
            'password'=>'required',
            'cargo'=>'required',
            'id_area'=>'required',
            'nivel'=>'required',
            'firma' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validar el tipo de archivo y el tamaño
        ],[
            'nombre.required'=>'El campo es requerido',
            'correo.required'=>'El campo es requerido',
            'password.required'=>'El campo es requerido',
            'cargo.required'=>'El campo es requerido',
            'id_area.required'=>'El campo es requerido',
            'nivel.required'=>'El campo es requerido',
            'firma.required'=>'El campo es requerido',
            'firma.mimes'=>'El formato soportado es JPG, PG ,JPEG',
            'firma.max'=>'El tamaño maximo es de 2 MB',
        ]);

        // cONSULTAMOS LOS DATOS DE LAS BASES
        $labelArea = Area::where('id',$request->id_area)->first();
        $nombreArea = $labelArea -> nombre;

        $labelNivel = UsersNivel::where('id',$request->nivel)->first();
        $nombreNivel = $labelNivel->nivel;

        // Verificar si el campo firma tiene un archivo
        if ($request->hasFile('firma')) {
            // Obtener el archivo de la firma
            $image = $request->file('firma');

            // Generar un nombre único para la imagen (basado en el tiempo actual)
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Almacenar la imagen en la carpeta 'public/images' (esto la mueve a storage/app/public/images)
            $imagePath = $image->storeAs('images', $imageName, 'public');
        }

        $usuario = new User();

        $usuario->name = $request->nombre;
        $usuario->email = $request->correo;
        $usuario->password = Hash::make($request->password);
        $usuario->cargo = $request->cargo;
        $usuario->id_area = $request->id_area;
        $usuario->id_area_label = $nombreArea;
        $usuario->nivel = $request->nivel;
        $usuario->nivel_label = $nombreNivel;
        $usuario->firma = 'storage/' . $imagePath;

        $usuario->save();

        return redirect()->route('indexUsuario')->with('success', 'La unidad se registro correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Consultamoe los datos del usuario 

        $usuario = User::find($id);

        return view('usuario.showUsuario',['usuario'=>$usuario]);

    }


}

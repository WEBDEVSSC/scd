<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\UsersNivel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
        // Validamos los campos
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
            $imagePath = $image->storeAs('images/usuarios', $imageName, 'public');
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

        return redirect()->route('indexUsuario')->with('success', 'Datos guardados exitosamente');
    }

    /**
     * 
     * 
     * METODO PARA MOSTRAR LOS DATOS DEL USUARIO
     *      
     * 
     */
    public function show($id)
    {
        // Consultamoe los datos del usuario 
        $usuario = User::find($id);

        // Retornamos la vista con el objeto
        return view('usuario.showUsuario',['usuario'=>$usuario]);

    }

    /**
     * 
     * 
     * METODO PARA EDITAR EL USUARIO
     *      
     * 
     */
    public function edit($id)
    {
        // Buscamos el registro con el id proporcionado por la url
        $usuario = User::findOrFail($id);

        // Concultamos el catalogo de areas
        $areas = Area::all();

        // Consultamos los niveles de usuarios
        $niveles = UsersNivel::all();

        // Retornamos la vista con los datos del registro
        return view('usuario.editUsuario',compact('usuario','areas','niveles'));
    }

    /**
     * 
     * 
     * METODO PARA ACTUALIZAR LOS DATOS DEL USUARIO
     *      
     * 
     */
    public function update(Request $request, $id)
    {
        // Validamos los campos
        $request->validate([
            'nombre'=>'required',
            'correo'=>'required | email',
            'cargo'=>'required',
            'id_area'=>'required',
            'nivel'=>'required',
            'firma' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nombre.required'=>'El campo es requerido',
            'correo.required'=>'El campo es requerido',
            'cargo.required'=>'El campo es requerido',
            'id_area.required'=>'El campo es requerido',
            'nivel.required'=>'El campo es requerido',
            'firma.mimes'=>'El formato soportado es JPG, PNG ,JPEG',
            'firma.max'=>'El tamaño maximo es de 2 MB',
        ]);

        // Consultamos el NIVEL LABEL
        $labelNivel = UsersNivel::where('id',$request->nivel)->first();
        $nombreNivel = $labelNivel->nivel;

        // Consultamos el AREA LABEL
        $labelArea = Area::where('id',$request->id_area)->first();
        $nombreArea = $labelArea -> nombre;

        // Buscamos el registro que vamos a actualizar
        $usuario = User::findOrFail($id);

        // Actalizamos los datos con los valores del formuario
        $usuario->name = $request->nombre;
        $usuario->email = $request->correo;
        $usuario->id_area = $request->id_area;
        $usuario->nivel = $request->nivel;
        $usuario->nivel_label = $nombreNivel;
        $usuario->cargo = $request->cargo;
        $usuario->id_area_label = $nombreArea;

        // Si la contraseña no está vacía, actualiza la contraseña
        if ($request->filled('password')) 
        {
            $usuario->password = Hash::make($request->input('password'));
        }

        // Si la firma no está vacía, actualiza la firma
        if ($request->hasFile('firma') && $request->file('firma')->isValid()) 
        {    
            // Manejamos la imagen para almacenarla en la base de datos
            $image = $request->file('firma');
        
            // Generar un nombre único para la imagen (basado en el tiempo actual)
            $imageName = time() . '.' . $image->getClientOriginalExtension();
        
            // Almacenar la imagen en la carpeta 'public/images' (esto la mueve a storage/app/public/images)
            $imagePath = $image->storeAs('images', $imageName, 'public');
        
            // Actualizamos el campo 'firma' del usuario con la nueva ruta de la imagen
            $usuario->firma = 'storage/' . $imagePath;
        }

        // Guardamos los datos
        $usuario->save();

        // Retornamos a la vista de edición
        return redirect()->route('showUsuario',$usuario->id)->with('update', 'Datos actualizados exitosamente');
    }

    /**
     * 
     * 
     * METODO PARA ELIMINAR LOS DATOS DEL USUARIO
     *      
     * 
     */
    public function delete($id)
    {
        // Buscar el usuario por su ID
        $usuario = User::findOrFail($id);

        // Eliminar el usuario
        $usuario->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('indexUsuario')->with('delete', 'Datos eliminados exitosamente.');
    }
}

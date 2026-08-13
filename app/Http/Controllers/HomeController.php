<?php

namespace App\Http\Controllers;

use App\Models\DocumentoRecibido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Si por alguna razón no hay usuario autenticado, redirigir
        if (!$user) {
            return redirect()->route('login');
        }

        // Realizamos una sola consulta para obtener los conteos filtrados por status
        $subdireccionId = $user->id_area;

        $totalRegistrosSubdireccion = DocumentoRecibido::where('subdireccion_id', $subdireccionId)->count();

        $counts = DocumentoRecibido::where('subdireccion_id', $subdireccionId)
            ->selectRaw("
                COUNT(CASE WHEN status = 'NUEVO' THEN 1 END) as nuevos,
                COUNT(CASE WHEN status = 'TURNADO A AREA' THEN 1 END) as turnados,
                COUNT(CASE WHEN status = 'ATENDIDO' THEN 1 END) as atendidos
            ")
            ->first();

        $totalRegistrosSubdireccionNuevos = $counts->nuevos ?? 0;
        $totalRegistrosSubdireccionTurnados = $counts->turnados ?? 0;
        $totalRegistrosSubdireccionAtendidos = $counts->atendidos ?? 0;

        return view('home', compact(
            'user', 
            'totalRegistrosSubdireccion', 
            'totalRegistrosSubdireccionNuevos', 
            'totalRegistrosSubdireccionTurnados', 
            'totalRegistrosSubdireccionAtendidos'
        ));
    }
}

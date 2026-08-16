<?php

namespace App\Http\Controllers;

use App\Models\DocumentoRecibido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\WeatherService;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(WeatherService $weatherService)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // 1. Obtener la información del clima (Inyección automática de Laravel)
        $climaData = $weatherService->getWeatherByCity('Saltillo');

        if ($climaData) {
            $climaData['estado'] = $weatherService->parseWeatherCode($climaData['current']['weather_code']);
        }

        // 2. Consultas de documentos
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

        // 3. Enviar todo a la vista
        return view('home', compact(
            'user', 
            'climaData',
            'totalRegistrosSubdireccion', 
            'totalRegistrosSubdireccionNuevos', 
            'totalRegistrosSubdireccionTurnados', 
            'totalRegistrosSubdireccionAtendidos'
        ));
    }
}
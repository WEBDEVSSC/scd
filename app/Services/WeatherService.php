<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService
{
    public function getWeatherByCity(string $cityName): ?array
    {
        // 1. Convertir nombre de ciudad a coordenadas (Geocoding)
        $geoResponse = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name' => $cityName,
            'count' => 1,
            'language' => 'es',
            'format' => 'json',
        ]);

        if ($geoResponse->failed() || empty($geoResponse->json('results'))) {
            return null;
        }

        $location = $geoResponse->json('results.0');
        $lat = $location['latitude'];
        $lng = $location['longitude'];

        // 2. Obtener el clima actual y el pronóstico por horas
        $weatherResponse = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $lat,
            'longitude' => $lng,
            'current' => ['temperature_2m', 'relative_humidity_2m', 'apparent_temperature', 'weather_code', 'wind_speed_10m'],
            'hourly' => ['temperature_2m', 'weather_code', 'relative_humidity_2m'],
            'forecast_hours' => 12, // Limita las próximas 12 horas
            'timezone' => 'auto',
        ]);

        if ($weatherResponse->failed()) {
            return null;
        }

        // 3. Procesar los datos por hora agregando iconos y descripciones
        $hourlyRaw = $weatherResponse->json('hourly', []);
        $hourlyProcessed = [];

        if (!empty($hourlyRaw['time'])) {
            foreach ($hourlyRaw['time'] as $index => $time) {
                $code = $hourlyRaw['weather_code'][$index] ?? 0;
                $weatherInfo = $this->parseWeatherCode($code);

                $hourlyProcessed[] = [
                    'time' => $time,
                    'temperature' => $hourlyRaw['temperature_2m'][$index] ?? null,
                    'humidity' => $hourlyRaw['relative_humidity_2m'][$index] ?? null,
                    'code' => $code,
                    'description' => $weatherInfo['description'],
                    'icon' => $weatherInfo['icon'],
                ];
            }
        }

        return [
            'city' => $location['name'],
            'country' => $location['country'] ?? '',
            'latitude' => $lat,
            'longitude' => $lng,
            'current' => $weatherResponse->json('current'),
            'units' => $weatherResponse->json('current_units'),
            'hourly' => $hourlyProcessed, // Arreglo limpio procesado para la vista
        ];
    }

    /**
     * Convierte el weather_code de WMO a texto e icono en español
     */
    public function parseWeatherCode(int $code): array
    {
        return match ($code) {
            0 => ['description' => 'Cielo despejado', 'icon' => '☀️'],
            1, 2, 3 => ['description' => 'Parcialmente nublado', 'icon' => '⛅'],
            45, 48 => ['description' => 'Niebla', 'icon' => '🌫️'],
            51, 53, 55 => ['description' => 'Llovizna', 'icon' => '🌦️'],
            61, 63, 65 => ['description' => 'Lluvia', 'icon' => '🌧️'],
            71, 73, 75 => ['description' => 'Nieve', 'icon' => '❄️'],
            80, 81, 82 => ['description' => 'Chubascos', 'icon' => '🌧️'],
            95, 96, 99 => ['description' => 'Tormenta eléctrica', 'icon' => '⛈️'],
            default => ['description' => 'Desconocido', 'icon' => '🌡️'],
        };
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Models\Venta;
class ReporteIAController extends Controller
{
    //

    public function generarReporteIA()
    {
        $ventas = Venta::with(['cliente', 'usuario', 'detalles_ventas'])->get();

        // Preparar los datos que se enviarán a la IA
        $data = $ventas->map(function ($venta) {
            return [
                'id' => $venta->id,
                'cliente' => $venta->cliente->nombre ?? 'N/A',
                'usuario' => $venta->usuario->nombre ?? 'N/A',
                'fecha' => $venta->fecha->format('Y-m-d'),
                'total' => $venta->total,
                'metodo_pago' => $venta->metodo_pago,
            ];
        });

        // Llamar a la API de IA (ejemplo: OpenAI)
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-4o-mini',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Eres un analista de datos que genera reportes de ventas claros y detallados.',
                ],
                [
                    'role' => 'user',
                    'content' => 'Genera un resumen con insights de las siguientes ventas: ' . $data->toJson(),
                ],
            ],
        ]);

        // Procesar la respuesta
        $reporte = $response->json()['choices'][0]['message']['content'] ?? 'No se pudo generar el reporte.';

        return view('reporte_ventas', compact('reporte'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ResultadoOlimpiada;

class ResultadosOlimpiadasController extends Controller
{
    public function index()
    {
        $resultados = ResultadoOlimpiada::orderBy('grado')
            ->orderBy('id_prueba')
            ->orderByDesc('maxpuntuacion')
            ->orderBy('TiempoFinal')
            ->get()
            ->groupBy(['grado', 'nombrePrueba']); // agrupa para la vista

        return view('resultados_live', compact('resultados'));
    }

    // Endpoint HTML para el refresco AJAX
    public function datos()
    {
        $resultados = ResultadoOlimpiada::orderBy('grado')
            ->orderBy('id_prueba')
            ->orderByDesc('maxpuntuacion')
            ->orderBy('TiempoFinal')
            ->get()
            ->groupBy(['grado', 'nombrePrueba']);

        return view('partials.frontend._resultados_tabla', compact('resultados'));
    }
}

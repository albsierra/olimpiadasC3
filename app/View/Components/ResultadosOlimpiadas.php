<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Resultado;

class ResultadosOlimpiadas extends Component
{
    public $resultados;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Llamar a la función del modelo para obtener los resultados
        $this->resultados = Resultado::getResultadosMoodle()->all();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.frontend.resultados-olimpiadas');
    }
}

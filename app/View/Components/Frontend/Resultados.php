<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Resultados extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($edicion = \App\Models\Edicion::getEdicionActual()) {
            $resultado = $edicion->resultados;
            $palmares = $resultado ? $resultado->palmares : null;
        }
        return view('components.frontend.resultados', [
            'palmares' => $palmares,
        ]);
    }
}

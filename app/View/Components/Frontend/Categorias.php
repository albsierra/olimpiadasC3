<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Categorias extends Component
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
        $edicion = \App\Models\Edicion::getEdicionActual();
        $categorias = $edicion->categorias;
        return view('components.frontend.categorias', [
            'categorias' => $categorias,
        ]);
    }
}

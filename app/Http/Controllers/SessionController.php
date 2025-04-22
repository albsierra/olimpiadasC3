<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edicion;

class SessionController extends Controller
{
    public function setEdicion(Request $request)
    {
        $edicion = Edicion::findOrFail($request->input('edicion_id'));
        session(['edicion' => $edicion]);
        return redirect()->route('home');
    }
}

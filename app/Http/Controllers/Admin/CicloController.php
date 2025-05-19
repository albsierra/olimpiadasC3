<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;
use App\Models\Grado;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Grado $grado)
    {
        $ciclos = $grado->ciclos;
        return view('admin.ciclos.index', compact('ciclos', 'grado'));
    }

    public function create(Grado $grado)
    {
        return view('admin.ciclos.create', compact('grado'));
    }

    public function show(Ciclo $ciclo)
    {
        return view('admin.ciclos.show', compact('ciclo'));
    }

    public function store(Request $request, Grado $grado)
    {
        $request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|max:100',
        ]);

        $grado->ciclos()->create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'grado_id' => $grado->id,
        ]);

        return redirect()->route('grados.ciclos.index', ['grado' => $grado])->with('success', 'Ciclo creado correctamente.');
    }

    public function edit(Ciclo $ciclo)
    {
        $grado = $ciclo->grado;
        return view('admin.ciclos.edit', compact('ciclo', 'grado'));
    }

    public function update(Request $request, Ciclo $ciclo)
    {
        $request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|max:100',
        ]);

        $grado = $ciclo->grado;
        $ciclo->codigo = $request->codigo;
        $ciclo->nombre = $request->nombre;
        $ciclo->grado_id = $grado->id;
        $ciclo->save();

        return redirect()->route('grados.ciclos.index', ['grado' => $grado])->with('success', 'Ciclo actualizado correctamente.');
    }

    public function destroy(Ciclo $ciclo)
    {
        $grado = $ciclo->grado;
        $ciclo->delete();

        return redirect()->route('grados.ciclos.index', ['grado' => $grado])->with('success', 'Ciclo eliminado correctamente.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resultado;
use Illuminate\Http\Request;

class ResultadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resultados = Resultado::all();
        return view('admin.resultados.index', compact('resultados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ediciones = \App\Models\Edicion::all();
        // eliminar las ediciones que tienen resultados
        $ediciones = $ediciones->filter(function ($edicion) {
            $resultado = $edicion->resultados;
            return !($resultado);
        });
        return view('admin.resultados.create', compact('ediciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ediciones,id',
            'palmares' => 'required|string',
        ]);
        Resultado::create([
            'id' => $request->id,
            'palmares' => $request->palmares,
        ]);

        return redirect()->route('resultados.index')->with('success', 'Resultado creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resultado $resultado)
    {
        return view('admin.resultados.show', compact('resultado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resultado $resultado)
    {
        return view('admin.resultados.edit', compact('resultado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resultado $resultado)
    {
        $request->validate([
            'palmares' => 'required|string',
        ]);

        $resultado->update([
            'palmares' => $request->palmares,
        ]);

        return redirect()->route('resultados.index')->with('success', 'Resultado actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resultado $resultado)
    {
        $resultado->delete();
        return redirect()->route('resultados.index')->with('success', 'Resultado eliminado con éxito.');
    }
}

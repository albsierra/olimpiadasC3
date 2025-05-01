<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\Participante;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $participantes = Participante::all();
        return view('admin.participantes.index', ['participantes' => $participantes]);
    }

    /**
     * Display one resource.
     */
    public function show(Participante $participante)
    {
        return view('admin.participantes.show', compact('participante'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $grupos = Grupo::all();
        return view('admin.participantes.create')->with('grupos', $grupos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'grupo' => 'required|exists:grupos,id',
            'nombre' => 'required|max:100',
        ]);

        Participante::create([
            'grupo_id' => $request->grupo,
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
        ]);

        return redirect()->route('participantes.index')->with('success', 'Participante creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Participante $participante)
    {
        $grupos = Grupo::all();
        return view('admin.participantes.edit', compact('participante', 'grupos'));
    }
    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Participante $participante){
        $request->validate([
            'grupo' => 'required|exists:grupos,id',
            'nombre' => 'required|max:100',
        ]);

        $participante->grupo_id = $request->grupo;
        $participante->nombre = $request->nombre;
        $participante->apellidos = $request->apellidos;
        $participante->save();

        return redirect()->route('participantes.index')->with('success', 'Participante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Participante $participante)
    {
        $participante->delete();
        return redirect()->route('participantes.index')->with('success', 'Participante eliminado correctamente.');
    }

}

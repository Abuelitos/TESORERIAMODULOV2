<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\NotaCargo;
use Illuminate\Http\Request;
use App\Models\Cliente;

class NotaCargoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notasCargo = NotaCargo::with('cliente')->get();
        $clientes = Cliente::all();
        return view('notasCargos.index', compact('notasCargo', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Lugar' => 'required|string|max:255',
            'Fecha' => 'required|date',
            'cliente_dui' => 'required|string|max:10',
            'ConceptoCargo' => 'required|string|max:255',
            'NumeroFactura' => 'required|string|max:255',
            'FormaCobro' => 'required|string|max:255',
            'Comentarios' => 'nullable|string|max:255',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        NotaCargo::create($request->all());

        return redirect()->route('notasCargos.index')->with('success', 'Nota de cargo creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $notaCargo = NotaCargo::with('cliente')->findOrFail($id);
        return view('notasCargos.show', compact('notaCargo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $notaCargo = NotaCargo::findOrFail($id);
        $clientes = Cliente::all();
        return view('notasCargos.edit', compact('notaCargo', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'Lugar' => 'required|string|max:255',
            'Fecha' => 'required|date',
            'cliente_dui' => 'required|string|max:10',
            'ConceptoCargo' => 'required|string|max:255',
            'NumeroFactura' => 'required|string|max:255',
            'FormaCobro' => 'required|string|max:255',
            'Comentarios' => 'nullable|string|max:255',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        $notaCargo = NotaCargo::findOrFail($id);
        $notaCargo->update($request->all());

        return redirect()->route('notasCargos.index')->with('success', 'Nota de cargo actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $notaCargo = NotaCargo::findOrFail($id);
        $notaCargo->delete();

        return redirect()->route('notasCargos.index')->with('success', 'Nota de cargo eliminada correctamente.');
    }

    /**
     * Método para buscar un cliente por DUI.
     */
    public function buscarPorDui(Request $request)
    {
        $dui = $request->query('dui');
        $cliente = Cliente::where('dui', $dui)->first();

        if ($cliente) {
            return response()->json(['success' => true, 'cliente' => $cliente]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cliente no encontrado']);
        }
    }
}

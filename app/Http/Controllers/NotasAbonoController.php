<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotaAbono;
use App\Models\Cliente;
use App\Models\TipoTransferencia;

class NotasAbonoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notasAbono = NotaAbono::with('client')->get();
        foreach ($notasAbono as $nota) {
            if (!$nota->cliente) {
                dd("La relación cliente no está cargada para la nota con ID " . $nota->ID);
            }
        }
        
        $tiposTransferencia = TipoTransferencia::all();
        return view('notasAbonos.index', compact('notasAbono', 'tiposTransferencia'));
    }

    public function buscarPorDui(Request $request)
    {
        $dui = $request->query('dui');  // Aquí se obtiene el DUI desde la consulta en la URL
        $cliente = Cliente::where('dui', $dui)->first();

        if ($cliente) {
            return response()->json(['success' => true, 'cliente' => $cliente]);
        } else {
            return response()->json(['success' => false, 'message' => 'Cliente no encontrado']);
        }
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all(); // Obtener todos los clientes para mostrarlos en un dropdown
        return view('notasAbonos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Lugar' => 'required|string|max:255',
            'Fecha' => 'required|date',
            'cliente' => 'required|string|max:10',
            'ConceptoAbono' => 'required|string|max:255',
            'NumeroFactura' => 'required|string|max:255',
            'FormaAbono' => 'required|int',
            'Comentarios' => 'nullable|string|max:255',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        NotaAbono::create($request->all());

        return redirect()->route('notasAbonos.index')->with('success', 'Nota de abono creada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notaAbono = NotaAbono::with('cliente')->findOrFail($id);
        return view('notasAbonos.show', compact('notaAbono'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notaAbono = NotaAbono::findOrFail($id);
        $clientes = Cliente::all(); // Para poder elegir un cliente diferente en la edición
        return view('notasAbonos.edit', compact('notaAbono', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $request->validate([
        //     'Lugar' => 'required|string|max:255',
        //     'Fecha' => 'required|date',
        //     'cliente' => 'required|string|max:10', // Asume que el campo cliente es un string que almacena el DUI
        //     'ConceptoAbono' => 'required|string|max:255',
        //     'NumeroFactura' => 'required|string|max:255',
        //     'FormaAbono' => 'required|string|max:255',
        //     'Comentarios' => 'nullable|string|max:255',
        //     'NombreAutoriza' => 'required|string|max:255',
        // ]);

        $notaAbono = NotaAbono::findOrFail($id);
        $notaAbono -> Lugar = $request -> Lugar;
        $notaAbono -> Fecha = $request -> Fecha;
        $notaAbono -> ConceptoAbono = $request -> ConceptoAbono;
        $notaAbono -> NumeroFactura = $request -> NumeroFactura;
        $notaAbono -> FormaAbono = $request -> FormaAbono;
        $notaAbono -> Comentarios = $request -> Comentarios;
        $notaAbono -> NombreAutoriza = $request -> NombreAutoriza;
        $notaAbono -> save();
        // $notaAbono->update($request->all());

        return redirect()->route('notasAbonos.index')->with('success', 'Nota de abono actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notaAbono = NotaAbono::findOrFail($id);
        $notaAbono->delete();

        return redirect()->route('notasAbonos.index')->with('success', 'Nota de abono eliminada correctamente.');
    }
}

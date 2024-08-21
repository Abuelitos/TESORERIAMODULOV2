<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cheque;
use App\Models\Banco;
use App\Models\Cliente;

class ChequeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cheques = Cheque::all();
        $bancos = Banco::all();
        return view('cheques.index', compact('cheques', 'bancos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());        

        $cheque = new Cheque;
        $cheque->Lugar = $request->input('lugar');
        $cheque->Fecha = $request->input('Fecha');
        $cheque->BancoPagador = $request->input('BancoPagador');
        $cheque->CuentaBancoPagador = $request->input('cuentaBancoPagador');
        $cheque->MontoNumeros = $request->input('direccion');
        $cheque->MontosLetras = $request->input('telefono');
        $cheque->Firmas = $request->input('celular') ? 1 : 0; 

        
        $cheque->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('cheques.index')->with('success', 'Cheque creado exitosamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el cheque por su ID con la relación del banco
        $cheque = Cheque::with('banco')->findOrFail($id);
    
        // Retornar la respuesta en formato JSON
        return response()->json($cheque);
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos recibidos
        $request->validate([
            'Lugar' => 'required|string|max:255',
            'Fecha' => 'required|date',
            'BancoPagador' => 'required|integer',
            'CuentaBancoPagador' => 'required|string|max:255',
            'MontoNumeros' => 'required|numeric',
            'MontosLetras' => 'required|string|max:255',
            'Firmas' => 'nullable|boolean',
        ]);

        // Encontrar el cheque por su ID y actualizarlo directamente
        $cheque = Cheque::findOrFail($id);

        $cheque->Lugar = $request->input('Lugar');
        $cheque->Fecha = $request->input('Fecha');
        $cheque->BancoPagador = $request->input('BancoPagador');
        $cheque->CuentaBancoPagador = $request->input('CuentaBancoPagador');
        $cheque->MontoNumeros = $request->input('MontoNumeros');
        $cheque->MontosLetras = $request->input('MontosLetras');
        $cheque->Firmas = $request->input('Firmas', false);

        $cheque->save();  // Guardar los cambios en la base de datos

        // Redirigir con un mensaje de éxito
        return redirect()->route('cheques.index')->with('success', 'Cheque actualizado correctamente.');
    }


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

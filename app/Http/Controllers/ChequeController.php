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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

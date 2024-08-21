<?php

namespace App\Http\Controllers;

use App\Models\Transferencia;
use App\Models\Banco;
use Illuminate\Http\Request;

class TranferenciaController extends Controller
{
    public function index()
    {
        // Obtener todas las transferencias con sus bancos asociados
        $transferencias = Transferencia::with(['bancoOrigen', 'bancoDestino'])->get();
        $bancos = Banco::all();
        return view('tranferencias.index', compact('transferencias', 'bancos'));
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'Lugar' => 'required|string|max:255',
            'FechaProcesamiento' => 'required|date',
            'FechaEjecucion' => 'required|date',
            'BancoOrigen' => 'required|integer',
            'CuentaBancoOrigen' => 'required|string|max:255',
            'MontoNumeros' => 'required|numeric',
            'MontosLetras' => 'required|string|max:255',
            'BancoDestino' => 'required|integer',
            'NombreReceptor' => 'required|string|max:255',
            'CuentaBancoReceptor' => 'required|string|max:255',
            'MontoNumerosDestino' => 'required|numeric',
            'MontosLetrasDestino' => 'required|string|max:255',
            'TipoTransferencia' => 'required|string|max:255',
            'ConceptoTransferencia' => 'required|string|max:255',
            'CorreoReceptor' => 'nullable|string|max:255',
            'TelefonoReceptor' => 'nullable|string|max:255',
            'DireccionReceptor' => 'nullable|string|max:255',
            'Pais' => 'nullable|string|max:255',
            'ComisionesBancarias' => 'nullable|numeric',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        // Crear la transferencia
        Transferencia::create($request->all());

        return redirect()->route('tranferencias.index')->with('success', 'Transferencia creada correctamente.');
    }

    public function update(Request $request, $id)
    {
        // Validar los datos de entrada
        $request->validate([
            'Lugar' => 'required|string|max:255',
            'FechaProcesamiento' => 'required|date',
            'FechaEjecucion' => 'required|date',
            'BancoOrigen' => 'required|integer',
            'CuentaBancoOrigen' => 'required|string|max:255',
            'MontoNumeros' => 'required|numeric',
            'MontosLetras' => 'required|string|max:255',
            'BancoDestino' => 'required|integer',
            'NombreReceptor' => 'required|string|max:255',
            'CuentaBancoReceptor' => 'required|string|max:255',
            'MontoNumerosDestino' => 'required|numeric',
            'MontosLetrasDestino' => 'required|string|max:255',
            'TipoTransferencia' => 'required|string|max:255',
            'ConceptoTransferencia' => 'required|string|max:255',
            'CorreoReceptor' => 'nullable|string|max:255',
            'TelefonoReceptor' => 'nullable|string|max:255',
            'DireccionReceptor' => 'nullable|string|max:255',
            'Pais' => 'nullable|string|max:255',
            'ComisionesBancarias' => 'nullable|numeric',
            'NombreAutoriza' => 'required|string|max:255',
        ]);

        // Encontrar la transferencia
        $transferencia = Transferencia::findOrFail($id);

        // Actualizar la transferencia
        $transferencia->update($request->all());

        return redirect()->route('tranferencias.index')->with('success', 'Transferencia actualizada correctamente.');
    }
}
